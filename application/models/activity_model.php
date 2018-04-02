<?php
class Activity_model extends CI_MODEL{
    function __construct(){
        parent::__construct();
        //to create table
        $this->table = 'activities';
    }

    public function get_list(){
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function add($data){
        $this->db->insert($this->table, $data);
    }
}