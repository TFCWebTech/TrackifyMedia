<?php 
class Reporter_Model extends CI_Model
{
	
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function getReporterData()
    {
        $sql="SELECT * FROM `user`; ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getMediaType(){
        $this->db->select('gidMediaType, MediaType');
        $this->db->from('mediatype');
        return $this->db->get()->result_array();
    }

        public function getPublication(){
        $this->db->select('gidMediaOutlet, MediaOutlet');
        $this->db->from('mediaoutlet');
        return $this->db->get()->result_array();
    }
    public function getEdition(){
        $this->db->select('gidEdition, Edition');
        $this->db->from('edition');
        return $this->db->get()->result_array();
    }
    public function getsupplements(){
        $this->db->select('gidSupplement, Supplement');
        $this->db->from('supplements');
        return $this->db->get()->result_array();
    }
    public function getnewscity(){
        $this->db->select('gidNewscity, CityName');
        $this->db->from('newscity');
        return $this->db->get()->result_array();
    }
    public function getjournalist(){
        $this->db->select('gidJournalist, Journalist');
        $this->db->from('journalist');
        return $this->db->get()->result_array();
    }
    public function getagency(){
        $this->db->select('gidAgency, Agency');
        $this->db->from('Agency');
        return $this->db->get()->result_array();
    }
    
    public function getKeywords() {
       
        $sql = "SELECT client_keywords FROM `client`; ";
        $query = $this->db->query($sql);
        
        // Check if any rows are returned
        if ($query->num_rows() > 0) {
            // Initialize an empty array to store all keywords
            $all_keywords = array();
            
            // Loop through the result set
            foreach ($query->result_array() as $row) {
                // Check if $row is an array and if 'client_keywords' key exists
                if (is_array($row) && isset($row['client_keywords'])) {
                    // Split the client_keywords by commas
                    $keywords = explode(',', $row['client_keywords']);
                    
                    // Trim each keyword to remove leading/trailing whitespace
                    $keywords = array_map('trim', $keywords);
                    
                    // Merge the keywords into the all_keywords array
                    $all_keywords = array_merge($all_keywords, $keywords);
                } else {
                    // Log or handle the case where 'client_keywords' is not found or $row is not an array
                }
            }
            
            // Remove duplicates from the combined keywords array
            $all_keywords = array_unique($all_keywords);
            
            // Return the combined and unique keywords array
            return $all_keywords;
        } else {
            // Return an empty array if no keywords are found
            return array();
        }
    }
    public function findKeywords($get_keywords ) {
        // Check if $get_keywords is already an array
        if (is_array($get_keywords)) {
            // If it's an array, simply return it
            return $get_keywords;
        }
        // Split the string by commas
        $values_array = explode(',', $get_keywords);
    
        // Trim each value to remove leading/trailing whitespace
        $values_array = array_map('trim', $values_array);
        $values_array = array_unique($values_array);
        return $values_array;
    }
  
    
    // public function getAllNews() {
    //     $this->db->where('nd.is_send', 0);
    //     $this->db->order_by('nd.news_details_id');
    //     $this->db->select('nd.*, na.*');
    //     $this->db->from('news_artical as na');
    //     $this->db->join('news_details as nd', 'na.news_details_id = nd.news_details_id', 'left');
    //     // $this->db->group_by('na.news_artical_id');  // Group by news_details_id to ensure unique rows
    //     $result = $this->db->get()->result_array();
    //     $outArr = array();
    //     foreach ($result as $row) {
    //         $client_ids = explode(',', $row['client_id']);
    //         $client_names = $this->getClientName($client_ids);
    //         $row['client_data'] = $client_names;
    //         $outArr[] = $row;
    //     }
    //     return $outArr;
    // }
    // public function getAllNews() {
    //         $this->db->where('nd.is_send', 0);
    //         $this->db->order_by('nd.news_details_id');
    //         $this->db->select('nd.*, na.*');
    //         $this->db->from('news_details as nd');
    //         $this->db->join('news_artical as na', 'na.news_details_id = nd.news_details_id', 'left');
    //         // $this->db->group_by('na.news_artical_id');  // Group by news_details_id to ensure unique rows
    //         $result = $this->db->get()->result_array();
    //         $outArr = array();
    //         foreach ($result as $row) {
    //             $client_ids = explode(',', $row['client_id']);
    //             $client_names = $this->getClientName($client_ids);
    //             $row['client_data'] = $client_names;
    //             $outArr[] = $row;
    //         }
    //         return $outArr;
    //     }

