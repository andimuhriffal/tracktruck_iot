<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelLevelsTable extends Migration
{
    public function up()
    {
        Schema::create('fuel_levels', function (Blueprint $table) {
            $table->id();
            $table->float('jarak'); // Pastikan kolom ini ada
            $table->float('persentase_bahan_bakar'); // Pastikan kolom ini ada
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fuel_levels');
    }
}
