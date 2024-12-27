<?php

use App\Http\Controllers\academicController;
use App\Http\Controllers\formControler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CorsMiddleware;

Route::middleware([CorsMiddleware::class])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    
    Route::get("/show",[formControler::class,'show']);
    Route::get("/academic-show",[academicController :: class,'show']);
    
    Route::post('/store',[formControler::class,'store']);
    
    Route::post('/academic-store',[academicController::class,'store']);

    Route::view('/register',[formControler::class,'register']);
    
    Route::put('/update-password',[formControler::class,'update']);

    Route::post('/login',[formControler::class,'login']);

    Route::post('/get-data',[formControler::class,'getData']);

    Route::post('/updateData',[formControler::class,'updateData']);

    Route::get('/latest',[formControler::class,'latest']);
});



