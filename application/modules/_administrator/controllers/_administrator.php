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
	
	function check_username(){
	  $user=$this->get_session('user_admin');
	  if($user == "")redirect("adm");
	  return $user;
	}
	
	function post($str){
	 return $this->input->post($str);
	}
	
	function unset_sessions($all="ALL",$array=array()){
		$this->load->library('session');
		if($all == "ALL"){
			$arr=array(SESSION_ADMIN);
			foreach($arr as $name){
			  $this->session->unset_userdata($name);
			}
		}else{
			foreach($array as $name){
			  $this->session->unset_userdata($name);
			}
		}
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
		$this->load->helper("form");
		$data['title']="Home";
		$data['active']="home";
		$this->header($data);
		$this->load_view("home",$data);
		$this->footer($data);
	}
	
	function exam($type=""){
		$this->load->helper('form');
		$data['title']="admin";
		$data['active']="exam";
		$data['ctrl']=$this;
		if($type == "filter"){
			if($_POST){
				$subject=$this->post("mapel");
				$class=$this->post("kelas");
				$count_ex=$this->post("jumlah_soal");
				$time=$this->post("waktu");
				$user=$this->post("user");
			}
			$data['datas']=$this->m_admin->select_all_exam_filter($subject,$class,$count_ex,$time,$user);
			$data["subject"]=$subject;
			$data["class"]=$class;
			$data["count_ex"]=$count_ex;
			$data["time"]=$time;
			$data["user"]=$user;
		}else{
			$data['datas']=$this->m_admin->select_all_exam();
		}		
		$this->header($data);
		$this->load_view("exam",$data);
		$this->footer($data);
	}
	
	function exam_detail($ID){
		$this->load->helper('form');
		$data['title']="Exam Detail";
		$data['active']="exam";
		$data['ctrl']=$this;
		$data['datas']=$this->m_admin->select_detail_exam($ID);
		$this->header($data);
		$this->load_view("exam_detail",$data);
		$this->footer($data);
	}
	
	function edit_exam($id=""){
		if ($id == "")redirect();
		if($_POST){
			$question=$this->post("soal");
			$a=$this->post("jawab_a");
			$b=$this->post("jawab_b");
			$c=$this->post("jawab_c");
			$d=$this->post("jawab_d");
			$e=$this->post("jawab_e");
			$answer=$this->post("answer");
			if ($question == "" or $a=="" or $b=="" or $c=="" or $d=="" or $e=="" or $answer=="")$err="Harap si isi dengan benar !!!";
			if(!isset($err))$this->m_admin->update_exam_question($id,$question,$a,$b,$c,$d,$e,$answer);
			if(!isset($err)) redirect(get_site_url("exam_detail/$id"));
			
			exit;
		}
		$this->load->helper("form");
		$data["datas"]=$this->m_admin->select_all_exam_where($id);
		$data["title"]="Edit Exam";
		$data['active']="exam";
		$this->header($data);
		$this->load->view("new_edit_exam",$data);
		//$this->footer($data);
	}
	
	function delete_exam($id=""){
		if($id == "")echo "Maaf Data yang anda ingin hapus tidak ada !!!";
		else $this->m_admin->delete_exam($id);
		redirect(get_site_url("exam"));
	}
	
	function new_exam(){
		$this->load->helper('form');
		$this->set_session('image_post',get_image_post());
		$this->get_session("image_post");
		$data['title']="Exam Detail";
		$data['active']="exam";
		$data['ctrl']=$this;
		$this->header($data);
		$this->load_view("new_edit_exam",$data);
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
		 if ($soal !== "" and $mapel !== "" and $true !== ""){
		 	$id=$this->m_admin->insert_new_question($this->check_username(),$mapel,$soal); //menyimpan dan membaca nilai ID soal
			$this->m_admin->insert_new_options_and_answer($id ,$a, $b, $c, $d, $e,$true);
		 	$this->unset_sessions("NOT_ALL",array('mapel'));
			redirect(get_site_url("exam"));
		 }
		}
	}
	
}
//end of file
