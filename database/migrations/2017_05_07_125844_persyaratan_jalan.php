<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersyaratanJalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pjalan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no',10)->default(0);
            $table->string('slugusulan');
            $table->string('namausulan');
            $table->string('tipeusulan',10);
            $table->integer('status')->default(0);
            $table->integer('user_id')->nullable();
            
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
        Schema::dropIfExists('pjalan');
    }
}
