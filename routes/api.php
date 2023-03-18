<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CustomerController,
    NoteController,
    ProjectController,
    InvoiceController,
    Auth\UserController,
    Auth\LoginController,
    Auth\LogoutController,
};
 

Route::post('register', [UserController::class, 'store']);
Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'customers'], function() {
    
    Route::get('', [CustomerController::class, 'index']);
    Route::get('/{id}', [CustomerController::class, 'show']);
    Route::post('', [CustomerController::class, 'store']);
    Route::patch('/{id}', [CustomerController::class, 'update']);
    Route::delete('/{id}', [CustomerController::class, 'destroy']);
    Route::post('/export', [CustomerController::class , 'export']);

    Route::group(['prefix'=>'/{customerId}'], function(){
        Route::group(['prefix' => '/notes'], function() {
        Route::get('', [NoteController::class, 'index']);
        Route::get('/{id}', [NoteController::class, 'show']);
        Route::post('', [NoteController::class, 'store']);
        Route::patch('/{id}', [NoteController::class, 'update']);
        Route::delete('/{id}', [NoteController::class, 'destroy']);
        });
        Route::group(['prefix' => '/projects'], function(){
        Route::get('', [ProjectController::class, 'index']);
        Route::get('/{id}', [ProjectController::class, 'show']);
        Route::post('', [ProjectController::class, 'store']);
        Route::patch('/{id}', [ProjectController::class, 'update']);
        Route::delete('/{id}', [ProjectController::class, 'destroy']);
        });
        Route::group(['prefix' => '/invoices'], function(){
        Route::get('', [InvoiceController::class, 'index']);
        Route::get('/{id}', [InvoiceController::class, 'show']);
        Route::post('', [InvoiceController::class, 'store']);
        Route::patch('/{id}', [InvoiceController::class, 'update']);
        Route::delete('/{id}', [InvoiceController::class, 'destroy']);
        });
    });
});
Route::post('logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');


 