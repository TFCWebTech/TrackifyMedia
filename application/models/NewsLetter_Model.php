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
        $clients = $query->result_array(); 
    
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

    public function getClientById($client_id)
    {
        $this->db->select('*');
        $this->db->from('client');
        $this->db->where('client_id', $client_id);
        return $this->db->get()->row_array();
    }
    
    public function getClientTemplateDetails($client_id){
        $this->db->where_in('client_id', $client_id); 
        $this->db->select('*');
        $this->db->from('mail_template as mt');
        $this->db->join('quick_links as ql','mt.mail_template_id = ql.mail_template_id', 'left');
        $query = $this->db->get();
        $clients = $query->result_array(); 
        $outArr = [];
        foreach ($clients as $client) {
            $client['client_news'] = $this->getNewsDetails($client['client_id']);
            $client['compititors_data'] = $this->getCompData($client['client_id']);
            $client['industry_data'] = $this->getIndustryData($client['client_id']);
            // $client['client_news'] = $client_news; 
            // $compitetorIndustry['compitetor_industry'] = $compitetor_industry; 
            // $outArr[] = $compitetorIndustry;
            $outArr[] = $client;
        }
        return $outArr;

    }

    public function getNewsDetails($client_id) {
        $date = date('Y-m-d');
        
        $this->db->select('news_details.*, (SELECT COUNT(news_artical_id) FROM news_artical WHERE news_artical.news_details_id = news_details.news_details_id) as page_count');
        $this->db->from('news_details');
        $this->db->where('DATE(create_at)', $date);
        $this->db->group_start(); 
        $this->db->like('client_id', ',' . $client_id . ',');
        $this->db->or_like('client_id', $client_id . ',');
        $this->db->or_like('client_id', ',' . $client_id);
        $this->db->or_where('client_id', $client_id);
        $this->db->group_end(); 
    
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result; 
    }

    public function getCompIndustry($client_id){
        $date = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('mail_template');
        $this->db->where('DATE(create_at)', $date);
        $this->db->group_start(); 
        $this->db->like('client_id', ',' . $client_id . ',');
        $this->db->or_like('client_id', $client_id . ',');
        $this->db->or_like('client_id', ',' . $client_id);
        $this->db->or_where('client_id', $client_id);
    
        $query = $this->db->get();
        $result = $query->result_array(); 
    
        return $result; 
    }
    
    public function getIndustryData($client_id){
        $this->db->select('*');
        $this->db->from('industry');
        $this->db->where("FIND_IN_SET('$client_id', client_id) >", 0);
        $result = $this->db->get()->result_array();
        $outArr = array();
        foreach ($result as $row){
            $row['news'] = $this->getCompNewsByKey($row['Keywords'], $client_id);
            $outArr[] = $row;
        }
        return $outArr;
    }

    public function getCompData($client_id)
    {
        $this->db->select('*');
        $this->db->from('competitor');
        $this->db->where('client_id', $client_id);
        $result = $this->db->get()->result_array();
        $outArr = array();
        foreach ($result as $row){
            $row['news'] = $this->getCompNewsByKey($row['Keywords'], $client_id);
            $outArr[] = $row;
        }
        return $outArr;
    }

    public function getCompNewsByKey($Keywords, $client_id)
    {
        $date = date('Y-m-d');
        
        $this->db->select('news_details.*, (SELECT COUNT(news_artical_id) FROM news_artical WHERE news_artical.news_details_id = news_details.news_details_id) as page_count');
        $this->db->from('news_details');
        $this->db->where('DATE(create_at)', $date);
        $this->db->where('is_send', 0);

        $this->db->group_start();
        $this->db->where("NOT FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();
        
        $this->db->group_start();
        foreach (explode(',', $Keywords) as $keyword) {
            $keyword = trim($keyword); // Trim any whitespace around keywords
            $this->db->or_where("FIND_IN_SET('$keyword', keywords) >", 0);
        }
        $this->db->group_end();
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result; 
    }

    public function getNewsDataById($news_details_id) {
        $this->db->select('*');
        $this->db->from('news_details');
        $this->db->where('news_details_id', $news_details_id);
        $result = $this->db->get()->row_array();
        if ($result) {
            $result['news_article'] = $this->getNewsArticleByNews($news_details_id);
        }
        return $result;
    }
    
    public function getNewsArticleByNews($news_details_id) {
        $this->db->select('*');
        $this->db->from('news_artical as na');
        $this->db->where('news_details_id', $news_details_id);
        $this->db->join('artical_images as ai','na.artical_images_id = ai.artical_images_id', 'left');
        return $this->db->get()->result_array();
    }
    
}
?>