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
use SaltProduct\Controllers\VariantUnitsResourcesController;
use SaltProduct\Controllers\ProductVariantsResourcesController;
use SaltProduct\Controllers\ProductVariantItemsResourcesController;
use SaltProduct\Controllers\ProductWishlistResourcesController;
use SaltProduct\Controllers\ProductVariantUnitsResourcesController;
use SaltProduct\Controllers\PromotionsResourcesController;
use SaltProduct\Controllers\PromotionBundleResourcesController;
use SaltProduct\Controllers\PromotionUsageResourcesController;
use SaltProduct\Controllers\CartsResourcesController;
use SaltProduct\Controllers\OrdersResourcesController;
use SaltProduct\Controllers\TransactionsResourcesController;
use SaltProduct\Controllers\TrackingStatusesResourcesController;
use SaltProduct\Controllers\TrackingOrdersResourcesController;

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


    // API: Variant Units RESOURCES
    Route::get("variant_units", [VariantUnitsResourcesController::class, 'index']); // get entire collection
    Route::post("variant_units", [VariantUnitsResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("variant_units/trash", [VariantUnitsResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("variant_units/import", [VariantUnitsResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("variant_units/export", [VariantUnitsResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("variant_units/report", [VariantUnitsResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("variant_units/{id}/trashed", [VariantUnitsResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("variant_units/{id}/restore", [VariantUnitsResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("variant_units/{id}/delete", [VariantUnitsResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("variant_units/{id}", [VariantUnitsResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("variant_units/{id}", [VariantUnitsResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("variant_units/{id}", [VariantUnitsResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("variant_units/{id}", [VariantUnitsResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Product Variants RESOURCES
    Route::get("product_variants", [ProductVariantsResourcesController::class, 'index']); // get entire collection
    Route::post("product_variants", [ProductVariantsResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("product_variants/trash", [ProductVariantsResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("product_variants/import", [ProductVariantsResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("product_variants/export", [ProductVariantsResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("product_variants/report", [ProductVariantsResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("product_variants/{id}/trashed", [ProductVariantsResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("product_variants/{id}/restore", [ProductVariantsResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_variants/{id}/delete", [ProductVariantsResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("product_variants/{id}", [ProductVariantsResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("product_variants/{id}", [ProductVariantsResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("product_variants/{id}", [ProductVariantsResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_variants/{id}", [ProductVariantsResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID

    // API: Product Variant Items RESOURCES
    Route::get("product_variant_items", [ProductVariantItemsResourcesController::class, 'index']); // get entire collection
    Route::post("product_variant_items", [ProductVariantItemsResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("product_variant_items/trash", [ProductVariantItemsResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("product_variant_items/import", [ProductVariantItemsResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("product_variant_items/export", [ProductVariantItemsResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("product_variant_items/report", [ProductVariantItemsResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("product_variant_items/{id}/trashed", [ProductVariantItemsResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("product_variant_items/{id}/restore", [ProductVariantItemsResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_variant_items/{id}/delete", [ProductVariantItemsResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("product_variant_items/{id}", [ProductVariantItemsResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("product_variant_items/{id}", [ProductVariantItemsResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("product_variant_items/{id}", [ProductVariantItemsResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_variant_items/{id}", [ProductVariantItemsResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Product Wishlist RESOURCES
    Route::get("product_wishlist", [ProductWishlistResourcesController::class, 'index']); // get entire collection
    Route::post("product_wishlist", [ProductWishlistResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("product_wishlist/trash", [ProductWishlistResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("product_wishlist/import", [ProductWishlistResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("product_wishlist/export", [ProductWishlistResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("product_wishlist/report", [ProductWishlistResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("product_wishlist/{id}/trashed", [ProductWishlistResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("product_wishlist/{id}/restore", [ProductWishlistResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_wishlist/{id}/delete", [ProductWishlistResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("product_wishlist/{id}", [ProductWishlistResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("product_wishlist/{id}", [ProductWishlistResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("product_wishlist/{id}", [ProductWishlistResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_wishlist/{id}", [ProductWishlistResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Product Variant Units RESOURCES
    Route::get("product_variant_units", [ProductVariantUnitsResourcesController::class, 'index']); // get entire collection
    Route::post("product_variant_units", [ProductVariantUnitsResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("product_variant_units/trash", [ProductVariantUnitsResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("product_variant_units/import", [ProductVariantUnitsResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("product_variant_units/export", [ProductVariantUnitsResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("product_variant_units/report", [ProductVariantUnitsResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("product_variant_units/{id}/trashed", [ProductVariantUnitsResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("product_variant_units/{id}/restore", [ProductVariantUnitsResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_variant_units/{id}/delete", [ProductVariantUnitsResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("product_variant_units/{id}", [ProductVariantUnitsResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("product_variant_units/{id}", [ProductVariantUnitsResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("product_variant_units/{id}", [ProductVariantUnitsResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("product_variant_units/{id}", [ProductVariantUnitsResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Promotions RESOURCES
    Route::get("promotions", [PromotionsResourcesController::class, 'index']); // get entire collection
    Route::get("promotions/check", [PromotionsResourcesController::class, 'check']); // get entire collection
    Route::post("promotions", [PromotionsResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("promotions/trash", [PromotionsResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("promotions/import", [PromotionsResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("promotions/export", [PromotionsResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("promotions/report", [PromotionsResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("promotions/{id}/trashed", [PromotionsResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("promotions/{id}/restore", [PromotionsResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("promotions/{id}/delete", [PromotionsResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("promotions/{id}", [PromotionsResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("promotions/{id}", [PromotionsResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("promotions/{id}", [PromotionsResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("promotions/{id}", [PromotionsResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Promotion bundle RESOURCES
    Route::get("promotion_bundle", [PromotionBundleResourcesController::class, 'index']); // get entire collection
    Route::post("promotion_bundle", [PromotionBundleResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("promotion_bundle/trash", [PromotionBundleResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("promotion_bundle/import", [PromotionBundleResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("promotion_bundle/export", [PromotionBundleResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("promotion_bundle/report", [PromotionBundleResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("promotion_bundle/{id}/trashed", [PromotionBundleResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("promotion_bundle/{id}/restore", [PromotionBundleResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("promotion_bundle/{id}/delete", [PromotionBundleResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("promotion_bundle/{id}", [PromotionBundleResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("promotion_bundle/{id}", [PromotionBundleResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("promotion_bundle/{id}", [PromotionBundleResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("promotion_bundle/{id}", [PromotionBundleResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Promotion usage RESOURCES
    Route::get("promotion_usage", [PromotionUsageResourcesController::class, 'index']); // get entire collection
    Route::post("promotion_usage", [PromotionUsageResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("promotion_usage/trash", [PromotionUsageResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("promotion_usage/import", [PromotionUsageResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("promotion_usage/export", [PromotionUsageResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("promotion_usage/report", [PromotionUsageResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("promotion_usage/{id}/trashed", [PromotionUsageResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("promotion_usage/{id}/restore", [PromotionUsageResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("promotion_usage/{id}/delete", [PromotionUsageResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("promotion_usage/{id}", [PromotionUsageResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("promotion_usage/{id}", [PromotionUsageResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("promotion_usage/{id}", [PromotionUsageResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("promotion_usage/{id}", [PromotionUsageResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Carts RESOURCES
    Route::get("carts", [CartsResourcesController::class, 'index']); // get entire collection
    Route::post("carts", [CartsResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("carts/trash", [CartsResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("carts/import", [CartsResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("carts/export", [CartsResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("carts/report", [CartsResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("carts/{id}/trashed", [CartsResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("carts/{id}/restore", [CartsResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("carts/{id}/delete", [CartsResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("carts/{id}", [CartsResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("carts/{id}", [CartsResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("carts/{id}", [CartsResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("carts/{id}", [CartsResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Orders RESOURCES
    Route::get("orders", [OrdersResourcesController::class, 'index']); // get entire collection
    Route::post("orders", [OrdersResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("orders/trash", [OrdersResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("orders/import", [OrdersResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("orders/export", [OrdersResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("orders/report", [OrdersResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("orders/{id}/trashed", [OrdersResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("orders/{id}/restore", [OrdersResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("orders/{id}/delete", [OrdersResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("orders/{id}", [OrdersResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("orders/{id}", [OrdersResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("orders/{id}", [OrdersResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("orders/{id}", [OrdersResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Transaction RESOURCES
    Route::get("transactions", [TransactionsResourcesController::class, 'index'])->middleware(['auth:api']); // get entire collection
    Route::post("transactions", [TransactionsResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("transactions/trash", [TransactionsResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("transactions/import", [TransactionsResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("transactions/export", [TransactionsResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("transactions/report", [TransactionsResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("transactions/{id}/trashed", [TransactionsResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("transactions/{id}/restore", [TransactionsResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("transactions/{id}/delete", [TransactionsResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("transactions/{id}", [TransactionsResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("transactions/{id}", [TransactionsResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("transactions/{id}", [TransactionsResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("transactions/{id}", [TransactionsResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Tracking Statuses RESOURCES
    Route::get("tracking_statuses", [TrackingStatusesResourcesController::class, 'index']); // get entire collection
    Route::post("tracking_statuses", [TrackingStatusesResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("tracking_statuses/trash", [TrackingStatusesResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("tracking_statuses/import", [TrackingStatusesResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("tracking_statuses/export", [TrackingStatusesResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("tracking_statuses/report", [TrackingStatusesResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("tracking_statuses/{id}/trashed", [TrackingStatusesResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("tracking_statuses/{id}/restore", [TrackingStatusesResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("tracking_statuses/{id}/delete", [TrackingStatusesResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("tracking_statuses/{id}", [TrackingStatusesResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("tracking_statuses/{id}", [TrackingStatusesResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("tracking_statuses/{id}", [TrackingStatusesResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("tracking_statuses/{id}", [TrackingStatusesResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: Tracking Orders RESOURCES
    Route::get("tracking_orders", [TrackingOrdersResourcesController::class, 'index']); // get entire collection
    Route::post("tracking_orders", [TrackingOrdersResourcesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("tracking_orders/trash", [TrackingOrdersResourcesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("tracking_orders/import", [TrackingOrdersResourcesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("tracking_orders/export", [TrackingOrdersResourcesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("tracking_orders/report", [TrackingOrdersResourcesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("tracking_orders/{id}/trashed", [TrackingOrdersResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("tracking_orders/{id}/restore", [TrackingOrdersResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("tracking_orders/{id}/delete", [TrackingOrdersResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("tracking_orders/{id}", [TrackingOrdersResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("tracking_orders/{id}", [TrackingOrdersResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("tracking_orders/{id}", [TrackingOrdersResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("tracking_orders/{id}", [TrackingOrdersResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID

});
