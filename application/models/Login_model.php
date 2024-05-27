<?php 
class Login_model extends CI_Model
{
	
    public function checkUser($userId, $enc_pass)
    {
        // login.....
        $sql = "SELECT * FROM `user` WHERE `user_name`='$userId' AND `user_password`='$enc_pass'";
        $query = $this->db->query($sql);
        return $query->row_array(); // Return null if no user found
    }

    public function checkemail($email)
    {
    	$sql="SELECT * FROM  `login`  WHERE `email`='$email' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function getSampleOrderCustomerName($sample_request_id)
    {
    	// $sql="SELECT * FROM  `customer` ";
        // $query = $this->db->query($sql);
        // return $query->row_array();
        $this->db->select('c.customer_name');
        $this->db->from('sample_request as s');
        $this->db->join('customer as c', 's.customer_id = c.customer_id', 'left');
        $this->db->where('s.sample_request_id', $sample_request_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function checkGeneralOrderEmail($order_id)
    {
    	// $sql="SELECT * FROM  `customer` ";
        // $query = $this->db->query($sql);
        // return $query->row_array();
        $this->db->select('c.customer_name');
        $this->db->from('orders as o');
        $this->db->join('customer as c', 'o.customer_id = c.customer_id', 'left');
        $this->db->where('o.order_id ', $order_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function checkEmailAddStaff($searchEmail)
    {
    	$sql="SELECT * FROM  `login` WHERE `email`= '$searchEmail' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function checkEmaileditStaff($searchEmail, $loginID)
    {
    	$sql="SELECT * FROM  `login` WHERE `email`= '$searchEmail' AND `login_id` != '$loginID' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function checkEmaileditCustomer($searchEmail, $customerId)
    {
    	$sql="SELECT * FROM  `customer` WHERE `customer_email`= '$searchEmail' AND `customer_id` != '$customerId' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function checkCustomerEmail($customer_email)
    {
    	$sql="SELECT * FROM  `customer`  WHERE `customer_email`='$customer_email' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function checkLoginToken($login_id, $token)
    {
        $sql="SELECT * FROM `login` WHERE `login_id`='$login_id' AND `token`='$token'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function checkCustomerToken($customer_id, $token)
    {
        $sql="SELECT * FROM `customer` WHERE `customer_id`='$customer_id' AND `token`='$token'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function update($table, $colIdName, $id, $data)
    {
        $this->db->where($colIdName, $id);
        $result = $this->db->update($table, $data);
        return $result;
    }
    public function updateCustomer($table, $colIdName, $id, $data)
    {
        $this->db->where($colIdName, $id);
        $result = $this->db->update($table, $data);
        return $result;
    }

}
?>