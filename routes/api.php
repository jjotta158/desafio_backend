<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("sale")->group(function() {
    Route::get("/",function(Request $request) {
        return SaleController::getAllSales();
    });

    Route::get("/{idSale}",function($idSale) {
        return SaleController::getSaleById($idSale);
    });

    Route::post("/", function(Request $request) {
        return SaleController::addSale($request->id_seller, $request->value);
    });

    Route::put("/", function(Request $request) {
        return SaleController::editSale($request->id, $request->columnsToChange,$request->values);
    });

    Route::delete("/{saleId}", function($saleId) {
        return SaleController::deleteSale($saleId);
    });
});



Route::prefix("seller")->group(function() {
    Route::get("/",function(Request $request) {
        return SellerController::getAllSellers();
    });

    Route::get("/{sellerId}",function($sellerId) {
        return SellerController::getSellerById($sellerId);
    });

    Route::post("/", function(Request $request) {
        return SellerController::addSeller($request->name, $request->email);
    });

    Route::put("/", function(Request $request) {
        return SellerController::editSeller($request->sellerId, $request->columnsToChange,$request->values);
    });

    Route::delete("/{sellerID}", function($sellerId) {
        return SellerController::deleteSeller($sellerId);
    });
});
