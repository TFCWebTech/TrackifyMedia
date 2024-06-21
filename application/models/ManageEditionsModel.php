<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageEditionsmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Method to fetch editions data
    public function get_editions() {
        $query = $this->db->get('edition'); 
        return $query->result_array();
    }

    // Method to insert data into the database
    public function add_edition($data) {
        return $this->db->insert('edition', $data); 
    }

     // Method to insert data into the edition table
     public function insert_edition($data) {
        return $this->db->insert('edition', $data);
    }

    public function update($table, $colIdName, $id, $data)
    {
        $this->db->where($colIdName, $id);
        $result = $this->db->update($table, $data);
        return $result;
    }

    public function getAlledition()
    {
        $this->db->select('*');
        $this->db->from('edition');
        $this->db->order_by('Edition', 'DESC');
        return $this->db->get()->result_array();
    }
}

