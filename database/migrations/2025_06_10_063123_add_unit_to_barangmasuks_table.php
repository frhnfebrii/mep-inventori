<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('barangmasuks', function (Blueprint $table) {
        $table->string('unit')->default('pcs')->after('quantity');
    });
}

public function down()
{
    Schema::table('barangmasuks', function (Blueprint $table) {
        $table->dropColumn('unit');
    });
}

};
