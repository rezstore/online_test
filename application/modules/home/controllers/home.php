<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_controller  {

	function __construct (){
		parent::__construct();
		$this->load->helper(array('oltest','url','html'));
		$this->load->model('m_oltest');
	}
 
	function index(){
		if($this->get_username() != ""){
			redirect('home/default_page');
		}
		if($_POST){
			$user=$this->post('user');
			$email=$this->post('email');
			if ($user !== "" and $email !== ""){
			 $this->m_oltest->insert_user_tes($user,$email);
			 $this->set_username($user);
			 $this->default_page();
			}
		}
		$this->load->view('home');
	}
	
	function set_username($user){
		$this->load->library('session');
		$this->session->set_userdata('username',$user);
	}
	
	function get_username(){
		$this->load->library('session');
		return $this->session->userdata('username');
	}
	
	function post($str=''){
		return $this->input->post($str);
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



}





?>
