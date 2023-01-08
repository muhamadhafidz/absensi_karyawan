<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPersonaliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_personalias', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nama');
            $table->string('status');
            $table->string('gaji_perday');
            $table->unsignedBigInteger('master_jabatan_id')->nullable();
            $table->unsignedBigInteger('master_division_id')->nullable();
            $table->timestamps();


            $table->foreign('master_jabatan_id')->references('id')->on('master_jabatans')->onDelete('set null');
            $table->foreign('master_division_id')->references('id')->on('master_divisions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_personalias');
    }
}
