<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PJalan;
use Illuminate\Notifications\Notifiable;
class Usulan extends Model{
    use Notifiable;
    protected $table = 'usulan';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_proyek','surat_pengantar','opd_pengusul','latitude','longitude','jumlah_usulan'];
    
    public static $rules = array(
        'nama_proyek'=>'required|min:3',
        'surat_pengantar' => 'required',
        'opd_pengusul'=>'required',
        'latitude'=>'numeric|required',
        'longitude'=>'numeric|required',
        'jumlah_usulan' => 'numeric|required',
    );

    public function pjalan(){
        return $this->belongsToMany(PJalan::class,'usulan_persyaratan_jalan','usulan_id','pjalan_id');
        //return $this->hasMany(PJalan::class);
    }

    public function users(){
        return $this->hasMany('App\User');
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
