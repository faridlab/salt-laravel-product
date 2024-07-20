<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use SaltProduct\Controllers\ProductResourcesController;
use SaltProduct\Controllers\ShowcasesResourcesController;
use SaltProduct\Controllers\BrandsResourcesController;

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

});
