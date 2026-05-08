<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_pegawais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_pemantau')->nullable();
            $table->string('jenis_tutorial')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('jam_tutorial')->nullable();
            $table->string('pertemuan_ke')->nullable();
            $table->string('kode_nama_matkul_kelas')->nullable();
            $table->string('id_kelas_tutorial')->nullable();
            $table->string('id_tutor')->nullable();
            $table->string('nama_tutor')->nullable();
            $table->string('tgl_jam_mulai_pantau')->nullable();
            $table->integer('jml_mhs_seharusnya')->nullable();
            $table->integer('jml_mhs_hadir')->nullable();
            $table->string('jenis_pemantauan')->nullable();
            $table->string('kbm_absensi')->nullable();
            $table->string('kbm_materi')->nullable();
            $table->string('kbm_media')->nullable();
            $table->string('kbm_diskusi')->nullable();
            $table->string('kbm_pengarahan')->nullable();
            $table->string('bahas_tugas')->nullable();
            $table->string('jam_akhir_pantau')->nullable();
            $table->text('praktik_baik')->nullable();
            $table->text('temuan_ketidaksesuaian')->nullable();
            $table->text('kesan_pembelajaran')->nullable();
            $table->text('kendala_tutorial')->nullable();
            $table->text('saran_perbaikan')->nullable();
            $table->string('file_materi')->nullable();
            $table->string('file_peserta')->nullable();
            $table->string('link_video')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
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
        Schema::dropIfExists('absensi_pegawais');
    }
}
