<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SoapController;
use App\Models\Country;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('countries', CountryController::class);

Route::get('countries/logs', [CountryController::class, 'logs'])->name('countries.logs');

Route::middleware('auth:api')->post('/soap', [SoapController::class, 'server']);


// url will be stored dynamically in each request header and passed to the webhook
Route::post('/callback', function (Request $request) {
    \Log::info('Callback received', $request->all());
    return response()->json(['message' => 'Callback received successfully'], 200);
});


// create country
Route::get('/create-country', function () {
    Country::create([
        'name' => 'Germany',
        'code' => 'DE'
    ]);
});

// update country
Route::get('/update-country/{id}', function ($id) {
    $country = Country::find($id);
    $country->name = 'France';
    $country->save();
});

