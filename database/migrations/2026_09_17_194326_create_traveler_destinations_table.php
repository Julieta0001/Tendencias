<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('traveler_destinations', function (Blueprint $table) {
            $table->id();
    
    
            $table->foreignId('traveler_id')->constrained();
            $table->foreignId('destination_id')->constrained();
            $table->date('travel_date'); 
            $table->date('return_date')->nullable(); 
            $table->decimal('price_paid', 10, 2)->nullable(); 
            $table->string('notes')->nullable(); 
             $table->enum('payment_type', ['contado', 'credito'])->default('contado');
            $table->decimal('pending_balance', 10, 2)->default(0.00)->nullable();
            $table->string('registered_by');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traveler_destinations');
    }
};
