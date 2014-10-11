<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _contributor extends CI_Controller {

	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html'));
		$this->load->model('m_contributor');
		$this->load->helper('contributor');
		$this->check_username();
	 }
	 
	function set_session($name,$val){
		$this->load->library('session');
		$this->session->set_userdata($name,$val);
	}
	
	function unset_sessions($all="ALL",$array=array()){
		$this->load->library('session');
		if($all == "ALL"){
			$arr=array(SESSION_CONTRIB);
			foreach($arr as $name){
			  $this->session->unset_userdata($name);
			}
		}else{
			foreach($array as $name){
			  $this->session->unset_userdata($name);
			}
		}
	}
	 
	function get_session($name){
		$this->load->library('session');
		return $this->session->userdata($name);
	}
	
	function check_username(){
	  $user=$this->get_session(SESSION_CONTRIB);
	  if($user == "")redirect("adm");
	  return $user;
	}

# LOGOUT
	function logout(){
		$this->unset_sessions();
	}
# LOADING MAIN VIEWS

	function header($data){
	 $this->load->view('templates/contributor_header',$data);
	}
	
	function footer($data){
	 //$this->load->view('templates/contributor_footer',$data);
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
		$data['title']="contributor";
		$data['ctrl']=$this;
		$data['datas']=$this->m_contributor->select_all_exam($this->check_username());
		$this->header($data);
		$this->load_view("exam",$data);
		$this->footer($data);
	}
	
	function exam_detail($ID){
		$this->load->helper('form');
		$data['title']="Exam Detile";
		$data['ctrl']=$this;
		$data['datas']=$this->m_contributor->select_detail_exam($ID,$this->check_username());
		$this->header($data);
		$this->load_view("exam_detail",$data);
		$this->footer($data);
	}
	
	function new_exam(){
		$this->load->helper('form');
		$this->set_session('image_post',get_image_post());
		$this->get_session("image_post");
		$data['title']="Exam Detail";
		$data['ctrl']=$this;
		$this->header($data);
		$this->load_view("new_exam",$data);
		$this->footer($data);
	}
	
	function insert_todb(){
		if($_POST){
		 $mapel=$this->get_session('mapel');
		 $soal=str_replace("../",'',$this->input->post('soal'));
		 $a=str_replace("../",'',$this->input->post('jawab_a'));
		 $b=str_replace("../",'',$this->input->post('jawab_b'));
		 $c=str_replace("../",'',$this->input->post('jawab_c'));
		 $d=str_replace("../",'',$this->input->post('jawab_d'));
		 $e=str_replace("../",'',$this->input->post('jawab_e'));
		 $true=$this->input->post('jawab_true');
		 if ($soal !== "" and $mapel !== ""){
		 	$this->m_contributor->insert_new($this->check_username(),$mapel,$soal, $a, $b, $c, $d, $e, $true);
		 	//$this->unset_sessions("NOT_ALL",array('mapel'));
		 }
		}
	}
	
}
//end of file
