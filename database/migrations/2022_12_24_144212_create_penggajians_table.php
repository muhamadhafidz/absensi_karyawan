<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggajiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_personalia_id')->nullable();
            $table->string('gaji_perday');
            $table->integer('total_day');
            $table->string('total_gaji');
            $table->date('tanggal_penggajian');
            $table->timestamps();

            $table->foreign('master_personalia_id')->references('id')->on('master_personalias')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penggajians');
    }
}
