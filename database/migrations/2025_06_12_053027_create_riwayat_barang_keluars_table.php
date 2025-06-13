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
        Schema::create('riwayat_barang_keluars', function (Blueprint $table) {
            $table->id();

            // Tiga foreign key yang optional (nullable)
            $table->foreignId('electrical_part_id')->nullable()->constrained('electrical_parts')->onDelete('cascade');
            $table->foreignId('tools_part_id')->nullable()->constrained('tools_parts')->onDelete('cascade');
            $table->foreignId('instrument_part_id')->nullable()->constrained('instrument_parts')->onDelete('cascade');

            $table->integer('quantity');
            $table->string('unit');
            $table->date('tanggal');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_barang_keluars');
    }
};
