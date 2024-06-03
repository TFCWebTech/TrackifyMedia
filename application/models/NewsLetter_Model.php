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
        $this->db->select('*');
        $this->db->from('client');
        $query = $this->db->get();
        $result = $query->result_array();
        $outArr = [];
        foreach ($result as $row) {
            $client_templates = $this->getClientTemplate($row['client_id']);
            $client_ids = explode(',', $row['client_id']);
            $news_data = $this->getNews($client_ids);
            $row['client_templates'] = $client_templates; 
            $row['news_data'] = $news_data; 
            $outArr[] = $row;
        }
        return $outArr;
    }
    
    public function getNews($client_ids){
        $outArr = [];
        foreach ($client_ids as $client_id) {
            $client_ids = explode(',', $row['client_id']);
            $this->db->where('client_id', $client_id);
            $this->db->select('*');
            $this->db->from('news_details');
            $query = $this->db->get();
            $result = $query->result_array();
            $outArr = array_merge($outArr, $result);
        }
        return $outArr;
    }
    
    public function getClientTemplate($client_ids){
        $this->db->where_in('client_id', $client_ids); 
        $this->db->select('*');
        $this->db->from('mail_template');
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
    
}
?>