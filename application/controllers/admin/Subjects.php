<?php
//to control acess
defined('BASEPATH') OR exit('No direct script access allowed');

class Subjects extends CI_Controller {

	public function index(){
                //$this->load->view('welcome_message');
                //		location, as default template, view to load
		$this->template->load('admin', 'default', 'subjects/index');
        }

        public function add(){
		$this->template->load('admin', 'default', 'subjects/add');
        }

        public function edit(){
		$this->template->load('admin', 'default', 'subjects/edit');
        }

        public function delete(){

	}
}
