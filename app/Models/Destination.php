<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Destination extends Model
{
    use HasFactory;

    protected $table = 'destinations';

    protected $fillable = [
        'name',
        'description',
        'country',
        'city',
        'address',
        'price',
        'status',
        'registered_by',
    ];

    /**
     * Relación con los registros pivote (usando la tabla en plural)
     */
    public function traveler_destination(): HasMany
    {
        return $this->hasMany(TravelerDestination::class, 'destination_id');
    }

    /**
     * Relación directa con los viajeros a través de la tabla pivote en plural
     */
    public function travelers(): BelongsToMany
    {
        return $this->belongsToMany(Traveler::class, 'traveler_destinations', 'destination_id', 'traveler_id')
                    ->withTimestamps();
    }
}