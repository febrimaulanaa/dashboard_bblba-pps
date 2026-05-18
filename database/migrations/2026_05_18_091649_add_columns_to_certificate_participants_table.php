<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCertificateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificate_participants', function (Blueprint $table) {
            $table->string('verification_code')->nullable()->unique()->after('certificate_path');
            $table->timestamp('email_sent_at')->nullable()->after('email_sent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificate_participants', function (Blueprint $table) {
            $table->dropColumn(['verification_code', 'email_sent_at']);
        });
    }
}
