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
            $table->string('status_pengajuanserkom')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('penyelenggara_id');
            $table->unsignedBigInteger('skema_id');
            $table->unsignedBigInteger('periode_id');
            $table->unsignedBigInteger('jenis_sertifikasi_id');
            $table->foreign('penyelenggara_id')->references('id')->on('penyelenggaras')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('skema_id')->references('id')->on('skemas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('periode_id')->references('id')->on('periodes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('jenis_sertifikasi_id')->references('id')->on('jenis_sertifikasis')->cascadeOnDelete()->cascadeOnUpdate();
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
