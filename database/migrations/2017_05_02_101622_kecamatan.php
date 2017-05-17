<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kecamatan extends Migration{
    
    public function up(){
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_kabupaten',6);
            $table->string('kode_kecamatan',10);
            $table->string('kecamatan');
            $table->integer('isactived')->default(0);
            $table->integer('lokpri')->default(0)->nullable();
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
        Schema::dropIfExists('kecamatan');
    }
}
