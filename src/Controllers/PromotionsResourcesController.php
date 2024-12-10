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
use SaltProduct\Models\Promotions;
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
class PromotionsResourcesController extends Controller
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
    use ResourceIndexable;

    use ResourceStorable;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request, $parentId = null) {

        $this->checkModelAuthorization('index', 'read');

        try {

            $items = $request->get('items', []);
            $code = $request->get('code', '');

            $today = date('Y-m-d');
            $flash = Promotions::whereRaw('(? between promotions.start_at and promotions.expired_at)', [$today])
                    // ->whereRaw('(promotions.is_flashsale is true or promotions.code = ?)', [$code])
                    ->whereRaw('(promotions.is_flashsale is true)')
                    ->withWhereHas('showcase.products', function($q) use($items) {
                        $q->whereIn('product_showcases.product_id', $items)
                            ->whereHas('product', function($query) {
                                $query->where('status', 'active');
                            });
                    })
                    ->with(['product', 'category'])
                    ->first();

            if($flash) {
                $flash->available_for = $flash->showcase->products->pluck('product_id')->toArray();
            }

            $promo = Promotions::whereRaw('(? between promotions.start_at and promotions.expired_at)', [$today])
                    ->whereRaw('(promotions.code = ?)', [$code])
                    ->with(['product', 'category'])
                    ->first();

            if($promo && $promo->product) {
                $promo->available_for = [$promo->product->id];
            }

            if($promo && !isset($promo->available_for)) {
                $promo->available_for = $items;
            }

            $data = array_filter([$flash, $promo]);

            $this->responder->set('message', 'Promotion checked');
            $this->responder->set('data', $data);

            return $this->responder->response();
        } catch(\Exception $e) {
            $this->responder->set('message', $e->getMessage());
            $this->responder->setStatus(500, 'Internal server error.');
            return $this->responder->response();
        }
    }

}

