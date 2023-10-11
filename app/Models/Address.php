<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public static function getProvince($code = null)
    {
        if ($code) {
            return Province::where('code', $code)->first();
        } else {
            return $provinces = Province::all();
        }
    }
}
