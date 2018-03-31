<?php
//to control acess
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index(){
		//		location, as default template, view to load
		$this->template->load('admin', 'default', 'dashboard');
		//$this->load->view('admin/dashboard');
	}
}