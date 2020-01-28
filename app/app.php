<?php


require  __DIR__."/../vendor/autoload.php";

// Start Session @session_start()

$session = new \Akuren\Session\Session();

$langue = new \Akuren\translation\Translation();



$router = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) use ($langue){

    // Web Router File Loading
    require __DIR__."/../routes/frontend.php";

    require  "Views/Gn/gnroute.php";

    require __DIR__."/../routes/backend.php";
    // Rest Api Router File Loading
    require __DIR__ . "/../Api/route/api.php";
});


$session->set('SeeFox', "framework");


$harmony = new WoohooLabs\Harmony\Harmony(Zend\Diactoros\ServerRequestFactory::fromGlobals(), new Zend\Diactoros\Response());








