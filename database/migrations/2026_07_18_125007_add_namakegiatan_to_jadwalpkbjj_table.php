<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamakegiatanToJadwalpkbjjTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwalpkbjj', function (Blueprint $table) {
            $table->string('nama_kegiatan')->nullable()->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwalpkbjj', function (Blueprint $table) {
            $table->dropColumn('nama_kegiatan');
        });
    }
}
