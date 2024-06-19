<?php 
class Manage_Admin_Model extends CI_Model
{
	
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function getReporterData()
    {
        $sql="SELECT * FROM `user`; ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getPublicationType(){
        $this->db->select('gidPublicationType, PublicationType');
        $this->db->from('publicationtype');
        return $this->db->get()->result_array();
    }

    public function mediatype(){
        $this->db->select('gidMediaType, MediaType');
        $this->db->from('mediatype');
        return $this->db->get()->result_array();
    }
    public function getPublication(){
        $this->db->select('gidMediaOutlet, MediaOutlet');
        $this->db->from('mediaoutlet');
        return $this->db->get()->result_array();
    }
    public function getEdition(){
        $this->db->select('gidEdition, Edition');
        $this->db->from('edition');
        return $this->db->get()->result_array();
    }
    public function getsupplements(){
        $this->db->select('gidSupplement, Supplement');
        $this->db->from('supplements');
        return $this->db->get()->result_array();
    }
    public function getnewscity(){
        $this->db->select('gidNewscity, CityName');
        $this->db->from('newscity');
        return $this->db->get()->result_array();
    }
    public function getjournalist(){
        $this->db->select('gidJournalist, Journalist');
        $this->db->from('journalist');
        return $this->db->get()->result_array();
    }
    public function getagency(){
        $this->db->select('gidAgency, Agency');
        $this->db->from('Agency');
        return $this->db->get()->result_array();
    }
   
    public function getPublicationData(){
        $this->db->select('*');
        $this->db->from('mediaoutlet as mo');
        $this->db->join('publicationtype as pt','mo.gidPublicationType = pt.gidPublicationType', 'left');
        $this->db->join('mediatype as mt','mo.gidMediaType = mt.gidMediaType', 'left');
        return $this->db->get()->result_array();
    }

    public function update($table, $colIdName, $id, $data)
    {
        $this->db->where($colIdName, $id);
        $result = $this->db->update($table, $data);
        return $result;
    }

    
}
?>