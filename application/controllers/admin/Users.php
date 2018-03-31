<?php
//to control acess
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index(){
                //$this->load->view('welcome_message');
                //		location, as default template, view to load
		$this->template->load('admin', 'default', 'users/index');
        }

        public function add(){
		$this->template->load('admin', 'default', 'users/add');
        }

        public function edit(){
		$this->template->load('admin', 'default', 'users/edit');
        }

        public function delete(){

        }

        public function login(){

        }

        public function logout(){

	}
}
