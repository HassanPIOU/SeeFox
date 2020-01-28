<?php


namespace Akuren\translation;

use Akuren\Session\Session;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;

class Translation
{

    private $langue;

    private $locale;

    public function setLanguage($local)
    {
        $translator = new Translator($local);
        $translator->addLoader('array', new ArrayLoader());
        $translator->addResource('array',$this->setFiles(),$local);
        return $translator;
    }




    private function setFiles()
    {
        $session = new Session();
       $ses = $session->get("lang");
        $l = strtolower($ses)."_".strtoupper($ses);

      return $this->fetchArray(dirname(dirname(__DIR__))."/lang/".$l.".php");
    }

    private function fetchArray($in)
    {
        if(is_file($in))
            return include $in;
        return false;
}


    public function defaultLang(){
        $session = new Session();
        $lang = $session->set("lang", "fr");
        return $lang;
    }

    public function setLangue($langue): void
    {
        $session = new Session();
       $session->set("lang", $langue);
        $this->langue = $session->get("lang");;
    }

    public function getLocale()
    {
        $session = new Session();
        $lang = $session->get("lang");
        $this->locale = $lang;
        return $lang;
     }


}