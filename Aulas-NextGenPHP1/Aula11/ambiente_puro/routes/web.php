<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\SiteController::class, 'index']);

Route::get('/json', function () {
    return [
        'hello' => 'Hello World 123'
    ];
});

Route::get('/info', function () {
    phpinfo();
    return [
        'hello' => 'Hello World 123'
    ];
});
