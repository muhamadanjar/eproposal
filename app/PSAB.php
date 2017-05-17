<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usulan;
class PSAB extends Model{
    protected $table = 'psab';

    public function usulan()
    {
        return $this->belongsToMany(Usulan::class);
    }
}
