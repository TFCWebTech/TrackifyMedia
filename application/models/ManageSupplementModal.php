<?php 
class ManageSupplementModal extends CI_Model
{
	
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function getClients() {
        // $sql="SELECT * FROM `client` WHERE `client_keywords` = $keywordData ; ";
        $sql="SELECT * FROM `client`  ; ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update($table, $colIdName, $id, $data)
    {
        $this->db->where($colIdName, $id);
        $result = $this->db->update($table, $data);
        return $result;
    }
    
    public function getAllSuplement()
    {
        $this->db->select('*');
        $this->db->from('supplements');
        $this->db->order_by('supplement_id', 'DESC');
        return $this->db->get()->result_array();
    }

     public function getMediaOutLet(){
        $this->db->select('*');
        $this->db->from('mediaoutlet');
        return $this->db->get()->result_array();
    }

    public function getEdition(){
        $this->db->select('*');
        $this->db->from('edition');
        return $this->db->get()->result_array();
    }
}
?>