<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained('certificate_participants')->cascadeOnDelete();
            $table->string('status'); // e.g., 'email_sent', 'pdf_generated', 'failed'
            $table->text('message')->nullable();
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
        Schema::dropIfExists('certificate_logs');
    }
}
