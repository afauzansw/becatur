<?php

use App\Models\Driver;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Driver::class)->nullable();
            $table->string('start_address');
            $table->decimal('start_latitude', 10, 8);
            $table->decimal('start_longitude', 11, 8);
            $table->string('mid_address')->nullable();
            $table->decimal('mid_latitude', 10, 8)->nullable();
            $table->decimal('mid_longitude', 11, 8)->nullable();
            $table->string('end_address');
            $table->decimal('end_latitude', 10, 8);
            $table->decimal('end_longitude', 11, 8);
            $table->integer('total_price')->default(0); // tambahnkan 3 digit dibelakang coma untukidentifikasi
            $table->enum('status', [Reservation::status])->default(Reservation::status['created']);
            $table->string('cancelation_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
