<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->file(resource_path('views/dist/index.html'));
});
