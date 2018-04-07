<?php
//to control acess
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index(){
        $data['users'] = $this->User_model->get_list();
        //		location, as default template, view to load
        $this->template->load('admin', 'default', 'users/index', $data);
    }

    public function add(){
         //validations
         $this->form_validation->set_rules('first_name', 'First Namw', 'trim|required|min_length[2]');
         $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]');
         $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
         $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[7]|valid_email');
         $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|matches[password2]');
         $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|min_length[6]|matches[password2]');
 
         if($this->form_validation->run() == FALSE){
             //Load template
             $this->template->load('admin', 'default', 'users/add');
         }else{
            
             $data = array(
                 'first_name'   => $this->input->post('first_name'),
                 'last_name'    => $this->input->post('last_name'),
                 'username'     => $this->input->post('username'),
                 'email'        => $this->input->post('email'),
                 'password'     => md5($this->input->post('password'))
             );
 
             //insert Page
             $this->User_model->add($data);
 
              //Activity Array
              $data = array(
                 'resource_id' => $this->db->insert_id(),
                 'type' => 'user',
                 'action' => 'added',
                 'user_id' => 1,//$this->session->userdata('user_id'),
                 'message' => 'A new user was added ('.$data["username"].')'
             );
 
             //insert Activity
             $this->Activity_model->add($data);
 
             //set message
             $this->session->set_flashdata('success', 'User has been added');
 
             //redirect
             redirect('admin/users');
         }
    }

    public function edit($id){
        //validations
        $this->form_validation->set_rules('first_name', 'First Namw', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[7]|valid_email');

        if($this->form_validation->run() == FALSE){
            $data['item'] = $this->User_model->get($id);
            //Load template
            $this->template->load('admin', 'default', 'users/edit', $data);
        }else{

            $data = array(
                'first_name'   => $this->input->post('first_name'),
                'last_name'    => $this->input->post('last_name'),
                'username'     => $this->input->post('username'),
                'email'        => $this->input->post('email')
            );

            //insert Page
            $this->User_model->update($id, $data);

             //Activity Array
            $data = array(
                'resource_id' => $this->db->insert_id(),
                'type' => 'user',
                'action' => 'updated',
                'user_id' => 1,//$this->session->userdata('user_id'),
                'message' => 'A user was updated ('.$data["username"].')'
            );

            //insert Activity
            $this->Activity_model->add($data);

            //set message
            $this->session->set_flashdata('success', 'User has been updated');

            //redirect
            redirect('admin/users');
        }
        
    }

    public function delete($id){
        $username = $this->User_model->get($id)->username;

        //delete
        $this->User_model->delete($id);

        //Activity Array
        $data = array(
            'resource_id' => $this->db->insert_id(),
            'type' => 'user',
            'action' => 'deleted',
            'user_id' => 1,
            'message' => 'A user ('.$username.') was deleted'
        );

        //insert Activity
        $this->Activity_model->add($data);

        //set message
        $this->session->set_flashdata('success', 'User has been deleted');

        //redirect
        redirect('admin/users');
    }

    public function login(){

    }

    public function logout(){

	}
}
