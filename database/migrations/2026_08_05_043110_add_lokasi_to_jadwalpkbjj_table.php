<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLokasiToJadwalpkbjjTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwalpkbjj', function (Blueprint $table) {
            $table->string('lokasi')->nullable()->after('no_urut');
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
            $table->dropColumn('lokasi');
        });
    }
}
