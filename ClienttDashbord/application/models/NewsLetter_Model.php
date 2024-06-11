<?php 
class NewsLetter_Model extends CI_Model
{
  
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

    public function get_data_by_timeframe($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(create_at, '%W') as label, COUNT(*) as count 
                        FROM news_details 
                        WHERE FIND_IN_SET(?, client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
                }
                $sql .= " GROUP BY label 
                          ORDER BY create_at";
                break;

            case 'weekly':
                $sql = "SELECT CONCAT('Week ', WEEK(create_at)) as label, COUNT(*) as count 
                        FROM news_details 
                        WHERE FIND_IN_SET(?, client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                }
                $sql .= " GROUP BY WEEK(create_at) 
                          ORDER BY create_at";
                break;

            case 'monthly':
                $sql = "SELECT DATE_FORMAT(create_at, '%M') as label, COUNT(*) as count 
                        FROM news_details 
                        WHERE FIND_IN_SET(?, client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND YEAR(create_at) = YEAR(CURDATE())";
                }
                $sql .= " GROUP BY MONTH(create_at) 
                          ORDER BY create_at";
                break;

            default:
                return [];
        }

        // Bind parameters
        $params = [$client_id];
        if ($from && $to) {
            $params[] = $from;
            $params[] = $to;
        }

        // Execute the query with bound parameters
        $query = $this->db->query($sql, $params);
        return $query->result_array();
    }

    public function get_journalist_data_by_timeframe($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, nd.journalist_id, j.Journalist
                        FROM news_details as nd
                        JOIN journalist as j ON j.gidJournalist = nd.journalist_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
                }
                $sql .= " GROUP BY label, nd.journalist_id, j.Journalist
                          ORDER BY nd.create_at";
                break;
    
            case 'weekly':
                $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, nd.journalist_id, j.Journalist
                        FROM news_details as nd
                        JOIN journalist as j ON j.gidJournalist = nd.journalist_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                }
                $sql .= " GROUP BY label, nd.journalist_id, j.Journalist
                          ORDER BY nd.create_at";
                break;
    
            case 'monthly':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, nd.journalist_id, j.Journalist
                        FROM news_details as nd
                        JOIN journalist as j ON j.gidJournalist = nd.journalist_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND YEAR(nd.create_at) = YEAR(CURDATE())";
                }
                $sql .= " GROUP BY label, nd.journalist_id, j.Journalist
                          ORDER BY nd.create_at";
                break;
    
            default:
                return [];
        }
    
        // Bind parameters
        $params = [$client_id];
        if ($from && $to) {
            $params[] = $from;
            $params[] = $to;
        }
    
        // Execute the query with bound parameters
        $query = $this->db->query($sql, $params);
        return $query->result_array();
    }


    public function get_geography_data_by_timeframe($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, e.Edition
                        FROM news_details as nd
                        JOIN edition as e ON e.gidEdition = nd.edition_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
                }
                $sql .= " GROUP BY label, e.Edition
                          ORDER BY nd.create_at";
                break;
    
            case 'weekly':
                $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, e.Edition
                        FROM news_details as nd
                        JOIN edition as e ON e.gidEdition = nd.edition_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                }
                $sql .= " GROUP BY label, e.Edition
                          ORDER BY nd.create_at";
                break;
    
            case 'monthly':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, e.Edition
                        FROM news_details as nd
                        JOIN edition as e ON e.gidEdition = nd.edition_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND YEAR(nd.create_at) = YEAR(CURDATE())";
                }
                $sql .= " GROUP BY label, e.Edition
                          ORDER BY nd.create_at";
                break;
    
            default:
                return [];
        }
    
        // Bind parameters
        $params = [$client_id];
        if ($from && $to) {
            $params[] = $from;
            $params[] = $to;
        }
    
        // Execute the query with bound parameters
        $query = $this->db->query($sql, $params);
        return $query->result_array();
    }


    public function get_media_data_by_timeframe($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, md.MediaType
                        FROM news_details as nd
                        JOIN mediatype as md ON md.gidMediaType = nd.media_type_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
                }
                $sql .= " GROUP BY label, md.MediaType
                          ORDER BY nd.create_at";
                break;
    
            case 'weekly':
                $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, md.MediaType
                        FROM news_details as nd
                        JOIN mediatype as md ON md.gidMediaType = nd.media_type_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                }
                $sql .= " GROUP BY label,  md.MediaType
                          ORDER BY nd.create_at";
                break;
    
            case 'monthly':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, md.MediaType
                        FROM news_details as nd
                        JOIN mediatype as md ON md.gidMediaType = nd.media_type_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND YEAR(nd.create_at) = YEAR(CURDATE())";
                }
                $sql .= " GROUP BY label,  md.MediaType
                          ORDER BY nd.create_at";
                break;
    
            default:
                return [];
        }
    
        // Bind parameters
        $params = [$client_id];
        if ($from && $to) {
            $params[] = $from;
            $params[] = $to;
        }
    
        // Execute the query with bound parameters
        $query = $this->db->query($sql, $params);
        return $query->result_array();
    }
    
    public function get_Publication_data_by_timeframe($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, m.MediaOutlet
                        FROM news_details as nd
                        JOIN mediaoutlet as m ON m.gidMediaOutlet = nd.publication_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
                }
                $sql .= " GROUP BY label, m.MediaOutlet
                          ORDER BY nd.create_at";
                break;
    
            case 'weekly':
                $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, m.MediaOutlet
                        FROM news_details as nd
                        JOIN mediaoutlet as m ON m.gidMediaOutlet = nd.publication_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                }
                $sql .= " GROUP BY label, m.MediaOutlet
                          ORDER BY nd.create_at";
                break;
    
            case 'monthly':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, m.MediaOutlet
                        FROM news_details as nd
                        JOIN mediaoutlet as m ON m.gidMediaOutlet = nd.publication_id
                        WHERE FIND_IN_SET(?, nd.client_id) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND YEAR(nd.create_at) = YEAR(CURDATE())";
                }
                $sql .= " GROUP BY label, m.MediaOutlet
                          ORDER BY nd.create_at";
                break;
    
            default:
                return [];
        }
    
        // Bind parameters
        $params = [$client_id];
        if ($from && $to) {
            $params[] = $from;
            $params[] = $to;
        }
    
        // Execute the query with bound parameters
        $query = $this->db->query($sql, $params);
        return $query->result_array();
    }
    
}   
?>