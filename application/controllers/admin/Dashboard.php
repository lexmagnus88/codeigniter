<?php
//to control acess
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index(){
		$data['activities'] = $this->Activity_model->get_list();
		//		location, as default template, view to load
		$this->template->load('admin', 'default', 'dashboard', $data);
		//$this->load->view('admin/dashboard');
	}
}