<?php
/**
 * Created by PhpStorm.
 * User: Stephane
 * Date: 08/09/2019
 * Time: 15:49
 */

namespace Akuren\Gens;


class MakeView
{

private $path;


    /**
     * @param $dirname
     * @return string
     */
    private function setPath($dirname)
    {

        $path = dirname($_SERVER['DOCUMENT_ROOT']).'/modules/'.ucfirst($dirname)."/View/";

        if (!file_exists($path)){
            mkdir($path, 777, true);
        }
       return $path;
    }


    public function make($filename, $dirname)
    {
        if (MakeFile::make($this->setPath($dirname), $filename . '.twig')) {
            return true;
        } else {
            return false;
        }
    }

        public static function write($filename, $dirname)
    {

        $text =
            "
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

      <h2>".dirname($_SERVER['DOCUMENT_ROOT']).'/modules/'.ucfirst($dirname)."/View/".$filename."</h2>
             
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

";

        if ((new MakeView())->make($filename, $dirname)){
            $handle = fopen((new MakeView())->setPath($dirname).$filename.'.twig', 'a+');
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