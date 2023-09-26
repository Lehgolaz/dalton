<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::apiResource('/countries', CountryController::class);
Route::apiResource('/states', StateControllerlertroller::class);
Route::apiResource('/cities', CityControllerller::class);
Route::apiResource('/neighborhoods', NeighborhoodrhoodController::class);
Route::apiResource('/zip-codes', ZipCodeControllertroller::class);
Route::apiResource('/entities', EntityControllerller::class);
Route::apiResource('/address', AddressControllerller::class);
Route::apiResource('/budget-types', BudgetTypeypeController::class);
Route::apiResource('/product-types', ProductctController::class);
Route::apiResource('/products', ProductControllertroller::class);
Route::apiResource('/stores', StoreController::class);
Route::apiResource('/budget-details', BudgetetDetailController::class);
Route::apiResource('/price-list', PriceListControllertroller::class);
