<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Lang;

use App\Usulan;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\InsertDataUsulan;
use App\Mail\UpdateDataUsulan;
use App\Mail\UsulanDisetujui;

trait SendEmailsEproposal
{	
	public function sendEmailAddDataUsulan($usulan_id){
        $usulan = Usulan::findOrFail($usulan_id);
        $user = User::findOrFail($usulan->user_id);

        Mail::to($user->email)->send(new InsertDataUsulan($usulan));
    }


    public function sendEmailUpdateDataUsulan($usulan_id){
        $usulan = Usulan::findOrFail($usulan_id);
        $user = User::findOrFail($usulan->user_id);

        Mail::to($user->email)->send(new UpdateDataUsulan($usulan));
    }

    public function sendEmailUsulanDisetujui($usulan_id){
        $usulan = Usulan::findOrFail($usulan_id);
        $user = User::findOrFail($usulan->user_id);

        Mail::to($user->email)->send(new UsulanDisetujui($usulan));
    }


    
}