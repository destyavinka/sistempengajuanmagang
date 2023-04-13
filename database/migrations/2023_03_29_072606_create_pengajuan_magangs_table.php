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
        Schema::create('pengajuan_magangs', function (Blueprint $table) {
            $table->id();
            $table->string('topik_magang');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('anggaran');
            $table->string('status_pengajuanmagang')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('instansi_id')->nullable();
            $table->foreignId('skema_id')->nullable();
            // $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_magangs');
    }
};
