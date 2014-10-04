<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adm extends CI_Controller {

	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html'));
		$this->load->model('m_login');
	 }
	
	function index(){
	 $this->set_session('captcha',date('gisi')-date('gs')-2);
	 $this->check_login();
	}
	
	function check_login(){
		$this->load->library('encrypt');
		if($_POST){
			$user=$this->input->post('user');
			$pass=$this->input->post('pass');
			  if ($user != '' and $pass != ''){
				$q1=$this->m_login->select_user_where($user);
				if ($q1->num_rows() > 0){
				  foreach($q1->result() as $r){
				    $pswd=$this->encrypt->decode($r->password);
					  # CHECK MATCH #
					  if ($pswd == $pass){
					  	$this->set_session('user',$user);
					  	redirect('administrations');
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
		$this->load->helper('form');
		$data['controller']=$this;
 		$this->load->view('login',$data);
	 }
	 
	function set_session($name,$val){
		$this->load->library('session');
		$this->session->set_userdata($name,$val);
	}
	
	function encript($str){
		$this->load->library('encrypt');
		echo $this->encrypt->encode($str);
	}
	 
	function set_timezone()
	{
	   date_default_timezone_set('Asia/Jakarta');
	}
	
	#CREAT IMAGE
	function captcha(){
		$str=$this->get_session('captcha');
		$my_img = imagecreate( 50, 40 );
		$background = imagecolorallocate( $my_img, 245, 245, 245 );
		$text_colour = imagecolorallocate( $my_img, 85, 85, 85 );
		$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
		imagestring( $my_img, 10, 12, 10, $str, $text_colour );
		imagesetthickness ( $my_img, 5 );
		imageline( $my_img, 30, 45, 165, 45, $line_colour );

		header( "Content-type: image/png" );
		imagepng( $my_img );
		imagecolordeallocate( $line_color );
		imagecolordeallocate( $text_color );
		imagecolordeallocate( $background );
		imagedestroy( $my_img );
	}
	
}
//end of file
