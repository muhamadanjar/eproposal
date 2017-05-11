<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsulanPersyaratanSab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_persyaratan_sab', function (Blueprint $table) {
            $table->unsignedInteger('psab_id');
            $table->unsignedInteger('usulan_id');
            $table->unsignedInteger('isi');
            $table->string('file')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedInteger('verifikasi')->default(0);
            //$table->foreign('pjalan_id')->references('id')->on('pjalan')->onDelete('cascade');
            //$table->foreign('usulan_id')->references('id')->on('usulan')->onDelete('cascade');
        
            $table->primary(['psab_id', 'usulan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usulan_persyaratan_sab');
    }
}
