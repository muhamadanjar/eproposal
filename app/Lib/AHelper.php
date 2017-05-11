<?php namespace App\Lib;
use DB;
use Session;
class AHelper {


    protected $image_path_watermark;

    public function __construct(){
        $this->baseurl = url();
        $this->image_path_watermark = public_path('images').'/logo.png';
    }
	public static function ArraytoObject($data)
	{
		$outs = (object) $data;
		foreach($data as $val => $item)
		{
			if($val =="_token")
			unset($outs->$val);	
		}
		return $outs;
	}
	public static function format_message($message,$type='info'){
        
		//cancel | checkmark | warning | info
        if($type == 'cancel'){
        	$baru = 'danger';
        }elseif ($type == 'checkmark') {
        	$baru = 'success';
        }elseif ($type == 'warning') {
        	$baru = 'warning';
        }else{
        	$baru = 'info';
        }
        $alert = '';
        $alert .= '<div class="alert alert-'.$baru.' fade in block-inner">';
        $alert .= '<button type="button" class="close" data-dismiss="alert">×</button>';
		$alert .= '<i class="icon-'.$type.'-circle"></i>'.$message;	            
		$alert .= '</div>';
		return $alert;
    }

    public function sqling($str) {
        $str = stripslashes($str);
        return addslashes($str);
    }

    public function seo_title($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }

////////////////Post//////////////////////////////////////////////////////////////
    public function TermQuery($jenis = ''){
        $table = 'terms';$table_foreign = 'term_taxonomy';
        $jenis = ($jenis=='') ? 'post_category' : $jenis;
        $category = DB::table($table)
        ->join($table_foreign,$table_foreign.'.termid','=',$table.'.termid')
        ->where('taxonomy',$jenis)->get();
        return $category;
    }

    public function KategoriTagQuery($tipe = 'kategori'){
        $table = ($tipe=='tag') ? 'tags' : 'kategori';
        $category = DB::table($table)
        ->get();
        return $category;
    }

    public function GetTagCheckBox($tag='') {
    
        $kategoritag = $this->KategoriTagQuery('tag');
        $a = '';
        foreach ($kategoritag as $key => $v) {
            $ck = (strpos($tag, ".$v->tagid") === false)? '' : 'checked';
            $a .= "<div class='row'><div class='col-md-12'>";
            $a .= "<label class='checkbox-primary'><input type=checkbox name='tag[]' class='styled' value='$v->tagid' $ck>$v->namatag</label>";
            $a .= "</div></div>";
        } 
        return $a;

    }

    public function GetKategoriCheckBox($kategori='') {
    
        $kategoritag = $this->KategoriTagQuery();
        $a = '';
        foreach ($kategoritag as $key => $v) {
            $ck = (strpos($kategori, ".$v->kategoriid") === false)? '' : 'checked';
            $a .= "<div class='row'><div class='col-md-12'>";
            $a .= "<label class='checkbox-primary'><input type=checkbox name='kategori[]' class='styled' value='$v->kategoriid' $ck>$v->namakategori</label>";
            $a .= "</div></div>";
        } 
        return $a;

    }

    public function GetKategoriSelect($kategori='') {
    
        $kategori = $this->KategoriTagQuery();
        $a = '<select name="kategori" class="select-full">';
        $a .= '<option value="0">----------</option>';
        foreach ($kategori as $key => $value) {
            $selected = ($value->kategoriid == $kategori) ? 'selected' : '';
            $a .= '<option value="'.$value->kategoriid.'" '.$selected.'>'.$value->namakategori.'</option>';
        }
        $a .= '</select>'; 
        return $a;

    }

    public function GetTermsCheckBox($lvl='') {
    
        $terms = $this->TermQuery();
        $a = '';
        foreach ($terms as $key => $value) {
            $ck = (strpos($lvl, ".$value->termid") === false)? '' : 'checked';
            $a .= "<div class='row'><div class='col-md-12'>";
            $a .= "<label class='checkbox-primary'><input type=checkbox name='kategori[]' class='styled' value='$value->termid' $ck>$value->name</label>";
            $a .= "</div></div>";
        } 
        return $a;

    }

    public function GetTermsTagCheckBox($lvl='') {
    
        $terms = $this->TermQuery('post_tag');
        $a = '';
        foreach ($terms as $key => $value) {
            $ck = (strpos($lvl, ".$value->termid") === false)? '' : 'checked';
            $a .= "<div class='row'><div class='col-md-12'>";
            $a .= "<label class='checkbox-inline checkbox-primary'><input type=checkbox name='tags[]' class='styled' value='$value->termid' $ck>$value->name</label>";
            $a .= "</div></div>";
        } 
        return $a;

    }

