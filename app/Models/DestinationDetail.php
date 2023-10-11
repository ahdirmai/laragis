<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationDetail extends Model
{
    use HasFactory;

    protected $casts = [
        'detail' => 'array',
    ];
    protected $fillable = [
        'destination_id',
        'open_day_type',
        'open_time_type',
        'detail',
    ];

    protected function data(): Attribute

    {

        return Attribute::make(

            get: fn ($value) => json_decode($value, true),

            set: fn ($value) => json_encode($value),

        );
    }
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
