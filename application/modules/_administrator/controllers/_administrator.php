<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _administrator extends CI_Controller {

	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html'));
		$this->load->model('m_admin');
		$this->load->helper('administrator');
	 }
	 
	function set_session($name,$val){
		$this->load->library('session');
		$this->session->set_userdata($name,$val);
	}
	 
	function get_session($name){
		$this->load->library('session');
		return $this->session->userdata($name);
	}
	
	function check_username(){
	  $user=$this->get_session('user_admin');
	  if($user == "")	redirect("adm");
	  return $user;
	}
	
	function index(){
	
	}
	
}
//end of file
