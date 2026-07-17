<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWaktuAndNourutToJadwalpkbjjTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwalpkbjj', function (Blueprint $table) {
            $table->string('waktu')->nullable()->after('tanggal');
            $table->string('no_urut')->nullable()->after('nomor_meja');
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
            $table->dropColumn(['waktu', 'no_urut']);
        });
    }
}
