<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('laravel-meilisearch::app');
});
