<?php 
class SuperAdmin_model extends CI_Model
{
	
    public function getReporterData()
    {
        $sql="SELECT * FROM `user`; ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function checkUser($userId, $enc_pass)
    {
        // login.....
        $sql = "SELECT * FROM `super_admin` WHERE `super_admin_name`='$userId' AND `super_admin_password`='$enc_pass'";
        $query = $this->db->query($sql);
        return $query->row_array(); // Return null if no user found
    }
    
}
?>