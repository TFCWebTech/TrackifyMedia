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
        $sql="SELECT * FROM `client` WHERE client_type = 'Company'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update($table, $colIdName, $id, $data)
    {
        $this->db->where($colIdName, $id);
        $result = $this->db->update($table, $data);
        return $result;
    }
  
    public function getUserEMailToken($insert_id){
            $this->db->select('*');
            $this->db->from('client');
            $this->db->where('client_id', $insert_id);
            return $this->db->get()->result_array();
        }
    public function checkLoginToken($users_mails_id, $token){
        $sql="SELECT * FROM client WHERE client_id='$users_mails_id' AND token='$token'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }    

    public function getUserEMail($client_email) {
        $sql = "SELECT * FROM client WHERE email = ? AND client_type = 'User'";
        $query = $this->db->query($sql, array($client_email));
        return $query->row_array();
    }

    }
?>