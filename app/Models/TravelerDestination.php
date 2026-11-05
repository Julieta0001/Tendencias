<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'traveler_id', 
    'destination_id', 
    'travel_date', 
    'return_date', 
    'price_paid', 
    'notes', 
    'payment_type', 
    'pending_balance', 
    'registered_by'
])]
#[Hidden(['registered_by'])]
class TravelerDestination extends Model
{
    use HasFactory;

    // Usamos la tabla que tiene los 94 registros
    protected $table = 'traveler_destinations';

    protected $primaryKey = 'id';

    public function traveler(): BelongsTo
    {
        return $this->belongsTo(Traveler::class, 'traveler_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}

            