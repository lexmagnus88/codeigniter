<?php
//to control acess
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

    function __construct(){
        parent::__construct();

    }
    
	public function index(){
        //check login
        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
        $data['users'] = $this->User_model->get_list();
        //		location, as default template, view to load
        $this->template->load('admin', 'default', 'users/index', $data);
    }

    public function add(){
        //check login
        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
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
                 'user_id' => $this->session->userdata('user_id'),
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
        //check login
        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
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
                'user_id' => $this->session->userdata('user_id'),
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
        //check login
        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
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
        //validations
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
 
        if($this->form_validation->run() == FALSE){
            //Load template
            $this->template->load('admin', 'login', 'users/login');
        }else{
            
            //get Post Data
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $enc_password = md5($password);
 
            $user_id = $this->User_model->login($username, $enc_password);

            if($user_id){
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true
                );
            
                $this->session->set_userdata($user_data);

                //set message
                $this->session->set_flashdata('success', 'You are logged in');
    
                //redirect
                redirect('admin');
            }else{

                //set error message
                $this->session->set_flashdata('error', 'Invalid Login');
    
                //redirect
                redirect('admin/users/login');
            }
        }
    }

    public function logout(){
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();

        //message
        $this->session->set_flashdata('success', 'You are logged out');
        redirect('admin/users/login');
	}
}
