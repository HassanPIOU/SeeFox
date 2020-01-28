<?php

$route->addRoute('GET', '/'.$langue->getLocale()."/gn", [\App\Http\Controllers\GnController::class, 'index']);
$route->addRoute('GET', '/'.$langue->getLocale()."/gn/database", [\App\Http\Controllers\GnController::class, 'database']);
$route->addRoute('GET', '/'.$langue->getLocale()."/gn/module", [\App\Http\Controllers\GnController::class, 'module']);

