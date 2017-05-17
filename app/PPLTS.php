<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usulan;
class PPLTS extends Model{
    protected $table = 'pplts';

    public function usulan()
    {
        return $this->belongsToMany(Usulan::class);
    }
}
