<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _administrator extends CI_Controller {

	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html'));
		$this->load->model('m_admin');
		$this->load->helper('admin');
		$this->check_username();
	 }
	 
	function set_session($name,$val){
		$this->load->library('session');
		$this->session->set_userdata($name,$val);
	}
	 
	function get_session($name){
		$this->load->library('session');
		return $this->session->userdata($name);
	}
	
	function unset_sessions($all="ALL"){
		$this->load->library('session');
		if($all == "ALL"){
			$arr=array("user_admin");
			foreach($arr as $name){
			  $this->session->unset_userdata($name);
			}
		}
	}
	
	function check_username(){
	  $user=$this->get_session('user_admin');
	  if($user == "")redirect("adm");
	  return $user;
	}

# LOGOUT
	function logout(){
		$this->unset_sessions();
	}
	
# LOADING MAIN VIEWS

	function header($data){
	 $this->load->view('templates/admin_header',$data);
	}
	
	function footer($data){
	 //$this->load->view('templates/admin_footer',$data);
	}
	
	function load_view($filename,$data){
	 $this->load->view($filename,$data);
	}
	
	function index(){
	 $this->home();
	}
	
	function home(){
		$data['title']="Home";
		$this->header($data);
		$this->load_view("home",$data);
		$this->footer($data);
	}
	
	function exam(){
		$this->load->helper('form');
		$data['title']="admin";
		$data['ctrl']=$this;
		$data['datas']=$this->m_admin->select_all_exam();
		$this->header($data);
		$this->load_view("exam",$data);
		$this->footer($data);
	}
	
	function exam_detail($ID){
		$this->load->helper('form');
		$data['title']="Exam Detile";
		$data['ctrl']=$this;
		$data['datas']=$this->m_admin->select_all_exam($ID);
		$this->header($data);
		$this->load_view("exam",$data);
		$this->footer($data);
	}
	
}
//end of file
