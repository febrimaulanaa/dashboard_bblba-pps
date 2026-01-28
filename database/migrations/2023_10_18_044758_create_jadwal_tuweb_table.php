<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTuwebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_tuweb', function (Blueprint $table) {
            $table->id();
            $table->string('masa');
            $table->string('nim');
            $table->string('nama_mhs');
            $table->string('nama_tutor');
            $table->string('kode_matkul');
            $table->string('nama_matkul');
            $table->string('link_tuweb');
            $table->string('lokasi');
            $table->string('jam');
            $table->string('hari');
            $table->string('tangal_mulai');
            $table->string('tanggal_selesai');
            $table->string('keterangan');
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
        Schema::dropIfExists('jadwal_tuweb');
    }
}
