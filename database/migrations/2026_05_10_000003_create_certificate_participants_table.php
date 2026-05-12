<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('certificate_events')->cascadeOnDelete();
            $table->string('name');
            $table->string('nim');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('study_program')->nullable();
            $table->string('faculty')->nullable();
            $table->string('certificate_number')->nullable()->unique();
            $table->string('certificate_path')->nullable();
            $table->boolean('email_sent')->default(false);
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
            
            // Unique constraint to prevent duplicate submissions for the same event
            $table->unique(['event_id', 'nim'], 'unique_event_nim');
            $table->unique(['event_id', 'email'], 'unique_event_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificate_participants');
    }
}
