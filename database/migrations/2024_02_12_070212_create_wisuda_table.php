<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWisudaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisuda', function (Blueprint $table) {
            $table->id();
            $table->string('kelompok');
            $table->string('no_urut_ijazah');
            $table->string('nim');
            $table->string('nama');
            $table->string('no_meja_ambil_ijazah');
            $table->string('prodi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wisuda');
    }
}
