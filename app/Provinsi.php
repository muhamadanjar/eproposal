<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JW;
class Provinsi extends Model{
    protected $table = 'provinsi';

    public function wilayah(){
    	return $this->hasOne(App\JW::class);
    }
}
