<?php


namespace App\Views\Extensions;


use Akuren\Session\Session;
use Akuren\translation\Translation;
use Akuren\translation\Translate;
use Symfony\Component\Translation\Translator;

class LanguageExtension extends \Twig_Extension
{

    public function getFunctions() : array
    {
        return [
            new \Twig_SimpleFunction('lang', [$this , 'language'], ['is_safe' => ['html']])
        ];
    }

    public function language($value)
    {
        $ses = (new Session())->get("lang");
      $l = strtolower($ses)."_".strtoupper($ses);
        $trans = new Translation();
        $translator =  $trans->setLanguage($l);
        return $translator->trans($value);
    }

}