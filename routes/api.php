<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use SaltProduct\Controllers\ShowcasesResourcesController;
use SaltProduct\Controllers\BrandsResourcesController;
use SaltProduct\Controllers\WarehousesResourcesController;
use SaltProduct\Controllers\WarehouseAddressesResourcesController;
use SaltProduct\Controllers\ProductResourcesController;
use SaltProduct\Controllers\ProductStocksResourcesController;
use SaltProduct\Controllers\ProductShowcasesResourcesController;
use SaltProduct\Controllers\VariantsResourcesController;

$version = config('app.API_VERSION', 'v1');

Route::middleware(['api'])
    ->prefix("api/{$version}")
    ->group(function () {

    // API: Showcases RESOURCES
    Route::get("showcases", [ShowcasesResourcesController::class, 'index']); // get entire collection
    Route::post("showcases", [ShowcasesResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("showcases/trash", [ShowcasesResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("showcases/import", [ShowcasesResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("showcases/export", [ShowcasesResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("showcases/report", [ShowcasesResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("showcases/{id}/trashed", [ShowcasesResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("showcases/{id}/restore", [ShowcasesResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("showcases/{id}/delete", [ShowcasesResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("showcases/{id}", [ShowcasesResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("showcases/{id}", [ShowcasesResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("showcases/{id}", [ShowcasesResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("showcases/{id}", [ShowcasesResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Brands RESOURCES
    Route::get("brands", [BrandsResourcesController::class, 'index']); // get entire collection
    Route::post("brands", [BrandsResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("brands/trash", [BrandsResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("brands/import", [BrandsResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("brands/export", [BrandsResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("brands/report", [BrandsResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("brands/{id}/trashed", [BrandsResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("brands/{id}/restore", [BrandsResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("brands/{id}/delete", [BrandsResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("brands/{id}", [BrandsResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("brands/{id}", [BrandsResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("brands/{id}", [BrandsResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("brands/{id}", [BrandsResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID



    // API: Warehouses RESOURCES
    Route::get("warehouses", [WarehousesResourcesController::class, 'index']); // get entire collection
    Route::post("warehouses", [WarehousesResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("warehouses/trash", [WarehousesResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("warehouses/import", [WarehousesResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("warehouses/export", [WarehousesResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("warehouses/report", [WarehousesResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("warehouses/{id}/trashed", [WarehousesResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("warehouses/{id}/restore", [WarehousesResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("warehouses/{id}/delete", [WarehousesResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("warehouses/{id}", [WarehousesResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("warehouses/{id}", [WarehousesResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("warehouses/{id}", [WarehousesResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("warehouses/{id}", [WarehousesResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Warehouse Address RESOURCES
    Route::get("warehouse_addresses", [WarehouseAddressesResourcesController::class, 'index']); // get entire collection
    Route::post("warehouse_addresses", [WarehouseAddressesResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("warehouse_addresses/trash", [WarehouseAddressesResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("warehouse_addresses/import", [WarehouseAddressesResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("warehouse_addresses/export", [WarehouseAddressesResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("warehouse_addresses/report", [WarehouseAddressesResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("warehouse_addresses/{id}/trashed", [WarehouseAddressesResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("warehouse_addresses/{id}/restore", [WarehouseAddressesResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("warehouse_addresses/{id}/delete", [WarehouseAddressesResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("warehouse_addresses/{id}", [WarehouseAddressesResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("warehouse_addresses/{id}", [WarehouseAddressesResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("warehouse_addresses/{id}", [WarehouseAddressesResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("warehouse_addresses/{id}", [WarehouseAddressesResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: products RESOURCES
    Route::get("products", [ProductResourcesController::class, 'index']); // get entire collection
    Route::post("products", [ProductResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("products/trash", [ProductResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("products/import", [ProductResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("products/export", [ProductResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("products/report", [ProductResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("products/{id}/trashed", [ProductResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("products/{id}/restore", [ProductResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("products/{id}/delete", [ProductResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("products/{id}", [ProductResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("products/{id}", [ProductResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("products/{id}", [ProductResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("products/{id}", [ProductResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Product Stocks RESOURCES
    Route::get("product_stocks", [ProductStocksResourcesController::class, 'index']); // get entire collection
    Route::post("product_stocks", [ProductStocksResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("product_stocks/trash", [ProductStocksResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("product_stocks/import", [ProductStocksResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("product_stocks/export", [ProductStocksResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("product_stocks/report", [ProductStocksResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("product_stocks/{id}/trashed", [ProductStocksResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("product_stocks/{id}/restore", [ProductStocksResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_stocks/{id}/delete", [ProductStocksResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("product_stocks/{id}", [ProductStocksResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("product_stocks/{id}", [ProductStocksResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("product_stocks/{id}", [ProductStocksResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_stocks/{id}", [ProductStocksResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Product Showcases RESOURCES
    Route::get("product_showcases", [ProductShowcasesResourcesController::class, 'index']); // get entire collection
    Route::post("product_showcases", [ProductShowcasesResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("product_showcases/trash", [ProductShowcasesResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("product_showcases/import", [ProductShowcasesResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("product_showcases/export", [ProductShowcasesResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("product_showcases/report", [ProductShowcasesResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("product_showcases/{id}/trashed", [ProductShowcasesResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("product_showcases/{id}/restore", [ProductShowcasesResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_showcases/{id}/delete", [ProductShowcasesResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("product_showcases/{id}", [ProductShowcasesResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("product_showcases/{id}", [ProductShowcasesResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("product_showcases/{id}", [ProductShowcasesResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_showcases/{id}", [ProductShowcasesResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Product Variants RESOURCES
    Route::get("variants", [VariantsResourcesController::class, 'index']); // get entire collection
    Route::post("variants", [VariantsResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("variants/trash", [VariantsResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("variants/import", [VariantsResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("variants/export", [VariantsResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("variants/report", [VariantsResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("variants/{id}/trashed", [VariantsResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("variants/{id}/restore", [VariantsResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("variants/{id}/delete", [VariantsResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("variants/{id}", [VariantsResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("variants/{id}", [VariantsResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("variants/{id}", [VariantsResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("variants/{id}", [VariantsResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID

});
