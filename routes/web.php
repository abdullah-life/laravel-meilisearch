<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;


Route::prefix('laravel-meilisearch')->middleware(['web', 'auth'])->group(function () {

    Route::get('/', function () {
        return view('laravel-meilisearch::app');
    });

    Route::get('/indexes', function () {

        return Http::withToken(config('laravel-meilisearch.key'))->get(config('laravel-meilisearch.host') . "/stats")->json();
    });

    Route::get('/index/{index}', function () {
        sleep(1);
        $pagination = "&offset=" . (request('skip') ?? 0) . "&limit=" . (request('take') ?? 20);
        return Http::withToken(config('laravel-meilisearch.key'))->get(config('laravel-meilisearch.host') . "/indexes/" . request('index') . "/search?q=" . request('q') . $pagination)->json();
    });
});