    public function GetDataTagKategori($postid='',$term ='kategori'){
        $form = \Input::get($term);
        $array = array();
        $array2 = array();

        foreach ($form as $key => $value) {
            $array['postid'] = $postid;
            $array['termtaxonomyid'] = $value;
            $array['termorder'] = 0;
            array_push($array2,$array); 
        }

        return $array2;
    }

    public function GetDataKategoriSelect($postid=''){
        $array = array();$array2 = array();$form = \Input::get('kategori');
        $array['postid'] = $postid;
        $array['termtaxonomyid'] = $form;
        $array['termorder'] = 0;
        array_push($array2,$array); 
        return $array2;

    }

    public function GetDftrLevel($lvl='') {
    
        $level = \App\Role::whereRaw('id != ?',array(0))->get();
        $a = '';
        foreach ($level as $key => $value) {
            $ck = (strpos($lvl, ".$value->id") === false)? '' : 'checked';
            $a .= "<div class='row'><div class='col-md-12'>";
            $a .= "<label class='checkbox-primary'><input type=checkbox name='level[]' class='styled' value='$value->id' $ck> $value->id - $value->name</label>";
            $a .= "</div></div>";
        } 
        return $a;

    }

    public function GetDftrLevelSelect($lvl='') {
        
        $level = \App\Role::whereRaw('id != ?',array(0))->get();
        $a = '<select name="level" class="form-control">';
        $a .= '<option value="0">----------</option>';
        foreach ($level as $key => $value) {
            $selected = ($value->id == $lvl) ? 'selected' : '';
            $a .= $lvl.' '.$value->id;
            $a .= '<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>';
        }
        $a .= '</select>'; 
        return $a;

    }
/////////////////////////////////////
    

    public function rawmenu($user){
        $menu = DB::table('m_user_group_detil')
        ->join('m_module','m_module.moduleid','=','m_user_group_detil.moduleid')
        ->join('roles','roles.id','=','m_user_group_detil.groupid')
        ->join('m_privileges','m_privileges.privid','=','m_user_group_detil.privid')
        ->where('m_user_group_detil.groupid',$user)
        ->where('m_module.status','1')
        ->orderBy('urutan','asc')
        ->get();
        return ($menu);
    }

    function html_ordered_menu($array,$parent_id = 0){

        $menu_html = ($parent_id == 0) ? '<ul id="navbar-menu" class="nav navbar-nav collapse">' : '<ul class="dropdown-menu dropdown-menu-right">' ;
    
        foreach($array as $element){
            if($element->moduleparentid==$parent_id){       
                if($parent_id == 0){ 
                    $url = $element->moduleslug;
                    $link = '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="'.$url.'"><i class="'.$element->icon.'"></i><span>'.$element->modulename.'</span></a>';
                    
                }else{
                    $url = $this->baseurl.'/'.$element->moduleslug;
                    $link = '<li><a href="'.$url.'">'.$element->modulename.'</a>';
                }
                $menu_html .= $link;
                $menu_html .= ($this->html_ordered_menu($array,$element->moduleid));
                
                $menu_html .= '</li>';
            }
        }
        $menu_html .= '</ul>';
        return $menu_html;
    }

    function get_menu_encore($data, $parent = 0) {

        static $i = 1;
        $tab = str_repeat(" ", $i);
        
        if(isset($data[$parent])){
            $html = "<ul class='navigation'>";
            $i++;
            foreach ($data[$parent] as $v) {
                echo $v->moduleid.' ';
                $child = $this->get_menu_encore($data, $v->moduleid);
                $html .= "$tab<li class='last'>";
                $html .= '<a class="" href="'.$v->moduleslug.'"><span>'. $v->modulename.'</span><i class="'.$v->modulename.'"></i></a>';
                if ($child) {
                    $i--;
                    $html .= "<ul>$child";
                    $html .= "$tab</ul>";}
                $html .= '</li>';
            }
            $html .= "$tab</ul>";
            return $html;
        }else{
            return false;
        }
            
        
    }

