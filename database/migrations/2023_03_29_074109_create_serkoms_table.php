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
        Schema::create('serkoms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sertifikasi');
            $table->date('tgl_penerbitan');
            $table->date('masa_berlaku')->nullable();
            $table->integer('status_seumur_hidup')->default(0);
            $table->string('sertifikat');
            $table->string('status_serkom')->nullable();
            $table->foreignId('user_id');
            $table->unsignedBigInteger('penyelenggara_id');
            $table->unsignedBigInteger('skema_id');
            $table->foreign('penyelenggara_id')->references('id')->on('penyelenggaras')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('skema_id')->references('id')->on('skemas')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serkoms');
    }
};
