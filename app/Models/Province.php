<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'indonesia_provinces';
    protected $casts = [
        'meta' => 'array',
    ];

    public function cities()
    {
        return $this->hasMany(City::class, 'province_code', 'code');
    }
}
