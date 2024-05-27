<?php 
class ManageNewsModel extends CI_Model
{
	
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function getNews($news_details_id) {
        // Fetch news details where 'is_send' is 0 and 'news_details_id' matches the given id
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
    
            // Get related news articles directly using the current news_details_id
            $news_article_data = $this->getNewsArticle([$row['news_details_id']]);
    
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
        $this->db->from('news_artical'); // Ensure the correct table name
        $query = $this->db->get();
        return $query->result_array();
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
    
    private function mergeArticles($articles) {
        $merged = [];
    
        foreach ($articles as $article) {
            $id = $article['news_details_id'];
    
            if (!isset($merged[$id])) {
                // Initialize with the first article for this news_details_id
                $merged[$id] = [
                    'news_details_id' => $id,
                    'articles' => []
                ];
            }
            
            // Append the current article to the list of articles
            $merged[$id]['articles'][] = $article;
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
}
?>