<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * Auth library
 */
class Auth{
   var $CI = NULL;
   function __construct(){
      // get CI's object
      $this->CI =& get_instance();
   }
   // untuk validasi login
   function do_login($username,$password,$jenis_kantor,$tgl,$dt,$nama_kantor){
	   $username=strtoupper($username);
	   $password=strtoupper($password);
	   $nama_lkm = $nama_kantor;
	   $tgl=$tgl;
	   $dt=$dt;
      // cek di database, ada ga?
      $this->CI->db->from('passwd');
      $this->CI->db->where('USERNAME',$username);
	  $result = $this->CI->db->get();
      //$this->CI->db->where('PASSWORD=MD5("'.$password.'")','',false);
      if($result->num_rows() == 1){
		  
		  $hasil=$result->result ();
		  foreach ( $hasil as $row ){  
					//$split_password = $row->PASSWORD;
					$arr = array (
					'usr' => $row->USERNAME,
					'pwd' => $row->PASSWORD
				);
			  }
			  $m='';
		  $split_password=str_split($arr['pwd']);
		  foreach($split_password as $value){
			  $x=ord($value);
			  $x=$x-5;
			  $x=chr($x);
			  $m=$m.$x;
		  }  
			
			if($password==$m){
				$userdata = $result->row();
				/*==*/
				$this->CI->db->from('web_cabang');
				$this->CI->db->where('kode_cab',$jenis_kantor);
				$result2 = $this->CI->db->get();
				$userdata_kantor =  $result2->row();
				$kantor = $userdata_kantor->nama_cabang;
				$lokasi = $userdata_kantor->lokasi_cabang;
				/*==*/
				/*
				if($userdata->OUTLET=='001'){
					$kantor="Kantor Pusat";
					$lokasi="Depok";
				}elseif($userdata->OUTLET=='200'){
					$kantor="Kantor Kas Cinangka";
					$lokasi="Cinangka";
				}elseif($userdata->OUTLET=='300'){
					$kantor="Kantor Kas Leuwinanggung";
					$lokasi="Leuwinanggung";
				}
				*/
				   $session_data = array(
					  'user_id'   => $userdata->USERID,
					  'nama'      => $userdata->USERNAME,
					  'level'     => 2,// 2 $userdata->STATUS_USER
					  'kantor'     => $kantor,
					  'kodekantor'     => $jenis_kantor,
					  'lokasi'     => $lokasi,
					  'tglD'     => $tgl,
					  'tglY'     => $dt,
					  'nama_lkm' => $nama_lkm
				   );
				   // buat session
				   $this->CI->session->set_userdata($session_data);
				   return true;
			
		  }else{
			  return false;
			//  die("Maaf, Anda tidak berhak untuk mengakses halaman ini.");
		  }
	  }else{
		  return false;
	  }
	 
   }
   function do_login_admin($username,$password,$jenis_kantor,$tgl,$dt,$nama_kantor){
	   $nama_lkm = $nama_kantor;
	   $tgl=$tgl;
	   $dt=$dt;
      
				/*==*/
				$this->CI->db->from('web_cabang');
				$this->CI->db->where('kode_cab',$jenis_kantor);
				$result2 = $this->CI->db->get();
				$userdata_kantor =  $result2->row();
				$kantor = $userdata_kantor->nama_cabang;
				$lokasi = $userdata_kantor->lokasi_cabang;
				
				   $session_data = array(
					  'user_id'   => '0',
					  'nama'      => $username,
					  'level'     => 2,//$userdata->STATUS_USER
					  'kantor'     => $kantor,
					  'kodekantor'     => $jenis_kantor,
					  'lokasi'     => $lokasi,
					  'tglD'     => $tgl,
					  'tglY'     => $dt,
					  'nama_lkm' => $nama_lkm
				   );
				   // buat session
				   $this->CI->session->set_userdata($session_data);
				   return true;
   }
   // untuk mengecek apakah user sudah login/belum
   function is_logged_in(){
      if($this->CI->session->userdata('user_id') == ''){
         return false;
      }
		  return true;
   }
   // untuk validasi di setiap halaman yang mengharuskan authentikasi
   function restrict()
   {
      if($this->is_logged_in() == false)
      {
         redirect('main/login');
      }
   }
   
   // untuk mengecek menu
  function cek_menu($idmenu)
  {
	 $this->CI->load->model('usermodel');
	 $status_user = $this->CI->session->userdata('level');
	 $allowed_level = $this->CI->usermodel->get_array_menu($idmenu);
	 if(in_array($status_user,$allowed_level) == false)
	 {
		die("Maaf, Anda tidak berhak untuk mengakses halaman ini.");
	 }
  }
  
  // untuk logout
  function do_logout()
  {
	 $this->CI->session->sess_destroy();
	 session_destroy();
  }
  

}