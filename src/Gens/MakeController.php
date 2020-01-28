<?php
/**
 * Created by PhpStorm.
 * User: Stephane
 * Date: 08/09/2019
 * Time: 15:44
 */

namespace Akuren\Gens;


use App\Http\Handlers\Url\Baseurl;

class MakeController
{

    private $path;


    /**
     * @param $chemin
     * @return string
     */
    public function setPath($chemin)
    {
      $dirname = dirname($_SERVER['DOCUMENT_ROOT']).'/modules/'.ucfirst($chemin)."/Controller/";
        if (!file_exists($dirname)){
            mkdir($dirname, 777, true);
        }
        return $dirname;
    }


    /**
     * @param string $filename
     * @return bool
     */
    public  function make(string $filename)
    {
        if ( MakeFile::make($this->setPath($filename),$filename.'Controller.php')){
            return true;
        }
        else{
            return false;
        }
    }

    public static function write($filename)
    {
        $text = "<?php

namespace Module\Controller\\".$filename.";


use App\Http\Controllers\Controller;

class ".$filename."Controller extends Controller
{

}";
        if ((new MakeController())->make($filename)){
        $handle = fopen((new MakeController())->setPath($filename).$filename.'Controller.php', 'a+');
        if  ($handle !== false) {
            fwrite($handle, $text);
            fclose($handle);
            return true;
        }else{
            return false;
        }
        }
        else{
            return false;
        }

    }

}