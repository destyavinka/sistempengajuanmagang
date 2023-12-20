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
        Schema::create('magangs', function (Blueprint $table) {
            $table->id();
            $table->string('topik_magang');
            $table->date('tgl_daftar');
            $table->date('tgl_pelaksanaan');
            $table->string('sertifikat');
            $table->date('tgl_penerbitan');
            $table->date('masa_berlaku')->nullable();
            $table->integer('status_seumur_hidup')->default(0);
            $table->string('status_magang')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('instansi_id');
            $table->unsignedBigInteger('skema_id');
            $table->unsignedBigInteger('periode_id');
            $table->foreign('instansi_id')->references('id')->on('instansis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('skema_id')->references('id')->on('skemas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('periode_id')->references('id')->on('periodes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magangs');
    }
};