    public function getAllNews() {
        // Fetch news details where 'is_send' is 0
        $this->db->where('is_send', 0);
        $this->db->order_by('news_details_id');
        $this->db->select('*');
        $this->db->from('news_details');
        $result = $this->db->get()->result_array();
    
        $outArr = array();
        foreach ($result as $row) {
            // Split client_ids and fetch client names
            $client_ids = explode(',', $row['client_id']);
            $client_names = $this->getClientNames($client_ids);
    
            // Add client names to the row
            $row['client_names'] = implode(', ', $client_names);
    
            // Split the 'news_details_id' into an array
            $news_details_ids = explode(',', $row['news_details_id']);
    
            // Get related news articles
            $news_article_data = $this->getNewsArticle($news_details_ids);
    
            // Merge articles with the same news_details_id
            $merged_articles = $this->mergeArticles($news_article_data);
    
            // Add the articles data to the row
            $row['news_article_data'] = $merged_articles;
    
            // Add the modified row to the output array
            $outArr[] = $row;
        }
    
        return $outArr;
    }


    public function getNews($news_details_id){
        // Fetch news details where 'is_send' is 0
        $this->db->where('is_send', 0);
        $this->db->where('news_details_id', $news_details_id);
        $this->db->order_by('news_details_id');
        $this->db->select('*');
        $this->db->from('news_details');
        $result = $this->db->get()->result_array();
    
        $outArr = array();
        foreach ($result as $row) {
            // Split client_ids and fetch client names
            $client_ids = explode(',', $row['client_id']);
            $client_names = $this->getClientNames($client_ids);
    
            // Add client names to the row
            $row['client_names'] = implode(', ', $client_names);
    
            // Split the 'news_details_id' into an array
            $news_details_ids = explode(',', $row['news_details_id']);
    
            // Get related news articles
            $news_article_data = $this->getNewsArticle($news_details_ids);
    
            // Merge articles with the same news_details_id
            $merged_articles = $this->mergeArticles($news_article_data);
    
            // Add the articles data to the row
            $row['news_article_data'] = $merged_articles;
    
            // Add the modified row to the output array
            $outArr[] = $row;
        }
    
        return $outArr;
    }
    
    public function getNewsArticle($news_details_ids) {
        if (!is_array($news_details_ids)) {
            $news_details_ids = array($news_details_ids);
        }
    
        $this->db->where_in('news_details_id', $news_details_ids);
        $this->db->select('*');
        $this->db->from('news_artical as na'); // Corrected table name to 'news_article'
        $this->db->join('artical_images as ai', 'na.artical_images_id = ai.artical_images_id', 'left');
        $query = $this->db->get();
        return $query->result_array(); // Added return statement
    }
    
    private function getClientNames($client_ids) {
        $this->db->where_in('client_id', $client_ids);
        $this->db->select('client_name');
        $this->db->from('client');
        $query = $this->db->get();
        $clients = $query->result_array();
    
        $client_names = array_column($clients, 'client_name');
        return $client_names;
    }

