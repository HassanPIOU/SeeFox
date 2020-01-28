<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$route->addGroup('/'. $langue->getLocale(), function ($route) {
    $route->addRoute("GET", "", [\App\Http\Controllers\frontend\HomeController::class, "index"]);
    $route->addRoute("POST", "", [\App\Http\Controllers\frontend\HomeController::class, "index"]);
});

