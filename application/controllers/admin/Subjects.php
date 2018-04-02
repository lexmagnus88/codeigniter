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
            //Define rules -----------------Name field, readeble name, rules
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');

            //check state of form validation
            if($this->form_validation->run() == False){
                $this->template->load('admin', 'default', 'subjects/add');
            }else{
                //create POST array
                $data = array(
                    'name' => $this->input->post('name')
                );

                //insert subject
                $this->Subject_model->add($data);

                //Activity Array
                $data = array(
                    'resource_id' => $this->db->insert_id(),
                    'type' => 'subject',
                    'action' => 'added',
                    'user_id' => 1,
                    'message' => 'A new sunject was added ('.$data["name"].')'
                );

                //insert Activity
                $this->Activity_model->add($data);

                //set message
                $this->session->set_flashdata('success', 'Subject has been added');

                //redirect
                redirect('admin/subjects');
            }
        }

        public function edit(){
		$this->template->load('admin', 'default', 'subjects/edit');
        }

        public function delete(){

	}
}
