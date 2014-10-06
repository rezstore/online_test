<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adm extends CI_Controller {

	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html'));
		$this->load->model('m_login');
		$this->load->helper('adm');
	 }
	 
	function set_session($name,$val){
		$this->load->library('session');
		$this->session->set_userdata($name,$val);
	}
	 
	function get_session($name){
		$this->load->library('session');
		return $this->session->userdata($name);
	}
	
	function index(){
	 $this->set_session('captcha',date('gisi')-date('gs')-2);
	 $this->check_login();
	}
	
	function check_login(){
		if($_POST){
			$captcha=$this->input->post('captcha');
			$user=$this->input->post('user_admin');
			$pass=$this->input->post('pass_admin');
			if ($captcha != $this->get_session('captcha')) $err="maaf password atau kata sandi tidak cocok!";
			  if ($user != '' and $pass != '' and $captcha != ""){ 
				$q1=$this->m_login->select_user_where($user);
				if ($q1->num_rows() > 0){
				  foreach($q1->result() as $r){
				    echo $pswd=$this->encript('d',$r->password);
					  # CHECK MATCH #
					  if ($pswd == $pass){
					  	$this->set_session('user_admin',$user);
					  	redirect("_administrator");
					  }
				  }
				}
				$err= "Data yang anda masukkan Tidak cocok. <br>Harap Coba Lagi ";
			  }else{
				$err= "Harap tidak mengkosongkan kolom yang di sediakan";
			  }
			$data['error']=$err;
			$data['user']=$user;
		}
		$this->set_session('captcha',date('sisis')-date('i')-2);
		$this->load->helper('form');
		$data['controller']=$this;
 		$this->load->view('login',$data);
	 }
	
	function encript($type='d',$str){
		$this->load->library('encrypt');
	    if($type=="e"){
			$crypt=$this->encrypt->encode($str);
		}else{
			$crypt=$this->encrypt->decode($str);
		}
		echo $crypt;
		return $crypt;
	}
	 
	function set_timezone()
	{
	   date_default_timezone_set('Asia/Jakarta');
	}
	
	#CREAT IMAGE
	function captcha(){
		$str=$this->get_session('captcha');
		$my_img = imagecreate( 150, 40 );
		$background = imagecolorallocate( $my_img, 245, 245, 245 );
		$text_colour = imagecolorallocate( $my_img, 85, 85, 85 );
		$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
		imagestring( $my_img, 10, 60, 10, substr($str,0,4), $text_colour );
		imagesetthickness ( $my_img, 5 );
		imageline( $my_img, 30, 35, 165, 45, $line_colour );

		header( "Content-type: image/png" );
		imagepng( $my_img );
		imagecolordeallocate( $line_color );
		imagecolordeallocate( $text_color );
		imagecolordeallocate( $background );
		imagedestroy( $my_img );
	}
	
}
//end of file