    public function updateSessionMenu(){
        $usermenu = ($this->rawmenu(\Auth::user()->id));
        $menusess = ($this->html_ordered_menu($usermenu));
            
        foreach ($usermenu as $value) {
            $data[$value->moduleparentid][] = $value;
        }
        $menusess_nav = $this->get_menu_encore($data);
            Session::put('menusess',$menusess);
            Session::put('menusessnav',$menusess_nav);
    }


    public function jgridData($data=''){
        if($data == 'modul'){
            $model = \App\mmodule::orderBy('moduleid','asc')->get();
        }
        $array = array();
        $rows = array();
        $a = [];
        foreach ($model as $key => $value) {
            
            //$a[] .= (json_decode($value,true));
            array_push($a, json_decode($value,true));
          
        }
        $rows['rows'] = $a;
        return $rows;
    }

    public function otomatis_kode($awalan,$table,$field){
        $last_rec = \DB::table($table)->select([DB::raw('MAX(nik) AS kodex')])->first($field);
        $kode ='';
        if ($last_rec != null) {
            $kode = $last_rec->kodex;
        }
        $angka = substr($kode, 3, 5);
        if ($angka == false) {
            $angka = '0000';
        }
        $angka++; 
		
    
        if($angka<=9){
                $angka="0000".$angka;
        }elseif($angka<=99){
                $angka="000".$angka;
        }elseif($angka<=999){
                $angka="00".$angka;
        }elseif($angka<=9999){
                $angka="0".$angka;
        }elseif($angka<=99999){
                $angka=$angka;
        }else{
                $alert=eks::msg("Kode otomatis sudah dalam batas, silahkan kontak admin");
                return $alert;
                return false;
        }
        return $awalan.$angka;
    }

    function GetSetVar($str, $def='') {
        if (isset($_REQUEST[$str])) {
            $_SESSION[$str] = $_REQUEST[$str];
            return $_REQUEST[$str];
        }else {
            if (isset($_SESSION[$str])) return $_SESSION[$str];
            else {
              $_SESSION[$str] = $def;
              return $def;
            }
        }
    }

