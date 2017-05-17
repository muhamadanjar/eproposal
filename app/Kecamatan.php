<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    function provinsi(){
    	return $this->belongsTo(App\Provinsi::class);
    }
}
