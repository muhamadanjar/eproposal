<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Jalansirip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('jalansirip', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jalan_admin_1',1)->nullable();
            $table->string('jalan_admin_1_file')->nullable();
            $table->string('jalan_admin_2',1)->nullable();
            $table->string('jalan_admin_2_file')->nullable();
            $table->string('jalan_admin_2a',1)->nullable();
            $table->string('jalan_admin_2b',1)->nullable();
            $table->string('jalan_admin_2c',1)->nullable();
            $table->string('jalan_admin_3',1)->nullable();
            $table->string('jalan_admin_3_file')->nullable();
            $table->string('jalan_admin_4',1)->nullable();
            $table->string('jalan_admin_4_file')->nullable();
            $table->string('jalan_admin_5',1)->nullable();
            $table->string('jalan_admin_5_file')->nullable();
            $table->string('jalan_admin_6',1)->nullable();
            $table->string('jalan_admin_6_file')->nullable();
            $table->string('jalan_admin_7',1)->nullable();
            $table->string('jalan_admin_7_file')->nullable();
            $table->string('jalan_admin_8',1)->nullable();
            $table->string('jalan_admin_8_file')->nullable();
            $table->string('jalan_admin_9',1)->nullable();
            $table->string('jalan_admin_9_file')->nullable();

            $table->string('jalan_teknis_1',1)->nullable();
            $table->string('jalan_teknis_1_file')->nullable();
            $table->string('jalan_teknis_1a',1)->nullable();
            $table->string('jalan_teknis_1b',1)->nullable();
            $table->string('jalan_teknis_1c',1)->nullable();
            $table->string('jalan_teknis_1d',1)->nullable();
            $table->string('jalan_teknis_1e',1)->nullable();
            $table->string('jalan_teknis_1f',1)->nullable();
            $table->string('jalan_teknis_1g',1)->nullable();
            $table->string('jalan_teknis_1h',1)->nullable();
            $table->string('jalan_teknis_1i',1)->nullable();
            $table->string('jalan_teknis_1j',1)->nullable();
            $table->string('jalan_teknis_1k',1)->nullable();
            $table->string('jalan_teknis_2',1)->nullable();
            $table->string('jalan_teknis_2_file')->nullable();
            $table->string('jalan_teknis_2a',1)->nullable();
            $table->string('jalan_teknis_2b',1)->nullable();
            $table->string('jalan_teknis_2c',1)->nullable();
            $table->string('jalan_teknis_2d',1)->nullable();
            $table->string('jalan_teknis_2e',1)->nullable();
            $table->string('jalan_teknis_2f',1)->nullable();
            $table->string('jalan_teknis_2g',1)->nullable();
            $table->string('jalan_teknis_2h',1)->nullable();
            $table->string('jalan_teknis_2i',1)->nullable();
            $table->string('jalan_teknis_2j',1)->nullable();
            $table->string('jalan_teknis_3',1)->nullable();
            $table->string('jalan_teknis_3_file')->nullable();
            $table->string('jalan_teknis_3a',1)->nullable();
            $table->string('jalan_teknis_3b',1)->nullable();
            $table->string('jalan_teknis_3c',1)->nullable();
            $table->string('jalan_teknis_4',1)->nullable();
            $table->string('jalan_teknis_4_file')->nullable();
            $table->string('jalan_teknis_5',1)->nullable();
            $table->string('jalan_teknis_5_file')->nullable();
            $table->string('jalan_teknis_6',1)->nullable();
            $table->string('jalan_teknis_6_file')->nullable();

            $table->integer('status')->default(0);
            $table->integer('user_id');
            $table->integer('usulan_id');
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
        Schema::dropIfExists('jalansirip');
    }
}
