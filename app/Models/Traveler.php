<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'document', 'email', 'password', 'photo', 'phone', 'address', 'status', 'registered_by'])]
#[Hidden(['password', 'remember_token', 'status', 'registered_by'])]

class Traveler extends Model
{
    use HasFactory;

    protected $table = 'travelers';
    protected $primaryKey = 'id';

    public function traveler_destination(): HasMany
    {
        return $this->hasMany(TravelerDestination::class, 'traveler_id');
    }

    /**
     * Relación directa con los destinos a los que se ha inscrito el viajero
     */
    public function destinations(): BelongsToMany
    {
        return $this->belongsToMany(Destination::class, 'traveler_destination')
                    ->withPivot('registered_by')
                    ->withTimestamps();
    }
}