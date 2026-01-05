<?php

use App\Models\Apartment;
use App\Models\User;
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
        Schema::create('rental_bids', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 11, 2);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Apartment::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_bids');
    }
};
