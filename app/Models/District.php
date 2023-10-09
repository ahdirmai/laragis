<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'indonesia_districts';
    protected $casts = [
        'meta' => 'array',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_code', 'code');
    }
    public function villages()
    {
        return $this->hasMany(Village::class, 'district_code', 'code');
    }
}
