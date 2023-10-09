<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'indonesia_cities';
    protected $casts = [
        'meta' => 'array',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }
    public function districts()
    {
        return $this->hasMany(District::class, 'city_code', 'code');
    }
}
