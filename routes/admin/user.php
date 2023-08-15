<?php

use App\Http\Controllers\Api\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('users', UserController::class, ['only' => ['index', 'store', 'show', 'destroy', 'update']]);
});
