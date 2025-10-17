<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->get('/health', function (Request $request) {
    return ['ok' => true];
});


