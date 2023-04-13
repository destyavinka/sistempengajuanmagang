<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_serkoms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sertifikasi');
            $table->date('tgl_pelaksanaan');
            $table->string('anggaran');
            $table->string('TOR');
            $table->string('status_pengajuanserkom');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('penyelenggara_id');
            $table->foreign('jenis_sertifikasi_id')->references('id')->on('jenis_sertifikasis')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_sertifikasi_id');
            $table->foreign('penyelenggara_id')->references('id')->on('penyelenggaras')->onDelete('cascade');
            $table->unsignedBigInteger('skema_id');
            $table->foreign('skema_id')->references('id')->on('skemas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_serkoms');
    }
};
