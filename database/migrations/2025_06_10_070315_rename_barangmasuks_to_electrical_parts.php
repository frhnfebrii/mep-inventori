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
        Schema::rename('barangmasuks', 'electrical_parts');
    }

    public function down()  
    {
        Schema::rename('electrical_parts', 'barangmasuks');
    }

};
