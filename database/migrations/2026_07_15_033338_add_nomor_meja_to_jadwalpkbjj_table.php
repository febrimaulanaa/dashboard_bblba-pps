<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomorMejaToJadwalpkbjjTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwalpkbjj', function (Blueprint $table) {
            $table->string('nomor_meja')->nullable()->after('skema');
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
            $table->dropColumn('nomor_meja');
        });
    }
}
