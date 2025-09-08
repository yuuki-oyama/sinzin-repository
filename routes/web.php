<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalcController;

Route::get('/calc', [CalcController::class, 'index']);   // フォーム表示
Route::post('/calc', [CalcController::class, 'calculate']); // 計算処理
