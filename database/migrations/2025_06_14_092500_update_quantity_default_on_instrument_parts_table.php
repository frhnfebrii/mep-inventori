<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateQuantityDefaultOnInstrumentPartsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('instrument_parts', function (Blueprint $table) {
            $table->integer('quantity')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instrument_parts', function (Blueprint $table) {
            // Balikin ke kondisi sebelum diubah default-nya
            $table->integer('quantity')->default(null)->change();
        });
    }
}
