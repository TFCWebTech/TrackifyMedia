<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageJournlModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getalljournalists() {
        // $query = $this->db->get('journalist');
        // return $query->result_array();
        $this->db->select('*');
        $this->db->from('journalist as j');
        $this->db->join('mediaoutlet as mo','j.gigMediaOutlet = mo.gidMediaOutlet', 'left');
        $this->db->order_by('gidJournalist', 'DESC');
        return $this->db->get()->result_array();
    }

   // Example method to add a journalist (adjust fields as per your table)
    public function addjournalist($data) {
        $this->db->insert('journalist', $data);
    }

    public function update($table, $colIdName, $id, $data)
    {
        $this->db->where($colIdName, $id);
        $result = $this->db->update($table, $data);
        return $result;
    }
    public function getMediaOutLet(){
        $this->db->select('*');
        $this->db->from('mediaoutlet');
        return $this->db->get()->result_array();
    }

    public function editJournalist()
    {
        $this->db->select('*');
        $this->db->from('Journalist');
        $this->db->order_by('gidJournalist', 'DESC');
        return $this->db->get()->result_array();
    }
    public function mediatype(){
        $this->db->select('gidMediaType, MediaType');
        $this->db->from('mediatype');
        return $this->db->get()->result_array();
    }
}
 

