<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BikeState extends Model {

    use HasFactory;

    protected $fillable = ['bike_id', 'latitude', 'longitude', 'active', 'state'];
    protected $casts    = [
        'active'    => 'boolean',
        'latitude'  => 'float',
        'longitude' => 'float',
    ];

    public function bike(): BelongsTo {
        return $this->belongsTo(Bike::class, 'bike_id', 'id');
    }

}
