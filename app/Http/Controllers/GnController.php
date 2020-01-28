<?php
/**
 * Created by PhpStorm.
 * User: Stephane De Jesus
 * Date: 24/01/2020
 * Time: 15:17
 */

namespace App\Http\Controllers;


use AkConfig\config\Config;
use Akuren\Gens\MakeController;
use Akuren\Gens\MakeModel;
use Akuren\Gens\MakeView;
use App\Views\View;
use PDO;
use Psr\Http\Message\ServerRequestInterface;

class GnController extends Controller
{

    public function index(){
        $dossier = dirname(dirname(dirname(__DIR__))).'/modules';
        $modules = [];
       if (is_dir($dossier)){
        $modul =    $this->dirToArray($dossier);

        foreach($modul as $key){
            array_push($modules, ["module" => ucfirst($key) ]);
        }
       }

        return View::render("index", compact('modules'));
    }


   private function dirToArray($dir) {

        $result = array();

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value)
        {
            if (!in_array($value,array(".","..")))
            {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                {
                    $result[$key] =  $value;
                }
                else
                {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }


    public function database()
    {

    $stmt = $this->connexion()->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =:dbname");
    $stmt->execute(array(":dbname"=>Config::DB_NAME));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() == 1)
    {
        echo "false";
    }
    else {
        $result = $this->connexion()->exec("CREATE DATABASE IF NOT EXISTS ".Config::DB_NAME);

        if ($result){
            echo "true";
        }else{
            echo "false2";
        }
        die;
    }

        die;
    }


    public function module(ServerRequestInterface $request){
       $params = $request->getQueryParams();
       $module =ucfirst($params['module']);
       $table =$params['table'];

       $tablecreate = false;
         if($table == 1){
             $connection = new PDO("mysql:host=localhost;dbname=".Config::DB_NAME, Config::DB_USER, Config::DB_PASS);
             $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $connection->exec("CREATE TABLE IF NOT EXISTS ".strtolower($module)."s");
             $sql = "CREATE TABLE IF NOT EXISTS ".strtolower($module)."s(
                                            `id` int(11) NOT NULL
                                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                                            
                                            ALTER TABLE ".strtolower($module)."s
                             MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";

             $connection->exec($sql);
           }


        if (MakeController::write($module) && MakeModel::write($module) && MakeView::write("index", $module)&& MakeView::write("detail", $module)){
            echo  ucfirst($module);
            die;
        }else{
            echo "false";
            die;

        }
    }


    private function connexion(){
        $connection = new PDO("mysql:host=localhost", Config::DB_USER, Config::DB_PASS);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $connection;
    }
}