<?php

namespace App\Http\Controllers\frontend;

use Akuren\Mail\Mail;
use Akuren\Session\Session;
use Akuren\translation\Translation;
use App\Http\Controllers\Controller;
use App\Views\View;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;

class HomeController extends  Controller
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
           $this->changeLanguage('fr');
            return  View::render('welcome');
   }
}