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


$route->addGroup('/'.$langue->getLocale().'/admin', function ($route) {
    $route->addRoute('GET', '', [\App\Http\Controllers\backend\AdminController::class, 'index']);
});