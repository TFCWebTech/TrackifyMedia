<?php 
class Client_Model extends CI_Model
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
  
}
?>