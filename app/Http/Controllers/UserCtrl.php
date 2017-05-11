<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use App\Provinsi;

class UserCtrl extends Controller
{
    public function __construct($value=''){
        $this->middleware('auth');
        
    }
    

    public function getIndex(){
        if (! $this->authorize('create.user')) {
           return "I can't create new user :(";
        }
        session(['route_link' => 'normal']);
        
        $provinsi = Provinsi::orderBy('kode_provinsi','ASC')->get();

        $user = User::get();
        return view('master.userList')
            ->withProvinsi($provinsi)
            ->withUsers($user);
    }

    
    public function getTambah(){
        $role = Role::get();
        $status = 'add';
        session(['aksi'=>$status]);
        $provinsi = provinsi::orderBy('kode_provinsi','ASC')->get();
        return view('master.userAddEdit')
        ->withRole($role)
        ->withProvinsi($provinsi)
        ->withStatus($status);
    }

    public function postAddEdit(Request $request){
        if ($request->isMethod('post')) {
            if($request->exists('image')){
                $fileName = str_random(20) . '.' . $request->file('image')->getClientOriginalExtension();
            }
                
            $status = 0;
            $aksi = (session('aksi') == 'edit') ? 1 : 0;
            if ($aksi) {
                $user = User::find($request->id);
                if($request->exists('image')){
                    if(isset($user->image)){
                        $check_image = file_exists(public_path().'/images/users/'.$user->image);
                        if($check_image) unlink(public_path().'/images/users/'.$user->image);
                    }
                    
                    $this->ahelper->UploadImage($request->file('image'),'images/users',$fileName);
                    //$this->ahelper->UploadFile($request->file('image'),'images/users',$fileName);
                    $user->image = $fileName;
                }
            }else{
                $user = new User();
                if($request->exists('image')){
                    $this->ahelper->UploadImage($request->file('image'),'images/users',$fileName);
                    //$this->ahelper->UploadFile($request->file('image'),'images/users',$fileName);
                    $user->image = $fileName;
                }
            //$user->level = $request->level;
            }
            
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->oldpassword == $request->password){
                $user->password = $request->oldpassword;        
            }else{
                $user->password = bcrypt($request->password);           
            }
            

            $user->save();
            return redirect('admin/user');
        }else{
            return redirect('admin/user');
        }
    }


    public function getUbah($id){
        if (! $this->authorize('edit.user')) {
           return "I can't create edit user :(";
        }
        $role = Role::get();
        $user = User::find($id);
        $status = 'edit';
        session(['aksi'=>$status]);
        $provinsi = provinsi::orderBy('kode_provinsi','ASC')->get();
        return view('master.userAddEdit')->withStatus('edit')
        ->withProvinsi($provinsi)
        ->withRole($role)
        ->withUsers($user);
    }

    public function postHapus($id){
        if (! $this->authorize('delete.user')) {
           return "I can't create edit user :(";
        }
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user');
    }

    public function getAktifnonaktif($id){
        $users = User::find($id);
        $users->isactive = ($users->isactive == 0) ? 1:0;
        $users->save();
        
        return redirect('admin/user');
    }

    public function getLevel($layerid=''){
        $levelform = \Input::get('level');
        $array = array();
        $array2 = array();
        if(empty($layerid)){
            return 'layerid kosong';
        }
        foreach ($levelform as $key => $value) {
            $array['layer_id'] = $layerid;
            $array['role_id'] = $value;
            array_push($array2,$array); 
        }
        return $array2;
    }

    public function GetDftrLevel($lvl='') {
    
        $level = Role::whereRaw('id != ?',array(0))->get();
        $a = '';
        foreach ($level as $key => $value) {
            $ck = (strpos($lvl, ".$value->id") === false)? '' : 'checked';
            $a .= "<div class='row'><div class='col-md-12'>";
            $a .= "<label class='checkbox-primary'><input type=checkbox name='level[]' class='styled' value='$value->id' $ck> $value->id - $value->name</label>";
            $a .= "</div></div>";
        } 
        return $a;

    }
}
