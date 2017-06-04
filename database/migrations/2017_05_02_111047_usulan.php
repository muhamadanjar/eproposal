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
            $table->bigInteger('no_usulan')->default(0);
            $table->integer('kode_provinsi');
            $table->string('kode_kabupaten',6);
            $table->string('kode_kecamatan',10);
            $table->string('nama_proyek');
            $table->string('surat_kegiatan');
            $table->string('opd_pengusul');
            $table->string('desa');
            $table->float('lat');
            $table->float('lng');
            $table->string('penerima_manfaat')->nullable();
            $table->string('penerima_manfaat_satuan',10)->nullable();
            $table->decimal('penerima_manfaat_kk')->nullable();
            $table->decimal('penerima_manfaat_jiwa')->nullable();
            $table->decimal('penerima_manfaat_km')->nullable();
            $table->decimal('penerima_manfaat_ha')->nullable();
            $table->integer('jenis_usulan');
            $table->double('jumlah_usulan');
            $table->double('jumlah_usulan_diterima')->nullable();
            $table->integer('tahun_usulan');
            
            $table->string('dokumen')->nullable();
            $table->integer('user_id');
            $table->integer('status_usulan')->default(0);
            $table->string('keterangan')->nullable();
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
