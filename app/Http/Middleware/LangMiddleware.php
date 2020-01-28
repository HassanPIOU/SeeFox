<?php


namespace App\Http\Middleware;


use Akuren\Session\Session;
use Akuren\translation\Translation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LangMiddleware implements  MiddlewareInterface
{

    /**
     * @var Translation
     */
    private $lang;
    /**
     * @var Session
     */
    private $session;

    public function __construct(Translation $lang, Session $session)
    {
        $this->lang = $lang;
        $this->session = $session;
    }

    /**
     * Process an incoming server request and return a response, optionally delegating
     * response creation to a handler.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process (ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getUri()->getPath();

        $req = explode("/", $path);
        $rest = "";

        for ($i = 2; $i < count($req); $i++){
            $rest .= "/".$req[$i];
        }

        if($path== "/"){
            if ($this->lang->getLocale() != $this->session->get('lang')) {
                $paths = $path.$this->session->get('lang');
                redirect($paths.$rest);
            }
            else{
                $paths = $path.$this->lang->getLocale();
                redirect($paths.$rest);
            }
        }

//        if ($path != "/".$this->lang->getLocale()){
//            $paths = $path.$this->lang->getLocale().$rest;
//            redirect($paths);
//        }

        else{
            return $handler->handle($request);
        }





    }
}