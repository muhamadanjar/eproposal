<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PJalan;
class Usulan extends Model{
    protected $table = 'usulan';
    protected $primaryKey = 'id';

    public function jalan(){
        return $this->hasMany('App\Jalan');
    }

    public function sab(){
        return $this->hasMany('App\SAB');
    }

    public function plts(){
        return $this->hasMany('App\PLTS');
    }

    public function pjalan(){
        return $this->belongsToMany(PJalan::class,'usulan_persyaratan_jalan','usulan_id','pjalan_id');
        //return $this->hasMany(PJalan::class);
    }

    public function addPersyaratanJalan($jalan){
        if (is_string($jalan)) {
            $jalan = PJalan::where('id', $jalan)->first();
        }
        return $this->pjalan()->attach($jalan);
    }

    public function removePersyaratanJalan($jalan){
        if (is_string($jalan)) {
            $jalan = PJalan::where('id', $jalan)->first();
        }
        return $this->pjalan()->detach($jalan);
    }

    
}
