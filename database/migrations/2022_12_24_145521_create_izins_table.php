<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_personalia_id');
            $table->date('tanggal_izin');
            $table->string('jenis_izin');
            $table->string('keterangan');
            $table->string('file_bukti');
            $table->string('status');
            $table->timestamps();

            $table->foreign('master_personalia_id')->references('id')->on('master_personalias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('izins');
    }
}
