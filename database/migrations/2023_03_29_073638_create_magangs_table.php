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
            $table->string('topik_magang')->nullable();
            $table->date('tgl_penerbitan');
            $table->date('masa_berlaku');
            $table->string('sertifikat');
            $table->string('status_magang')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('instansi_id')->nullable();
            $table->foreignId('skema_id')->nullable();
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
