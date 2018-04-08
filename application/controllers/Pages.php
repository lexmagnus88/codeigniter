<?php
//to control acess
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Public_Controller {

        public function index(){
                $data['featured_pages'] = $this->Page_model->get_featured();
                $this->template->load('public', 'default', 'pages/index', $data);
		//$this->load->view('admin/dashboard');
        }
        
        public function show($slug){
                $data['page'] = $this->Page_model->get_by_slug($slug);

                //load template
                $this->template->load('public', 'default', 'pages/show', $data);
        }
}
