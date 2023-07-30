<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| php artisan make:model --migration --controller --seed Department --resource --api
|
*/

Route::get('/wa', function(){
    Http::post('http://103.30.145.195:8080/send-text', [
        'number' => '6285746080544@s.whatsapp.net',
        'text' => '$message',
    ]);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/me', function(Request $request){
        // return $request->user()->id;
        return $request->user();
    });
    Route::resource('transaction', TransactionController::class)->except(['destroy']);
    Route::get('/balance/{id}', [TransactionController::class, 'balance']);
    Route::get('/edit/{id}', [TransactionController::class, 'edit']);
    Route::resource('user', UserController::class);
    Route::resource('customer', CustomerController::class);
});
Route::post('/login', [UserController::class, 'login']);
Route::post('/masuk', [CustomerController::class, 'masuk']);
