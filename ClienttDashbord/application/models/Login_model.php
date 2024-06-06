<?php 
class Login_model extends CI_Model
{
	
    public function checkClient($userId, $enc_pass)
    {
        // login.....
        $sql = "SELECT * FROM `client` WHERE `email`='$userId' AND `password`='$enc_pass'";
        $query = $this->db->query($sql);
        return $query->row_array(); // Return null if no user found
    }

    public function checkemail($email)
    {
    	$sql="SELECT * FROM  `login`  WHERE `email`='$email' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

   
}
?>