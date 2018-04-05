<?php
//to control acess
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function index(){
        $data['pages'] = $this->Page_model->get_list();
                //		location, as default template, view to load
        $this->template->load('admin', 'default', 'pages/index', $data);
    }

    public function add(){
        //validations
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required');
        $this->form_validation->set_rules('body', 'Body', 'trim|required');
        $this->form_validation->set_rules('is_published', 'Publish', 'required');
        $this->form_validation->set_rules('is_featured', 'Feature', 'required');
        $this->form_validation->set_rules('order', 'Order', 'integer');

        if($this->form_validation->run() == FALSE){
            //to pass subject list to add page
            $subject_options = array();
            $subject_options[0] = 'Select Subject';

            $subject_list = $this->Subject_model->get_list();

            foreach($subject_list as $subject){
                $subject_options[$subject->id] = $subject->name;
            }
            //subject
            $data['subject_options'] = $subject_options;

            //Load template
            $this->template->load('admin', 'default', 'pages/add', $data);
        }else{
            $slug = str_replace(' ', '-', $this->input->post('title'));
            $slug = strtolower($slug);

            $data = array(
                'title'         => $this->input->post('title'),
                'slug'          => $slug,
                'subject_id'    => $this->input->post('subject_id'),
                'body'          => $this->input->post('body'),
                'is_published'  => $this->input->post('is_published'),
                'is_featured'   => $this->input->post('is_featured'),
                'in_menu'       => $this->input->post('in_menu'),
                'user_id'       => 1,
                'order'         => $this->input->post('order')
            );

            //insert Page
            $this->Page_model->add($data);

             //Activity Array
             $data = array(
                'resource_id' => $this->db->insert_id(),
                'type' => 'page',
                'action' => 'added',
                'user_id' => 1,
                'message' => 'A new page was added ('.$data["title"].')'
            );

            //insert Activity
            $this->Activity_model->add($data);

            //set message
            $this->session->set_flashdata('success', 'Page has been added');

            //redirect
            redirect('admin/pages');
        }
        
    }

    public function edit($id){
         //Define rules -----------------Name field, readable name, rules
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required');
        $this->form_validation->set_rules('body', 'Body', 'trim|required');
        $this->form_validation->set_rules('is_published', 'Publish', 'required');
        $this->form_validation->set_rules('is_featured', 'Feature', 'required');
        $this->form_validation->set_rules('order', 'Order', 'integer');

         //check state of form validation
         if($this->form_validation->run() == False){
             //get current subject
             $data['item'] = $this->Page_model->get($id);

             //to pass subject list to add page
            $subject_options = array();
            $subject_options[0] = 'Select Subject';

            $subject_list = $this->Subject_model->get_list();

            foreach($subject_list as $subject){
                $subject_options[$subject->id] = $subject->name;
            }
            //subject
            $data['subject_options'] = $subject_options;
 
            $this->template->load('admin', 'default', 'pages/edit', $data);
         }else{
            $slug = str_replace(' ', '-', $this->input->post('title'));
            $slug = strtolower($slug);

            $data = array(
                'title'         => $this->input->post('title'),
                'slug'          => $slug,
                'subject_id'    => $this->input->post('subject_id'),
                'body'          => $this->input->post('body'),
                'is_published'  => $this->input->post('is_published'),
                'is_featured'   => $this->input->post('is_featured'),
                'in_menu'       => $this->input->post('in_menu'),
                'user_id'       => 1,
                'order'         => $this->input->post('order')
            );

            //Update Page
            $this->Page_model->update($id, $data);

             //Activity Array
             $data = array(
                'resource_id'   => $this->db->insert_id(),
                'type'          => 'page',
                'action'        => 'updated',
                'user_id'       => 1,
                'message'       => 'A page was updated ('.$data["title"].')'
            );

            //insert Activity
            $this->Activity_model->add($data);

            //set message
            $this->session->set_flashdata('success', 'Page has been updated');

            //redirect
            redirect('admin/pages');
        }
    }

    public function delete($id){
        $title = $this->Page_model->get($id)->title;

        //delete
        $this->Page_model->delete($id);

        //Activity Array
        $data = array(
            'resource_id' => $this->db->insert_id(),
            'type' => 'subject',
            'action' => 'deleted',
            'user_id' => 1,
            'message' => 'A page ('.$title.') was deleted'
        );

        //insert Activity
        $this->Activity_model->add($data);

        //set message
        $this->session->set_flashdata('success', 'Page has been deleted');

        //redirect
        redirect('admin/pages');
	}
}
