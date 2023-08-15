<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('ping', function () {
        return response()->json([
            'success' => true,
        ], 200);
    });

    includeRouteFiles(__DIR__ . '/admin/');

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});
