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
	
#FORM
	function post($str){
		return $this->input->post($str);
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
		$user_ID=$this->m_contributor->select_user_ID($this->check_username());
		$data['title']="Home";
		$data['active']="home";
		$data['ctrl']=$this;
		$data['activities']=$this->m_contributor->select_activity_where($user_ID);
		$this->header($data);
		$this->load_view("home",$data);
		$this->footer($data);
	}
	
	function exam(){
		$this->load->helper('form');
		$this->unset_sessions("NOT_ALL",array('mapel')); //unset mapel
		$data['title']="contributor";
		$data['active']="exam";
		$data['ctrl']=$this;
		$data['datas']=$this->m_contributor->select_all_exam($this->check_username());
		$this->header($data);
		$this->load_view("exam",$data);
		$this->footer($data);
	}
	
	function exam_detail($ID,$mapel='',$class=''){
		$this->load->helper('form');
		$this->unset_sessions("NOT_ALL",array('mapel')); //unset mapel
		$data['title']="Exam Detail";
		$data['active']="exam";
		$data['ctrl']=$this;
		$data['datas']=$this->m_contributor->select_detail_exam($ID,$this->check_username(),$mapel,$class);
		$this->header($data);
		$this->load_view("exam_detail",$data);
		$this->footer($data);
	}
	
	function new_exam(){
		$this->load->helper('form');
		$this->set_session('image_post',get_image_post());
		$this->get_session("image_post");
		$data['mapel']=$this->get_session('mapel');
		$data['title']="New Exam";
		$data['active']="exam";
		$data['ctrl']=$this;
		$this->header($data);
		$this->load_view("new_edit_exam",$data);
		$this->footer($data);
	}
	
	function insert_todb(){
		if($_POST){
		 $user_ID=$this->m_contributor->select_user_ID($this->check_username());
		 $type=$this->get_session('mapel');
		 $mapel=$this->get_session('mapel');
		 if($mapel == ""){
		   $map=$this->input->post('mapel');
		   $kelas=$this->input->post('kelas');
		   $mapel="$map-$kelas";
		 }
		 $soal=$this->input->post('soal');
		 $a=$this->input->post('jawab_a');
		 $b=$this->input->post('jawab_b');
		 $c=$this->input->post('jawab_c');
		 $d=$this->input->post('jawab_d');
		 $e=$this->input->post('jawab_e');
		 $true=$this->input->post('answer');
		 if ($soal !== "" and $mapel !== ""){
		 	$this->m_contributor->insert_new($this->check_username(),$mapel,$soal);
		 	$exam_id=$this->m_contributor->select_ID_question($user_ID,$mapel,$soal);
		 	$this->m_contributor->insert_answer_options($exam_id, $a, $b, $c, $d, $e, $true);
		  	$this->insert_activities("INSERT exam WHERE ID=$exam_id");
		 	redirect(get_site_url("exam"));
		 }
		}
	}
	
	function edit_exam($id=""){
		if ($id == "")redirect();
		if($_POST){
			$user_ID=$this->m_contributor->select_user_ID($this->check_username());
			$question=$this->post("soal");
			$a=$this->post("jawab_a");
			$b=$this->post("jawab_b");
			$c=$this->post("jawab_c");
			$d=$this->post("jawab_d");
			$e=$this->post("jawab_e");
			$answer=$this->post("answer");
			if ($question == "" or $a=="" or $b=="" or $c=="" or $d=="" or $e=="" or $answer=="")$err="Harap si isi dengan benar !!!";
			if(!isset($err))$this->m_contributor->update_exam_question($user_ID,$id,$question,$a,$b,$c,$d,$e,$answer);
		  		$this->insert_activities("EDIT exam WHERE ID=$id");
			if(!isset($err)) redirect(get_site_url("exam_detail/$id"));
			
			exit;
		}
		$this->load->helper("form");
		$data["datas"]=$this->m_contributor->select_all_exam_where($id);
		$data["title"]="Edit Exam";
		$data["mapel"]="-";
		$data['active']="exam";
		$this->header($data);
		$this->load->view("new_edit_exam",$data);
		$this->footer($data);
	}
	
	function delete_exam($id=''){
		if($id !== ""){
		  $res=$this->m_contributor->delete_exam($id);
		}
		if ($res!= ""){
		  $r=explode('-',$res);
		  $mapel=$r[0];
		  $class=$r[1];
		  	$this->insert_activities("DELETE exam WHERE ID=$id");
			redirect(get_site_url("exam_detail/$mapel/$class"));
		}
	}
	
	function get_graphic_activities($id){
	 	$row=array();
	 	$user_ID=$this->m_contributor->select_user_ID($this->check_username());
			$s=$this->m_contributor->get_data_activities_for_chart($user_ID);
			$n=1;
			foreach($s->result() as $r){
			 $p=$r->total;
			 	if ($n==1){
				 	$coll[]=array("id"=>"","label"=>"Topping","type"=>"string","pattern"=>"");
				 	$coll[]=array("id"=>"","label"=>"Aktivitas","type"=>"number","pattern"=>"");
			 	}
				$v1=array("v"=>$r->date);
				$v2=array("v"=>$p);
			 	$row=array($v1,$v2);
				$rs[]=array("c"=>$row);
				$row="";
				$n++;
			 }
	 	$b=array("cols"=>$coll,"rows"=>$rs);
		echo json_encode($b);
	 }
	 
	 function show_detail($id){
	 	if($id == "")exit;
	 	$user_ID=$this->m_contributor->select_user_ID($this->check_username());
	 	$date=$this->m_contributor->select_date_from_activities($id);
	 	if($date == "")exit;
	 	$data['activities']=$this->m_contributor->select_activities_where($date,$user_ID);
	 	$data["title"]="Detail Activities";
		$data['active']="home";
		$this->header($data);
		$this->load->view("detail_activities",$data);
		$this->footer($data);
	 }
	 
	 function insert_activities($activity){
	 	if ($activity=="")exit;
	 	$userid=$this->m_contributor->select_user_ID($this->check_username());
	 	$this->m_contributor->insert_activity($userid,$activity);
	 }
	
}
//end of file
