<?php 
class NewsLetter_Model extends CI_Model
{
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update($table, $colIdName, $id, $data)
    {
        $this->db->where($colIdName, $id);
        $result = $this->db->update($table, $data);
        return $result;
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
        $this->db->where('client_type','Company');
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

    // public function getEmailsByClientId($client_id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('client_emails');
    //     $this->db->where('client_id', $client_id);
    //     return $this->db->get()->result_array();
    // }
    
    public function getclientsforEmail(){
        $this->db->select('*');
            $this->db->from('client');
            return $this->db->get()->result_array();
    }
    // public function getClientById($client_id)
    // {
    //     // Select all columns from the 'client' table
    //     $this->db->select('*');
    //     $this->db->from('client');
    //     $this->db->where('client_id', $client_id);
        
    //     // Execute the query and get the result set
    //     $query = $this->db->get();
    //     $clients = $query->result_array();
        
    //     // Initialize an array to hold the output
    //     $outArr = [];
        
    //     // Iterate through each client and fetch their emails
    //     foreach ($clients as $client) {
    //         $client['client_email'] = $this->getEmails($client['client_id']);
    //         $outArr[] = $client;
    //     }
        
    //     // Return the final array with clients and their emails
    //     return $outArr;
    // }
    
    // public function getEmails($client_id)
    // {
    //     // Select all columns from the 'client_emails' table
    //     $this->db->select('client_email');
    //     $this->db->from('client_emails');
    //     $this->db->where('client_id', $client_id);
    //     // Execute the query and get the result set
    //     $query = $this->db->get();
    //     $result = $query->result_array();
        
    //     // Return the emails
    //     return $result;
    // }
    
    // public function getClientTemplateDetails($client_id){
    //     $this->db->where_in('client_id', $client_id); 
    //     $this->db->select('*');
    //     $this->db->from('mail_template as mt');
    //     $this->db->join('quick_links as ql','mt.mail_template_id = ql.mail_template_id', 'left');
    //     $query = $this->db->get();
    //     $clients = $query->result_array(); 
    //     $outArr = [];
    //     foreach ($clients as $client) {
    //         $client['client_news'] = $this->getNewsDetails($client['client_id']);
    //         $client['compititors_data'] = $this->getCompData($client['client_id']);
    //         $client['industry_data'] = $this->getIndustryData($client['client_id']);
    //         // $client['client_news'] = $client_news; 
    //         // $compitetorIndustry['compitetor_industry'] = $compitetor_industry; 
    //         // $outArr[] = $compitetorIndustry;
    //         $outArr[] = $client;
    //     }
    //     return $outArr;
    // }

    public function getClientTemplateDetails($client_id){
        $this->db->select('mt.*');
        $this->db->from('mail_template as mt');
        $this->db->where_in('mt.client_id', $client_id);
        $this->db->group_by('mt.mail_template_id'); // Ensure unique mail_template records
        $query = $this->db->get();
        $clients = $query->result_array();
    
        foreach ($clients as &$client) {
           
            $client['get_quick_links'] = $this->getQuickLinks($client['mail_template_id']);
            $client['client_news'] = $this->getNewsDetails($client['client_id']);
            $client['compititors_data'] = $this->getCompData($client['client_id']);
            $client['industry_data'] = $this->getIndustryData($client['client_id']);
        }
        return $clients;
    }
    
    public function getQuickLinks($mail_template_id){
            $this->db->select('*');
            $this->db->from('quick_links');
            $this->db->where('mail_template_id', $mail_template_id);
            return $this->db->get()->result_array();
    }
    // public function getNewsDetails($client_id) {
    //     $date = date('Y-m-d');
    
    //     // Use subquery to exclude news_details_id from delete_news with the respective client_id
    //     $this->db->select('nd.*, (SELECT COUNT(news_artical_id) FROM news_artical WHERE news_artical.news_details_id = nd.news_details_id) as page_count');
    //     $this->db->from('news_details as nd');
    //     $this->db->where('DATE(nd.create_at)', $date);
    //     $this->db->group_start();
    //     $this->db->like('nd.client_id', ',' . $client_id . ',');
    //     $this->db->or_like('nd.client_id', $client_id . ',');
    //     $this->db->or_like('nd.client_id', ',' . $client_id);
    //     $this->db->or_where('nd.client_id', $client_id);
    //     $this->db->group_end();
    //     $this->db->where('NOT EXISTS (SELECT 1 FROM delete_news dn WHERE dn.news_details_id = nd.news_details_id AND dn.client_id = ' . $this->db->escape($client_id) . ')', null, false);
    
    //     $query = $this->db->get();
    //     $result = $query->result_array();
    
    //     return $result;
    // }

    // public function getNewsDetails($client_id) {
    //     $date = date('Y-m-d');
        
    //     $this->db->select('news_details.*, (SELECT COUNT(news_artical_id) FROM news_artical WHERE news_artical.news_details_id = news_details.news_details_id) as page_count');
    //     $this->db->from('news_details');
    //     $this->db->where('DATE(create_at)', $date);
    //     $this->db->group_start(); 
    //     $this->db->like('client_id', ',' . $client_id . ',');
    //     $this->db->or_like('client_id', $client_id . ',');
    //     $this->db->or_like('client_id', ',' . $client_id);
    //     $this->db->or_where('client_id', $client_id);
    //     $this->db->group_end(); 
        
    //     $query = $this->db->get();
    //     $result = $query->result_array(); 
    //     return $result; 
    // }

    // public function getNewsDetails($client_id) {
    //     $date = date('Y-m-d');
    //     $this->db->select('nd.*, mout.*, ed.gidEdition , ed.Edition, s.gidSupplement, s.Supplement, j.gidJournalist, j.Journalist, ac.Agency, (SELECT COUNT(na.news_artical_id) FROM news_artical as na WHERE na.news_details_id = nd.news_details_id) as page_count');
    //     $this->db->from('news_details as nd');
    //     $this->db->join('mediaoutlet as mout', 'nd.publication_id = mout.gidMediaOutlet', 'left');
    //     $this->db->join('edition as ed', 'nd.edition_id = ed.gidEdition', 'left');
    //     $this->db->join('supplements as s', 'nd.supplement_id = s.gidSupplement', 'left');
    //     $this->db->join('journalist as j', 'nd.journalist_id = j.gidJournalist', 'left');
    //     $this->db->join('Agency as ac', 'nd.journalist_id = ac.gidAgency', 'left');
    //     $this->db->where('DATE(nd.create_at)', $date);
    //     $this->db->where('is_send', 0);
    //     $this->db->group_start(); 
    //     $this->db->like('nd.company', ',' . $client_id . ',');
    //     $this->db->or_like('nd.company', $client_id . ',');
    //     $this->db->or_like('nd.company', ',' . $client_id);
    //     $this->db->or_where('nd.company', $client_id);
    //     $this->db->group_end(); 
    //     $this->db->where('NOT EXISTS (SELECT 1 FROM delete_news dn WHERE dn.news_details_id = nd.news_details_id AND dn.client_id = ' . $this->db->escape($client_id) . ')', null, false);
    
    //     $query = $this->db->get();
    //     $result = $query->result_array(); 
    //     return $result; 
    // }    
    public function getNewsDetails($client_id) {
        $date = date('Y-m-d');
    
        $this->db->distinct(); // Ensure distinct results
        $this->db->select('
            nd.*, 
            mout.*, 
            ed.gidEdition, 
            ed.Edition, 
            s.gidSupplement, 
            s.Supplement, 
            j.gidJournalist, 
            j.Journalist, 
            ac.Agency, 
            (SELECT COUNT(na.news_artical_id) FROM news_artical as na WHERE na.news_details_id = nd.news_details_id) as page_count
        ');
        $this->db->from('news_details as nd');
        $this->db->join('mediaoutlet as mout', 'nd.publication_id = mout.gidMediaOutlet', 'left');
        $this->db->join('edition as ed', 'nd.edition_id = ed.gidEdition', 'left');
        $this->db->join('supplements as s', 'nd.supplement_id = s.gidSupplement', 'left');
        $this->db->join('journalist as j', 'nd.journalist_id = j.gidJournalist', 'left');
        $this->db->join('Agency as ac', 'nd.journalist_id = ac.gidAgency', 'left');
    
        // Apply date filter
        $this->db->where('DATE(nd.create_at)', $date);
        $this->db->where('is_send', 0);
    
        // Apply client ID filter
        $this->db->group_start(); 
        $this->db->like('nd.company', ',' . $client_id . ',');
        $this->db->or_like('nd.company', $client_id . ',');
        $this->db->or_like('nd.company', ',' . $client_id);
        $this->db->or_where('nd.company', $client_id);
        $this->db->group_end(); 
    
        // Exclude deleted news for the client
        $this->db->where('NOT EXISTS (SELECT 1 FROM delete_news dn WHERE dn.news_details_id = nd.news_details_id AND dn.client_id = ' . $this->db->escape($client_id) . ')', null, false);
    
        // Execute the query
        $query = $this->db->get();
    
        // Fetch and return results
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

   

    // public function getCompNewsByKey($Keywords, $client_id)
    // {
    //     $date = date('Y-m-d');
        
    //     $this->db->select('news_details.*, (SELECT COUNT(news_artical_id) FROM news_artical WHERE news_artical.news_details_id = news_details.news_details_id) as page_count');
    //     $this->db->from('news_details');
    //     $this->db->where('DATE(create_at)', $date);
    //     $this->db->where('is_send', 0);

    //     $this->db->group_start();
    //     $this->db->where("NOT FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
    //     $this->db->group_end();
        
    //     $this->db->group_start();
    //     foreach (explode(',', $Keywords) as $keyword) {
    //         $keyword = trim($keyword); // Trim any whitespace around keywords
    //         $this->db->or_where("FIND_IN_SET('$keyword', keywords) >", 0);
    //     }
    //     $this->db->group_end();
    //     $query = $this->db->get();
    //     $result = $query->result_array(); 
    //     return $result; 
    // }

    public function getCompNewsByKey($Keywords, $client_id) {
        $date = date('Y-m-d');
        
        $this->db->select('
            nd.*, 
            mout.*, 
            ed.gidEdition, 
            ed.Edition, 
            s.gidSupplement, 
            s.Supplement, 
            j.gidJournalist, 
            j.Journalist, 
            ac.Agency, 
            (SELECT COUNT(na.news_artical_id) FROM news_artical na WHERE na.news_details_id = nd.news_details_id) as page_count
        ');
        $this->db->from('news_details as nd');
        $this->db->join('mediaoutlet as mout', 'nd.publication_id = mout.gidMediaOutlet', 'left');
        $this->db->join('edition as ed', 'nd.edition_id = ed.gidEdition', 'left');
        $this->db->join('supplements as s', 'nd.supplement_id = s.gidSupplement', 'left');
        $this->db->join('journalist as j', 'nd.journalist_id = j.gidJournalist', 'left');
        $this->db->join('Agency as ac', 'nd.journalist_id = ac.gidAgency', 'left');
        $this->db->where('DATE(nd.create_at)', $date);
        $this->db->where('is_send', 0);
        
        // Apply the client ID exclusion filter
        $this->db->group_start();
        $this->db->where("NOT FIND_IN_SET('$client_id', company)", NULL, FALSE);
        $this->db->group_end();
        
        // Apply the keyword filter
        $this->db->group_start();
        foreach (explode(',', $Keywords) as $keyword) {
            $keyword = trim($keyword); // Trim any whitespace around keywords
            $this->db->or_where("FIND_IN_SET('$keyword', keywords) >", 0);
        }
        $this->db->group_end();
        
        // Exclude deleted news for the client
        $this->db->where('NOT EXISTS (SELECT 1 FROM delete_news dn WHERE dn.news_details_id = nd.news_details_id AND dn.client_id = ' . $this->db->escape($client_id) . ')', null, false);
        
        // Execute the query
        $query = $this->db->get();
        
        // Fetch and return results
        $result = $query->result_array(); 
        return $result; 
    }

    public function getNewsDataById($news_details_id) {
        $this->db->select('nd.*, mout.*, ed.gidEdition , ed.Edition, s.gidSupplement, s.Supplement, j.gidJournalist, j.Journalist');
        // $this->db->from('news_details');
        $this->db->from('news_details as nd');
        $this->db->join('mediaoutlet as mout', 'nd.publication_id = mout.gidMediaOutlet', 'left');
        $this->db->join('edition as ed', 'nd.edition_id = ed.gidEdition', 'left');
        $this->db->join('supplements as s', 'nd.supplement_id = s.gidSupplement', 'left');
        $this->db->join('journalist as j', 'nd.journalist_id = j.gidJournalist', 'left');

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
    

    public function getNewsByNewsDetailsId($news_details_id)
    {
        $this->db->select('*');
        $this->db->from('news_details');
        $this->db->where('news_details_id', $news_details_id);
        return $this->db->get()->result_array();
    }
}
?>