<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekertians', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_sertifikat');
            $table->date('tgl_pelaksanaan');
            $table->string('sertifikat');
            $table->date('tgl_penerbitan');
            $table->string('status_pekerti')->nullable();
            $table->integer('status_seumur_hidup')->default(0);
            $table->date('masa_berlaku')->nullable();
            
            $table->string('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pekertians');
    }
};
