<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationHasFacility extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
