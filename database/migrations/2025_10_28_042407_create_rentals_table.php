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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('unit_id')->constrained(); // Jangan cascade, agar data unit hilang tapi riwayat tetap ada
            $table->date('rental_date');
            $table->date('due_date'); // Req #12
            $table->date('return_date')->nullable();
            $table->enum('status', ['dipinjam', 'selesai', 'terlambat'])->default('dipinjam');
            $table->decimal('fine_amount', 10, 2)->default(0); // Req #12
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
