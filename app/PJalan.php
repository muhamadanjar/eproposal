<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usulan;
class PJalan extends Model{
    protected $table = 'pjalan';

    public function usulan()
    {
        return $this->belongsToMany(Usulan::class);
    }
}
