<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_controller  {

	function __construct (){
		parent::__construct();
		$this->load->helper(array('oltest','url','html'));
	}
 
	function index(){
		$this->load->view('home');
	}

	function test(){
		$this->load->view('header');
		$this->load->view('slide');
		$this->load->view('body');
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
