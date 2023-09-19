<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\ZipCodeController;
use App\Models\Budget;
use App\Models\BudgetType;
use App\Models\Country;
use App\Models\Entity;
use App\Models\Neighborhood;
use App\Models\Product;
use App\Models\ZipCode;
use App\Policies\NeighborhoodPolicy;
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



Route::apiResource('/countries', CountryControllerroller::class);
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
