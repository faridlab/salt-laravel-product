<?php

namespace SaltProduct\Controllers;

use OpenApi\Annotations as OA;
use Illuminate\Http\Request;

use SaltLaravel\Controllers\Controller;
use SaltLaravel\Controllers\Traits\ResourceIndexable;
use SaltLaravel\Controllers\Traits\ResourceStorable;
use SaltLaravel\Controllers\Traits\ResourceShowable;
use SaltLaravel\Controllers\Traits\ResourceUpdatable;
use SaltLaravel\Controllers\Traits\ResourcePatchable;
use SaltLaravel\Controllers\Traits\ResourceDestroyable;
use SaltLaravel\Controllers\Traits\ResourceTrashable;
use SaltLaravel\Controllers\Traits\ResourceTrashedable;
use SaltLaravel\Controllers\Traits\ResourceRestorable;
use SaltLaravel\Controllers\Traits\ResourceDeletable;
use SaltLaravel\Controllers\Traits\ResourceImportable;
use SaltLaravel\Controllers\Traits\ResourceExportable;
use SaltLaravel\Controllers\Traits\ResourceReportable;
use Illuminate\Support\Str;
use SaltProduct\Models\Carts;
use SaltProduct\Models\Orders;
use Illuminate\Support\Arr;

/**
 * @OA\Info(
 *      title="Categories Endpoint",
 *      version="1.0",
 *      @OA\Contact(
 *          name="Farid Hidayat",
 *          email="farid@startapp.id",
 *          url="https://startapp.id"
 *      )
 *  )
 */
class TransactionsResourcesController extends Controller
{
    protected $modelNamespace = 'SaltProduct';

    /**
     * @OA\Get(
     *      path="/api/v1/countries",
     *      @OA\ExternalDocumentation(
     *          description="More documentation here...",
     *          url="https://github.com/faridlab/laravel-search-query"
     *      ),
     *      @OA\Parameter(
     *          in="query",
     *          name="search",
     *          required=false
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="List of Country"
     *      ),
     *      @OA\Response(response="default", description="Welcome page")
     * )
     */
    public function index(Request $request, $parentId = null) {

        $this->checkModelAuthorization('index', 'read');

        try {

            $count = $this->model->count();
            $model = $this->model->filter();

            if($this->is_nested === true) {
                if(is_null($this->parent_field)) {
                    throw new \Exception('Please define $parent_field');
                }
                $count = $this->model->where($this->parent_field, $parentId)->count();
                $model = $this->model->where($this->parent_field, $parentId)->filter();
            }

            $format = $request->get('format', 'default');

            $limit = intval($request->get('limit', 25));
            if($limit > 100) {
                $limit = 100;
            }

            $p = intval($request->get('page', 1));
            $page = ($p > 0 ? $p - 1: $p);

            $modelCount = clone $model;
            $meta = array(
                'recordsTotal' => $count,
                'recordsFiltered' => $modelCount->count()?: $count
            );

            $user = auth()->user();
            if($user->hasRole('superadmin')){
                $data = $model
                ->offset($page * $limit)
                ->limit($limit)
                ->get();
            } else{
                $data = $model
                ->where('user_id', $user->id)
                ->offset($page * $limit)
                ->limit($limit)
                ->get();
            }

            $this->responder->set('message', 'Data retrieved.');
            $this->responder->set('meta', $meta);
            $this->responder->set('data', $data);

            return $this->responder->response();
        } catch(\Exception $e) {
            $this->responder->set('message', $e->getMessage());
            $this->responder->setStatus(500, 'Internal server error.');
            return $this->responder->response();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkModelAuthorization('store', 'create');

        try {
            $validator = $this->model->validator($request);
            if ($validator->fails()) {
                $this->responder->set('errors', $validator->errors());
                $this->responder->set('message', $validator->errors()->first());
                $this->responder->setStatus(400, 'Bad Request.');
                return $this->responder->response();
            }
            $user = auth()->user();
            $invoiceNumber = $this->generateInvoiceNumber();
            $request->merge([
                'user_id' => $user->id,
                'trx_id' => $invoiceNumber,
                'purchase_date' => date('Y-m-d H:i:s')
            ]);

            $productIds = Arr::pluck($request->get('items'), 'product_id');
            $carts = Carts::where('user_id', $user->id)
                        ->whereIn('product_id', $productIds)
                        ->where('status', 'active')
                        ->get();

            $price = 0;
            $quantity = 0;
            foreach ($carts as $cart) {
                $price += $cart->total;
                $quantity += $cart->quantity;
            }
            $request->merge(['price' => $price, 'quantity' => $quantity, 'total' => $price]);

            $fields = $request->only($this->model->getTableFields());
            foreach ($fields as $key => $value) {
                $this->model->setAttribute($key, $value);
            }

            $this->model->save();

            foreach ($carts as $cart) {
                $order = new Orders;
                $order->trx_id = $this->model->trx_id;
                $order->user_id = $user->id;
                $order->product_id = $cart->product_id;
                $order->warehouse_id = $request->get('warehouse_id');
                $order->quantity = $cart->quantity;
                $order->price = $cart->price;
                $order->total = $cart->total;
                $order->status = 'settlement';
                $order->transaction_id = $this->model->id;
                $order->save();
            }

            Carts::where('user_id', $user->id)
                ->whereIn('product_id', $productIds)
                ->where('status', 'active')
                ->update(['status' => 'checkout']);

            $this->responder->set('message', 'Transaction #'.$this->model->trx_id.' created successfully!');
            $this->responder->set('data', $this->model);
            $this->responder->setStatus(201, 'Created.');
            return $this->responder->response();
        } catch (\Exception $e) {
            $this->responder->set('message', $e->getMessage());
            $this->responder->setStatus(500, 'Internal server error.');
            return $this->responder->response();
        }
    }

    public function generateInvoiceNumber()
    {
        $random = Str::random(6);
        $invoiceNumber = 'INV/VTK/'.date('Y/m/d').'/'.$random.rand(1000, 9999);
        return Str::upper($invoiceNumber);
    }

    use ResourceShowable;
    use ResourceUpdatable;
    use ResourcePatchable;
    use ResourceDestroyable;
    use ResourceTrashable;
    use ResourceTrashedable;
    use ResourceRestorable;
    use ResourceDeletable;
    use ResourceImportable;
    use ResourceExportable;
    use ResourceReportable;

}
