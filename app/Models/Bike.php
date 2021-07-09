<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bike extends Model {

    use HasFactory;

    protected $fillable = ['id'];

    public function states(): HasMany {
        return $this->hasMany(BikeState::class, 'bike_id', 'id');
    }
}
