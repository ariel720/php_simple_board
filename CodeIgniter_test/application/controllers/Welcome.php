<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
		parent::__construct();
		
	}

	
	public function index()
	{
		$member = $this->member_m->create_user();
		$this->load->view('welcome_message',$member);
	}

	public function board()
	{
		$member = $this->member_m->create_user();
		$this->load->view('welcome_message',$member);
	}
}