    public function getAllKeywords() {
        // Step 1: Retrieve the client_keywords from the database
        $this->db->select('client_keywords');
        $this->db->from('client');
        $query = $this->db->get();
        $client_keywords = $query->result_array();
    
        // Step 2: Extract all keywords and merge them into a single array
        $all_keywords = array();
        foreach ($client_keywords as $keywords_array) {
            if (isset($keywords_array['client_keywords'])) {
                $keywords = explode(',', $keywords_array['client_keywords']);
                $all_keywords = array_merge($all_keywords, array_map('trim', $keywords));
            }
        }
    
        // Step 3: Remove duplicates from the array
        $all_keywords = array_unique($all_keywords);
    
        // Step 4: Return the cleaned array
        return array_values($all_keywords); // Reset array keys
    }
    
    private function mergeArticles($articles) {
        $merged = [];
    
        foreach ($articles as $article) {
            $id = $article['news_details_id'];
    
            if (!isset($merged[$id])) {
                $merged[$id] = $article;
            } else {
                // Merge client_id
                if (isset($merged[$id]['client_id']) && isset($article['client_id'])) {
                    $merged[$id]['client_id'] = implode(', ', array_unique(array_merge(
                        explode(',', $merged[$id]['client_id']),
                        explode(',', $article['client_id'])
                    )));
                } elseif (isset($article['client_id'])) {
                    $merged[$id]['client_id'] = $article['client_id'];
                }
    
                // Merge keywords
                if (isset($merged[$id]['keywords']) && isset($article['keywords'])) {
                    $merged[$id]['keywords'] = implode(', ', array_unique(array_merge(
                        explode(',', $merged[$id]['keywords']),
                        explode(',', $article['keywords'])
                    )));
                } elseif (isset($article['keywords'])) {
                    $merged[$id]['keywords'] = $article['keywords'];
                }
    
                // Merge client names
                if (isset($merged[$id]['client_names']) && isset($article['client_names'])) {
                    $merged[$id]['client_names'] = implode(', ', array_unique(array_merge(
                        explode(',', $merged[$id]['client_names']),
                        explode(',', $article['client_names'])
                    )));
                } elseif (isset($article['client_names'])) {
                    $merged[$id]['client_names'] = $article['client_names'];
                }
            }
        }
        return array_values($merged);
    }
    
    public function getClients() {
        // $sql="SELECT * FROM `client` WHERE `client_keywords` = $keywordData ; ";
        $sql="SELECT * FROM `client`  ; ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update($table, $colIdName, $id, $data)
    {
        $this->db->where($colIdName, $id);
        $result = $this->db->update($table, $data);
        return $result;
    }

    public function getUserData($user_id){
        $sql="SELECT * FROM `user` WHERE `user_id` = $user_id; ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getCompetitor($client_id){
        $sql = "SELECT * FROM `competitor` as c JOIN `client` as cl ON cl.client_id = c.client_id WHERE c.client_id = ?";
        $query = $this->db->query($sql, array($client_id));
        return $query->result_array();
    }
    
    public function industryData($client_ids) {
        // Ensure $client_ids is an array
        if (!is_array($client_ids)) {
            $client_ids = [$client_ids];
        }
    
        // Build the WHERE clause using LIKE for each client_id
        $conditions = array_map(function($id) {
            return "`client_id` LIKE '%$id%'";
        }, $client_ids);
    
        $whereClause = implode(' OR ', $conditions);
        $sql = "SELECT * FROM `industry` WHERE $whereClause";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getClientIds($client_ids) {
        $industries = $this->industryData($client_ids);
        $clientIds = [];
    
        foreach ($industries as $industry) {
            echo "Processing client_id: " . $industry['client_id'] . "\n";
            
            // Split the client_id by comma if it contains multiple ids
            $ids = explode(',', $industry['client_id']);
            
            // Print the split ids for debugging
            print_r($ids);
            
            // Merge the split ids into the clientIds array
            $clientIds = array_merge($clientIds, $ids);
        }
    
        // Remove duplicates and re-index the array
        $clientIds = array_unique($clientIds);
        $clientIds = array_values($clientIds);
    
        return $clientIds;
    }
    
}
?>