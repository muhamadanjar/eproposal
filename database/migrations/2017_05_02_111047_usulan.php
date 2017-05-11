<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kode_provinsi');
            $table->string('kode_kabupaten',6);
            $table->string('kode_kecamatan',10);
            $table->string('skpd_pengusul');
            $table->string('desa');
            $table->float('lat');
            $table->float('lng');
            $table->string('penerima_manfaat');
            $table->string('penerima_manfaat_satuan',10);
            $table->integer('jenis_usulan');
            $table->string('jumlah_usulan');
            $table->integer('tahun_usulan');
            
            $table->string('dokumen')->nullable();
            $table->integer('user_id');
            $table->integer('status_usulan',1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usulan');
    }
}
