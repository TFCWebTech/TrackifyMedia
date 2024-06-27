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
    public function add_editions($data) {
        return $this->db->insert('edition', $data); 
    }

     // Method to insert data into the edition table
    //  public function insert_editions($data) {
    //     return $this->db->insert('edition', $data);
    // }

    public function update($table, $colIdName, $id, $data)
    {
        $this->db->where($colIdName, $id);
        $result = $this->db->update($table, $data);
        return $result;
    }
   

    public function getAlledition()
    {
        $this->db->select('*');
        $this->db->from('edition as ed');
        $this->db->join('mediaoutlet as mo', 'ed.MediaOutletId = mo.gidMediaOutlet', 'left');
        $this->db->order_by('Edition', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getMediaOutLet()
    {
        $this->db->select('*');
        $this->db->from('mediaoutlet');
        // $this->db->join('mediaoutlet as mo', 'adr.gidMediaOutlet = mo.gidMediaOutlet', 'left');
        return $this->db->get()->result_array();
  
    }

   
}

