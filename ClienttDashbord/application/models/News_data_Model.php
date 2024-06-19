<?php 
class News_data_Model extends CI_Model
{
  
        public function getPublicationTypeData(){
        $this->db->select('gidPublicationType, PublicationType');
        $this->db->from('publicationtype');
        return $this->db->get()->result_array();
        }

        public function getNewsCityData(){
        $this->db->select('*');
        $this->db->from('newscity');
        return $this->db->get()->result_array();
        }

        public function getReportData($client_id, $from_date = null, $to_date = null, $publication_type, $Cities) {
            // Ensure $client_id is an array
            if (!is_array($client_id)) {
                $client_id = array($client_id); 
            }
            // Convert $client_id array to a comma-separated string of integers
            $client_ids = implode(',', array_map('intval', $client_id));
            
            // Begin building the query
            $this->db->select('*');  
            $this->db->from('news_details as nd'); 
            $this->db->join('mediatype as mt', 'nd.media_type_id = mt.gidMediaType', 'left');
            $this->db->join('mediaoutlet as mo', 'nd.publication_id = mo.gidMediaOutlet', 'left');
            $this->db->join('edition as e', 'nd.edition_id = e.gidEdition', 'left');
            $this->db->join('supplements as sp', 'nd.supplement_id = sp.gidSupplement', 'left');
            $this->db->join('newscity as nc', 'nd.news_city_id = nc.gidNewscity', 'left');
            // Build client_id conditions
            $client_id_conditions = array_map(function($id) {
                return "FIND_IN_SET('$id', nd.client_id) > 0";
            }, $client_id);
        
            // Join the conditions with OR to match any client_id
            $this->db->where('('.implode(' OR ', $client_id_conditions).')');
        
            // if (!empty($Cities) && $Cities !== 'Select') {
            //         $this->db->where('nd.news_city_id', $Cities);
            //     }

            // Optionally add date filtering if $from_date and $to_date are provided
            if ($from_date !== null && $to_date !== null) {
                $this->db->where('nd.create_at >=', $from_date);
                $this->db->where('nd.create_at <=', $to_date);
            }
            // Execute the query and return the result
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
        public function getNewsArticalData($news_details_id){
            $this->db->select('*');
            $this->db->from('news_artical');
            $this->db->where('news_details_id', $news_details_id);
            return $this->db->get()->result_array();
        }
        

        // public function getClientTemplateDetails($client_id){
        //     $this->db->select('mt.*');
        //     $this->db->from('mail_template as mt');
        //     $this->db->where_in('mt.client_id', $client_id);
        //     $this->db->group_by('mt.mail_template_id'); // Ensure unique mail_template records
        //     $query = $this->db->get();
        //     $clients = $query->result_array();
        
        //     foreach ($clients as &$client) {
        //         $this->db->select('*');
        //         $this->db->from('quick_links');
        //         $this->db->where('mail_template_id', $client['mail_template_id']);
        //         $client['quick_links'] = $this->db->get()->result_array();
        
        //         $client['client_news'] = $this->getNewsDetails($client['client_id']);
        //         $client['compititors_data'] = $this->getCompData($client['client_id']);
        //         $client['industry_data'] = $this->getIndustryData($client['client_id']);
        //     }
        //     return $clients;
        // }
        public function getClientTemplateDetails($client_id) {
            // Fetch mail templates for the given client ID
            $this->db->select('mt.*');
            $this->db->from('mail_template as mt');
            $this->db->where_in('mt.client_id', $client_id);
            $this->db->group_by('mt.mail_template_id'); // Ensure unique mail_template records
            $query = $this->db->get();
            $clients = $query->result_array();
        
            // Log the mail templates fetched
            log_message('debug', 'Mail templates fetched: ' . print_r($clients, true));
        
            foreach ($clients as &$client) {
                // Fetch quick links for each mail template
                $this->db->select('*');
                $this->db->from('quick_links');
                $this->db->where('mail_template_id', $client['mail_template_id']);
                $quick_links_query = $this->db->get();
                $client['quick_links'] = $quick_links_query->result_array();
        
                // Debugging: Check if quick links data is fetched correctly
                log_message('debug', 'Quick links query executed for mail_template_id: ' . $client['mail_template_id']);
                log_message('debug', 'Quick links data: ' . print_r($client['quick_links'], true));
        
                // Fetch client news details
                $client['client_news'] = $this->getNewsDetails($client['client_id']);
                
                // Fetch competitors data
                $client['compititors_data'] = $this->getCompData($client['client_id']);
                
                // Fetch industry data
                $client['industry_data'] = $this->getIndustryData($client['client_id']);
            }
        
            return $clients;
        }
    
        public function getNewsDetails($client_id) {
            $date = date('Y-m-d');
        
            // Use subquery to exclude news_details_id from delete_news with the respective client_id
            $this->db->select('nd.*, (SELECT COUNT(news_artical_id) FROM news_artical WHERE news_artical.news_details_id = nd.news_details_id) as page_count');
            $this->db->from('news_details as nd');
            $this->db->where('DATE(nd.create_at)', $date);
            $this->db->group_start();
            $this->db->like('nd.client_id', ',' . $client_id . ',');
            $this->db->or_like('nd.client_id', $client_id . ',');
            $this->db->or_like('nd.client_id', ',' . $client_id);
            $this->db->or_where('nd.client_id', $client_id);
            $this->db->group_end();
            $this->db->where('NOT EXISTS (SELECT 1 FROM delete_news dn WHERE dn.news_details_id = nd.news_details_id AND dn.client_id = ' . $this->db->escape($client_id) . ')', null, false);
        
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
}
?>