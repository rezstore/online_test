<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_controller  {

	function __construct (){
		parent::__construct();
		$this->load->helper(array('oltest','url','html'));
		$this->load->model('m_oltest');
	}
	
 # SETTING SESSION
	function set_username($user){
		$this->load->library('session');
		$this->session->set_userdata('username',$user);
	}
	
	function set_session($name,$val){
		$this->load->library('session');
		$this->session->set_userdata($name,$val);
	}
	
# GETTING SESSION
	function get_session($name){
		$this->load->library('session');
		return $this->session->userdata($name);
	}
	
	function get_username(){
		$this->load->library('session');
		$user =$this->session->userdata('username');
		//if($user == "")redirect(get_site_url());
		return $user;
	}
# UNSET SESSION
	function unset_sessions($val1='',$val2=''){
		$this->load->library('session');
		$arr=array('subject','class','no_page','sess_id');
		foreach($arr as $r){
			$this->session->unset_userdata($r);
		}
		if($val1=="") $this->session->unset_userdata($val1);
		if($val2=="") $this->session->unset_userdata($val2);
	}
	
# LOGOUT	
	function logout(){
		//$this->unset_sessions('username');
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect(get_site_url(''));
	}
	
# GET POST INPUT
	
	function post($str=''){
		return $this->input->post($str);
	}

# INDEX ----------------------------------------------------------------

	function index(){
		if($this->get_username() != ""){
			redirect(get_site_url('default_page'));
		}
		if($_POST){
			$user=$this->post('user');
			$email=$this->post('email');
			if ($user !== "" and $email !== ""){
			 if ($user == "Masukkan Nama" or $email == "Masukkan Email"){redirect('');}
			 $this->m_oltest->insert_user_tes($user,$email);
			 $this->set_username($user);
			 redirect(get_site_url('default_page'));
			}
		}
		$this->load->view('home');
	}
	

	function default_page(){
		$data['c']=$this;
		$this->load->view('header');
		$this->load->view('slide',$data);
		$this->load->view('footer');
	}

	function portofolio(){
		$this->load->view('header');
		$this->load->view('body_portofolio');
		$this->load->view('footer');
	}

	function blog(){
		$this->load->view('header');
		$this->load->view('blog_body');
		$this->load->view('footer');
	}

	function about(){
		$this->load->view('header');
		$this->load->view('about_body');
		$this->load->view('footer');
	}

	function contact(){
		$this->load->view('header');
		$this->load->view('contak_body');
		$this->load->view('footer');
	}

	function online_test(){
		$subject=$this->get_session('subject');
		if($subject != ""){redirect(get_site_url('start'));}
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('select_test');
		$this->load->view('footer');
	}

	function start_test(){
		$subject=$this->get_session('subject');
		if($subject != ""){redirect(get_site_url('start'));}
		
		 $this->load->helper('form');
		 $subject=$this->get_session('subject');
		 $class=$this->get_session('class');
		 $data['c']=$this;
		 if ($subject != "" and $class != ""){
		 	$data['datas']=$this->m_oltest->select_available_exam($subject,$class);
			$this->load->view('header');
			$this->load->view('start_test',$data);
			$this->load->view('footer');		 
		 }
	}
	
	function browse_scores(){
		$username=$this->get_username();
		$data['datas']=$this->m_oltest->get_scores($username);
		$this->load->view('header');
		$this->load->view('browse_scores',$data);
		$this->load->view('footer');
	}
	
# OPERATIONS ======================================================
	function check_request_exam(){
		if($_POST){
			$subject=$this->post('subject');
			$class=$this->post('class');
			if ($subject !== "" and $class !== ""){
				$q=$this->m_oltest->select_available_exam($subject,$class);
				if ($q >= 1){
					$this->set_session('subject',$subject);
					$this->set_session('class',$class);
					redirect(get_site_url('start_test'));
				}else{$err= "Maaf Saat ini soal Tersebut Belum Tersedia.";}			
			}else{$err= "Maaf Tidk boleh ada yang kosong";}
		}else{$err= "Error!!!";}
		echo $err;
	}
	
	function start(){
	  $page_active=$this->get_session('no_page');
	  $subject=$this->get_session('subject');
	  $class=$this->get_session('class');
	  $total=$this->m_oltest->select_available_exam($subject,$class);
	  if($subject == ""){redirect(get_site_url('online_test'));}
		  if($page_active == ""){
		  	$this->set_session('no_page',0);
		  	$this->set_session('sess_id',date('dm').'-'.$subject.'-'.$class);
		  }
		  
		  if($total < $page_active){
		   redirect(get_site_url('calculate_correct_answers'));
		   exit;
		  }
	  $data['c']=$this;
	  $this->load->helper('form');
	  $data['subject']=$subject;
	  $data['class']=$class;
	  $data['no_page']=$page_active;
	  
	  	$this->load->view('header');
		$this->load->view('start',$data);
		$this->load->view('footer');	
	}
	
	function check_answers(){
		if($_POST){
		  $n=1;
		  $err=false;
		  $id_soal=$this->post('id_soal');
		  $count=count($id_soal);
		  foreach($id_soal as $r){
		   $name="data".$n;	   $an="answer".$n;
		   $exam_id[$n]=$r;	   $answr=$this->post($an);
		   $answer[$n]=$answr;
		   #jika salah satu kosong maka error;
		   if($answr == ""){$err=true;}
		  $n++;
		  }
		  #jika semua jawaban terisi maka ;
		  if($err == false){
			for($a=1;$a<=$count;$a++){
			 $anr=$answer[$a];
			 $ex_id=$exam_id[$a];
			 # CHECK DUPLICATE IN TEMPORARY
			  $sess_id=$this->get_session('sess_id');
			    $check=$this->m_oltest->select_where($this->get_username(),$sess_id,$ex_id);
			    if($check->num_rows() <= 0){
				  $status=$this->check_real_answer($ex_id,$anr);
				  $this->m_oltest->insert_to_tmp_db($this->get_username(),$this->get_session('sess_id'),$ex_id,$anr,$status);			    
			    }else{
			    	//echo "a";
			    }
			}
			# UPDATE SETTING PAGE
			$this->set_session('no_page',$this->get_session('no_page') + 5);
			redirect(get_site_url('start'));
		  }else{
		  	echo "salah";
		  }
		}
	}
	
	function check_real_answer($ex_id,$anr){
	 $q=$this->m_oltest->select_exam_answer($ex_id);
	 foreach($q->result() as $r){
		$true=ucfirst($r->answer);
		if($true == $anr){return 1;}
	 }
	 return 0;
	}
	
	function calculate_correct_answers(){
	 $username=$this->get_username();
	 $subject=$this->get_session('subject');
	 $class=$this->get_session('class');
	 $sess_id=$this->get_session('sess_id');
	 $total=$this->m_oltest->select_available_exam($subject,$class);
	 $per_soal=100/$total;
	 $get_sum_correct=$this->m_oltest->get_sum_correct($sess_id,$username);
	 $score=ceil($get_sum_correct * $per_soal);
	 #INSERT TO USER SCORES 
	 $this->m_oltest->insert_new_score($username,$sess_id,$score);
	 $this->unset_sessions();
	 redirect(get_site_url('browse_scores'));
	}
	
	
	


}





?>
