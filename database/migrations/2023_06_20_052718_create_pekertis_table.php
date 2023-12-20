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
        Schema::create('pekertis', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pelaksanaan');
            $table->string('sertifikat');
            $table->string('status_pekerti')->nullable();
            $table->date('masa_berlaku')->nullable();
            $table->integer('status_seumur_hidup')->default(0);
            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pekertis');
    }
};
