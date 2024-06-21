<?php 
class Login_model extends CI_Model
{
	
    // public function checkClient($userId, $enc_pass)
    // {
    //     // login.....
    //     $sql = "SELECT * FROM `client` WHERE `email`='$userId' and `password`='$enc_pass' ";
    //     $query = $this->db->query($sql);
    //     return $query->row_array(); // Return null if no user found
    // }
    
    public function checkClient($userId, $enc_pass)
    {
    // login.....
    $sql = "SELECT * FROM `client` WHERE `email` = ? AND `password` = ? AND `client_type` = 'User'";
    $query = $this->db->query($sql, array($userId, $enc_pass));
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