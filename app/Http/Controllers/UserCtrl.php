<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use App\Provinsi;
use App\Kabupaten;
use Validator;
use App\Notifications\UsulanAdd;
use App\Notifications\UsulanUpdated;

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
        $role = $this->getRole();
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
            $validator = Validator::make($request->all(), [
                'username' => 'required|max:20',
                'password' => 'required',
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('pengaturan/user')
                        ->withErrors($validator)
                        ->withInput();
            }

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
            $user->kode_provinsi = $request->provinsi;
            $user->kode_kabupaten = $request->kabupaten;
            
            $user->save();
            if (!$user->hasRole($request->role)) {
                $user->assignRole($request->role);
            }
            
            return redirect('pengaturan/user');
        }else{
            return redirect('pengaturan/user');
        }
    }


    public function getUbah($id){
        if (! $this->authorize('edit.user')) {
           return "I can't create edit user :(";
        }
        $role = $this->getRole();
        $user = User::find($id);
        $status = 'edit';
        session(['aksi'=>$status]);
        $provinsi = Provinsi::orderBy('kode_provinsi','ASC')->get();
        $kabupaten = Kabupaten::where('kode_provinsi',$user->kode_provinsi)->orderBy('kode_provinsi','ASC')->get();

        return view('master.userAddEdit')->withStatus('edit')
        ->withProvinsi($provinsi)
        ->withKabupaten($kabupaten)
        ->withRole($role)
        ->withUsers($user);
    }

    public function postHapus($id){
        if (! $this->authorize('delete.user')) {
           return "I can't create edit user :(";
        }
        $user = User::find($id);
        $user->delete();
        return redirect('pengaturan/user');
    }

    public function getAktifnonaktif($id){
        $users = User::find($id);
        $users->isactive = ($users->isactive == 0) ? 1:0;
        $users->save();
        
        return redirect('pengaturan/user');
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

    public function getGantiPassword(){
        $user = User::find(auth()->user()->id);
        return view('master.gantipassword')->withUsers($user);
    }

    public function postGantiPassword(Request $request){
        $user = User::find(auth()->user()->id);
        if($request->oldpassword == $request->password){
            $user->password = $request->oldpassword;        
        }else{
            $user->password = bcrypt($request->password);           
        }
        $user->save();

        return redirect('home');
    }

    public function getHistoryLog(){
        $history = Activity::orderBy('user_id','DESC')->where('user_id',auth()->user()->id)->get();
        return view('master.activity_log')->with('history',$history);
    }

    function notifyJedi($id){
        // this is where the notification logic will be implemented
        $jedi = User::findOrFail($id);
        $jedi->notify(new UsulanAdd($jedi));
         
        if($jedi->is_lightsaber_on){
            return redirect()->route('home')
                ->with('message', 'We have notified '.$jedi->name.' that their lightsaber is currently turned ON')
                ->with('status', 'info');
        }else{
            return redirect()->route('home')
                ->with('message', 'We have notified '.$jedi->name.' that their lightsaber is currently turned OFF')
                ->with('status', 'info');
        }
    }

    public function getRole($value=''){
        return Role::where('name','<>','admin')->get();
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
