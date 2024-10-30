<?php

use App\Http\Controllers\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get("/categories", [CategoryController::class, 'index']);
Route::get("/categories/{id}", [CategoryController::class, 'show']);
Route::post("/categories", [CategoryController::class, 'store']);
Route::put("/categories", [CategoryController::class, 'update']);
Route::delete("/categories", [CategoryController::class, 'remove']);
