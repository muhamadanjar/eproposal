<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sab', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sab_admin_1',1)->nullable();
            $table->string('sab_admin_1_file',1)->nullable();
            $table->string('sab_admin_2',1)->nullable();
            $table->string('sab_admin_2a',1)->nullable();
            $table->string('sab_admin_2b',1)->nullable();
            $table->string('sab_admin_2c',1)->nullable();
            $table->string('sab_admin_3',1)->nullable();
            $table->string('sab_admin_4',1)->nullable();
            $table->string('sab_admin_5',1)->nullable();
            $table->string('sab_admin_6',1)->nullable();
            $table->string('sab_admin_7',1)->nullable();
            $table->string('sab_admin_8',1)->nullable();
            $table->string('sab_admin_9',1)->nullable();

            $table->string('sab_teknis_1',1)->nullable();
            $table->string('sab_teknis_1a',1)->nullable();
            $table->string('sab_teknis_1b',1)->nullable();
            $table->string('sab_teknis_1c',1)->nullable();
            $table->string('sab_teknis_1d',1)->nullable();
            $table->string('sab_teknis_1e',1)->nullable();
            $table->string('sab_teknis_1f',1)->nullable();
            $table->string('sab_teknis_1g',1)->nullable();
            $table->string('sab_teknis_1h',1)->nullable();
            $table->string('sab_teknis_1i',1)->nullable();
            $table->string('sab_teknis_1j',1)->nullable();

            $table->string('sab_teknis_2',1)->nullable();
            $table->string('sab_teknis_2a',1)->nullable();
            $table->string('sab_teknis_2b',1)->nullable();
            $table->string('sab_teknis_2c',1)->nullable();
            $table->string('sab_teknis_2d',1)->nullable();
            $table->string('sab_teknis_2e',1)->nullable();
            $table->string('sab_teknis_2f',1)->nullable();
            $table->string('sab_teknis_2g',1)->nullable();
            $table->string('sab_teknis_2h',1)->nullable();
            $table->string('sab_teknis_2i',1)->nullable();
            $table->string('sab_teknis_2j',1)->nullable();
            $table->string('sab_teknis_2k',1)->nullable();

            $table->string('sab_teknis_3',1)->nullable();
            $table->string('sab_teknis_3a',1)->nullable();
            $table->string('sab_teknis_3b',1)->nullable();
            $table->string('sab_teknis_3c',1)->nullable();
            $table->string('sab_teknis_4',1)->nullable();
            $table->string('sab_teknis_5',1)->nullable();
            $table->string('sab_teknis_6',1)->nullable();
            $table->string('sab_teknis_7',1)->nullable();
            $table->string('sab_teknis_8',1)->nullable();
            $table->string('sab_teknis_9',1)->nullable();

            
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
        Schema::dropIfExists('sab');
    }
}
