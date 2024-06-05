<?php 
class NewsLetter_Model extends CI_Model
{
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
 
    // public function getClients(){
    //     $sql="SELECT * FROM `client`  ";
    //     $query = $this->db->query($sql);
    //     return $query->result_array();
    // }

    public function getClients() {
        // Fetch all clients from the 'client' table
        $this->db->select('*');
        $this->db->from('client');
        $query = $this->db->get();
        $clients = $query->result_array(); // Store the result in $clients
    
        $outArr = [];
        foreach ($clients as $client) {
            $client_news = $this->getNews($client['client_id']);
            $client['client_news'] = $client_news; 
            $outArr[] = $client;
        }
    
        return $outArr; // Return the final output array
    }
    
    public function getNews($client_id) {
        // Fetch news details for the given client_id with is_send = 0
        $this->db->select('*');
        $this->db->from('news_details');
        $this->db->where('is_send', '0');
        
        $this->db->group_start(); // Start grouping for client_id conditions
        $this->db->like('client_id', ',' . $client_id . ',');
        $this->db->or_like('client_id', $client_id . ',');
        $this->db->or_like('client_id', ',' . $client_id);
        $this->db->or_where('client_id', $client_id);
        $this->db->group_end(); // End grouping
    
        $query = $this->db->get();
        $result = $query->result_array(); // Store the result in $result
    
        return $result; // Return the news details
    }
    
    
    

    public function getClientTemplate($client_ids) {
        $this->db->where_in('client_id', $client_ids); 
        $this->db->select('*');
        $this->db->from('mail_template');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    
}
?>