<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Wifi extends Model
{

    protected $table = 'wifi';
    public $timestamps = false;

    public static function write($pass)
    {
        $obj = new self();
        $obj->pass = $pass;
        $obj->created_time = (new DateTime())->format(DateTime::RFC822);
        $obj->save();
    }

    public static function clear()
    {
        return self::truncate();
    }

}
