<?php
//to control acess
defined('BASEPATH') OR exit('No direct script access allowed');

class Subjects extends CI_Controller {

    function __construct(){
        parent::__construct();

        //check login
        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    
	public function index(){

            $data['subjects'] = $this->Subject_model->get_list();
                //		location, as default template, view to load
		    $this->template->load('admin', 'default', 'subjects/index', $data);
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
                'message' => 'A new subject was added ('.$data["name"].')'
            );

            //insert Activity
            $this->Activity_model->add($data);

            //set message
            $this->session->set_flashdata('success', 'Subject has been added');

            //redirect
            redirect('admin/subjects');
        }
    }

    public function edit($id){
        //Define rules -----------------Name field, readeble name, rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');

        //check state of form validation
        if($this->form_validation->run() == False){
            //get current subject
            $data['item'] = $this->Subject_model->get($id);

            $this->template->load('admin', 'default', 'subjects/edit', $data);
        }else{
            $old_name = $this->Subject_model->get($id)->name;
            $new_name = $this->input->post('name');
            //create POST array
            $data = array(
                'name' => $this->input->post('name')
            );

            //insert subject
            $this->Subject_model->update($id, $data);

            //Activity Array
            $data = array(
                'resource_id' => $this->db->insert_id(),
                'type' => 'subject',
                'action' => 'updated',
                'user_id' => 1,
                'message' => 'A subject ('.$old_name.') was renamed ('.$new_name.')'
            );

            //insert Activity
            $this->Activity_model->add($data);

            //set message
            $this->session->set_flashdata('success', 'Subject has been updated');

            //redirect
            redirect('admin/subjects');
        }
    }

    public function delete($id){
        $name = $this->Subject_model->get($id)->name;

        //delete
        $this->Subject_model->delete($id);

        //Activity Array
        $data = array(
            'resource_id' => $this->db->insert_id(),
            'type' => 'subject',
            'action' => 'deleted',
            'user_id' => 1,
            'message' => 'A subject ('.$name.') was deleted'
        );

        //insert Activity
        $this->Activity_model->add($data);

        //set message
        $this->session->set_flashdata('success', 'Subject has been deleted');

        //redirect
        redirect('admin/subjects');
	}
}