    function tgl_indo($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = $this->getBulan(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $tanggal.' '.$bulan.' '.$tahun;       
    }   

    function getBulan($bln){
        switch ($bln){
            case 1: 
                        return "Januari";
                        break;
            case 2:
                        return "Februari";
                        break;
            case 3:
                        return "Maret";
                        break;
            case 4:
                        return "April";
                        break;
            case 5:
                        return "Mei";
                        break;
            case 6:
                        return "Juni";
                        break;
            case 7:
                        return "Juli";
                        break;
            case 8:
                        return "Agustus";
                        break;
            case 9:
                        return "September";
                        break;
            case 10:
                        return "Oktober";
                        break;
            case 11:
                        return "November";
                        break;
            case 12:
                        return "Desember";
                        break;
        }
    }
	
	function getBulanArray(){
		
		$bulan = array(1	=>	'Januari',
				2	=>	'Februari',
				3	=>	'Maret',
				4	=>	'April',
				5	=>	'Mei',
				6	=>	'Juni',
				7	=>	'Juli',
				8	=>	'Agustus',
				9	=>	'September',
				10	=>	'Oktober',
				11	=>	'November',
				12	=>	'Desember',
		);
		
		return $bulan;
        
    }

    function validasi($str, $tipe){
        switch($tipe){
            default:
            case'sql':
                $str = stripcslashes($str); 
                $str = htmlspecialchars($str);              
                $str = preg_replace('/[^A-Za-z0-9]/','',$str);              
                return intval($str);
            break;
            case'xss':
                $str = stripcslashes($str); 
                $str = htmlspecialchars($str);
                $str = preg_replace('/[\W]/','', $str);
                return $str;
            break;
        }
    }

    function extension($path) {
        $file = pathinfo($path);
        if(file_exists($file['dirname'].'/'.$file['basename'])){
            return $file['basename'];
        }
    }

    function sensor($teks){
        $w = DB::table('katajelek')->get();
        foreach ($variable as $key => $v) {
            $teks = str_replace($v->kata, $v->ganti, $teks);
        }
        return $teks;
    }

    function autolink($str){
        $str = eregi_replace("([[:space:]])((f|ht)tps?:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $str); //http
        $str = eregi_replace("([[:space:]])(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $str); // www.
        $str = eregi_replace("([[:space:]])([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","\\1<a href=\"mailto:\\2\">\\2</a>", $str); // mail
        $str = eregi_replace("^((f|ht)tp:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $str); //http
        $str = eregi_replace("^(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"http://\\1\" target=\"_blank\">\\1</a>", $str); // www.
        $str = eregi_replace("^([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","<a href=\"mailto:\\1\">\\1</a>", $str); // mail
        return $str;
    }

    function folder_exist($folder){
        // Get canonicalized absolute pathname
        $path = realpath($folder);

        // If it exist, check if it's a directory
        return ($path !== false AND is_dir($path)) ? $path : false;
    }  
	// Upload file untuk download file
    function UploadImage($fupload,$vdir_upload ='',$name_upload ='',$image_thumbnail=false,$watermark_show=false){
      	//direktori gambar
        //$fupload = $request->file('images');
        $fuploadName = $name_upload;/*$fupload->getClientOriginalName();str_random(20).'.'.$fupload->getClientOriginalExtension();*/
        $fuploadExt = $fupload->getClientOriginalExtension();
        $fuploadSize = $fupload->getSize();

        $vdir_upload = public_path($vdir_upload);
        $vfile_upload = $vdir_upload .'/'. $fuploadName;
        
        $fupload->move($vdir_upload, $fuploadName);

        //identitas file asli
        switch($fuploadExt) {
            case "gif":
                $im_src=imagecreatefromgif($vfile_upload); 
                break;
            case "pjpeg":
            case "jpeg":
            case "jpg":
            case "JPG":
                $im_src=imagecreatefromjpeg($vfile_upload); 
                break;
            case "png":
            case "x-png":
                $im_src=imagecreatefrompng($vfile_upload); 
                break;
        }
      
        $src_width = imageSX($im_src);
        $src_height = imageSY($im_src);

      	//Simpan dalam versi besar 400 pixel
      	//Set ukuran gambar hasil perubahan
        if($src_width>=350){
            $dst_width = 350;
        } else {
            $dst_width = $src_width;
        }
        $dst_height = ($dst_width/$src_width)*$src_height;

        //proses perubahan ukuran
        $im = imagecreatetruecolor($dst_width,$dst_height);
        imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
       
	   	if($image_thumbnail == true){
      	//Simpan gambar
			switch($fuploadExt) {
				case "gif":
					imagegif($im,$vdir_upload.'/medium_'.$fuploadName);
					break;
				case "pjpeg":
				case "jpeg":
				case "jpg":
				case "JPG":
					imagejpeg($im,$vdir_upload.'/medium_'.$fuploadName);
					break;
				case "png":
				case "x-png":
					imagepng($im,$vdir_upload.'/medium_'.$fuploadName);
					break;
			}
		}


      //Simpan dalam versi small 200 pixel
      //Set ukuran gambar hasil perubahan

      $dst_width2 = 200;
      $dst_height2 = ($dst_width2/$src_width)*$src_height;

      //proses perubahan ukuran
      $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
      imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);
	  
	  if($image_thumbnail == true){
		  //Simpan gambar
		  switch($fuploadExt) {
				case "gif":
					imagegif($im2,$vdir_upload . "/small_" . $fuploadName);
					break;
				case "pjpeg":
				case "jpeg":
				case "jpg":
				case "JPG":
					imagejpeg($im2,$vdir_upload . "/small_" . $fuploadName);
					break;
				case "png":
				case "x-png":
					imagepng($im2,$vdir_upload . "/small_" . $fuploadName);
					break;
		  }
	  }
	  
      //Hapus gambar di memori komputer
      imagedestroy($im_src);
      imagedestroy($im);
      imagedestroy($im2);
	  if($watermark_show == true) $this->watermark_image($vdir_upload.'/'.$fuploadName);
    }
    
    function UploadFile($fupload,$vdir_upload ='files',$fileName=''){
        //direktori file
        $destinationPath = public_path().'/'.$vdir_upload;
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777);
            //echo "The directory $destinationPath was successfully created.";
            //exit;
        } else {
            //echo "The directory $destinationPath exists.";
        }
        //$fupload = $request->file('fupload');
        $fuploadName = $fupload->getClientOriginalName();
        $fuploadExt = $fupload->getClientOriginalExtension();
        $fuploadSize = $fupload->getSize();

        //$fileName = str_random(20) . '.' . $fupload->getClientOriginalExtension();   

        //$vdir_upload = "../../../files/";
        //$vfile_upload = $vdir_upload . $fupload_name;

        //Simpan file
        $fupload->move($destinationPath, $fileName);
        //move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
    }

    function watermark_image($oldimage_name){
        $image_path_watermark = $this->image_path_watermark;
        $image_type = exif_imagetype($oldimage_name);

        list($owidth,$oheight) = getimagesize($oldimage_name);
        $width = $owidth;
        $height = $oheight;    
        $im = imagecreatetruecolor($width, $height);
        
        switch ($image_type) {
            case 1: 
                $img_src = imagecreatefromgif($oldimage_name);
                break;
            case 2:
                $img_src = imagecreatefromjpeg($oldimage_name);
                break;
            default:
                $img_src = imagecreatefrompng($oldimage_name);
                break;
        }

        imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
        $watermark = imagecreatefrompng($image_path_watermark);
        list($w_width, $w_height) = getimagesize($image_path_watermark);        
        $pos_x = $width - $w_width -5; 
        $pos_y = $height - $w_height - 5;
        imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
        imagejpeg($im, $oldimage_name, 100);
        imagedestroy($im);
        return true;
    }



    ////////////////////////////Paging/////////////////////////////////////////
    /////////App\Lib\Pagging/////////////////////

    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    function random_color() {
        return random_color_part() . random_color_part() . random_color_part();
    }
	
	public function checkweeks(){
		$day = date('w');
		$week_start = date('m-d-Y', strtotime('-'.$day.' days'));
		$week_end = date('m-d-Y', strtotime('+'.(6-$day).' days'));
		$week = array($week_start,$week_end);
		return $week;
	}
	
	function calculate_time_span($date){
		$seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($date);
	
			$months = floor($seconds / (3600*24*30));
			$day = floor($seconds / (3600*24));
			$hours = floor($seconds / 3600);
			$mins = floor(($seconds - ($hours*3600)) / 60);
			$secs = floor($seconds % 60);
	
			if($seconds < 60)
				$time = $secs." seconds ago";
			else if($seconds < 60*60 )
				$time = $mins." min ago";
			else if($seconds < 24*60*60)
				$time = $hours." hours ago";
			else if($seconds < 24*60*60)
				$time = $day." day ago";
			else
				$time = $months." month ago";
	
			return $time;
	}


    public function status_permohonan($id=''){
        if($id == '1'){
            $isi = 'Baik';
        }elseif($id == '2'){
            $isi = 'Rusak Lengkap';
        }elseif($id == '3'){
            $isi = 'Tidak Lengkap';
        }elseif($id == '4'){
            $isi = 'Tidak Ada';
        }else{
            $isi = 'Tidak Laik';
        }

        return $isi;
    }

    public function var_server($value=''){
        $indicesServer = array('PHP_SELF', 
            'argv', 
            'argc', 
            'GATEWAY_INTERFACE', 
            'SERVER_ADDR', 
            'SERVER_NAME', 
            'SERVER_SOFTWARE', 
            'SERVER_PROTOCOL', 
            'REQUEST_METHOD', 
            'REQUEST_TIME', 
            'REQUEST_TIME_FLOAT', 
            'QUERY_STRING', 
            'DOCUMENT_ROOT', 
            'HTTP_ACCEPT', 
            'HTTP_ACCEPT_CHARSET', 
            'HTTP_ACCEPT_ENCODING', 
            'HTTP_ACCEPT_LANGUAGE', 
            'HTTP_CONNECTION', 
            'HTTP_HOST', 
            'HTTP_REFERER', 
            'HTTP_USER_AGENT', 
            'HTTPS', 
            'REMOTE_ADDR', 
            'REMOTE_HOST', 
            'REMOTE_PORT', 
            'REMOTE_USER', 
            'REDIRECT_REMOTE_USER', 
            'SCRIPT_FILENAME', 
            'SERVER_ADMIN', 
            'SERVER_PORT', 
            'SERVER_SIGNATURE', 
            'PATH_TRANSLATED', 
            'SCRIPT_NAME', 
            'REQUEST_URI', 
            'PHP_AUTH_DIGEST', 
            'PHP_AUTH_USER', 
            'PHP_AUTH_PW', 
            'AUTH_TYPE', 
            'PATH_INFO', 
            'ORIG_PATH_INFO'); 
    
        echo '<table cellpadding="10">' ; 
        foreach ($indicesServer as $arg) { 
            if (isset($_SERVER[$arg])) { 
                echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ; 
            } else { 
                echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ; 
            } 
        } 
        echo '</table>' ; 
    
    
    
    
    }

    

    
}