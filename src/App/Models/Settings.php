<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    protected $table = 'settings';
    public $timestamps = false;

    public static function updateSettings($options)
    {
        foreach ($options as $opt => $val)
        {
            static::where('name', $opt)->update(['val' => $val]);
        }
    }

}
