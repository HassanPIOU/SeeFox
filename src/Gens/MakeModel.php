<?php

namespace Akuren\Gens;


class MakeModel
{

    private $path;


    /**
     * @return string
     */
    public function setPath()
    {
        $this->path = dirname($_SERVER['DOCUMENT_ROOT']).'/app/Models/';
        return $this->path;
    }

    public function make($filename)
    {
        if ( MakeFile::make($this->setPath(),$filename.'.php')){
            return true;
        }
        else{
            return false;
        }


    }

    public static function write($filename)
    {
        $guarded = '$guarded';

$text =
"<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ".ucfirst($filename)." extends Model
{
    protected $guarded = [];
}";

        if ((new MakeModel())->make($filename)){
            $handle = fopen((new MakeModel())->setPath().$filename.'.php', 'a+');
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