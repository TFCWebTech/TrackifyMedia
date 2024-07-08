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
                $sql = "SELECT DATE_FORMAT(create_at, '%W') as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle
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
                $sql = "SELECT CONCAT('Week ', WEEK(create_at)) as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle
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
                $sql = "SELECT DATE_FORMAT(create_at, '%M') as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle
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
        $result = $query->result_array();
    
        // Calculate total AVE for all news
        $totalAve = 0;
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;

            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
                $totalAve += $ave; // Accumulate total AVE
            }

            // Remove detailed AVE from individual items
            unset($value['media_type_id']);
            unset($value['publication_id']);
            unset($value['sizeofArticle']);
            $value['total_ave'] = $totalAve; // Assign total AVE to each item
        }

        return $result;
    }

    public function get_data_by_timeframe_by_id($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(create_at, '%W') as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle
                        FROM news_details 
                        WHERE FIND_IN_SET(?, company) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
                }
                $sql .= " GROUP BY label 
                          ORDER BY create_at";
                break;
    
            case 'weekly':
                $sql = "SELECT CONCAT('Week ', WEEK(create_at)) as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle
                        FROM news_details 
                        WHERE FIND_IN_SET(?, company) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                }
                $sql .= " GROUP BY WEEK(create_at) 
                          ORDER BY create_at";
                break;
    
            case 'monthly':
                $sql = "SELECT DATE_FORMAT(create_at, '%M') as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle
                        FROM news_details 
                        WHERE FIND_IN_SET(?, company) > 0";
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
        $result = $query->result_array();
    
        // Calculate total AVE for all news
        $totalAve = 0;
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;

            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
                $totalAve += $ave; // Accumulate total AVE
            }

            // Remove detailed AVE from individual items
            unset($value['media_type_id']);
            unset($value['publication_id']);
            unset($value['sizeofArticle']);
            $value['total_ave'] = $totalAve; // Assign total AVE to each item
        }

        return $result;
    }


    public function get_journalist_data_by_timeframe($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, nd.journalist_id, j.Journalist, nd.media_type_id, nd.publication_id, nd.sizeofArticle
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
                $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, nd.journalist_id, j.Journalist, nd.media_type_id, nd.publication_id, nd.sizeofArticle
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
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, nd.journalist_id, j.Journalist, nd.media_type_id, nd.publication_id, nd.sizeofArticle
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
    
        $query = $this->db->query($sql, $params);
        $result = $query->result_array();
    
        // Calculate total AVE for all news
        $totalAve = 0;
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;

            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
                $totalAve += $ave; // Accumulate total AVE
            }

            // Remove detailed AVE from individual items
            unset($value['media_type_id']);
            unset($value['publication_id']);
            unset($value['sizeofArticle']);
            $value['total_ave'] = $totalAve; // Assign total AVE to each item
        }

        return $result;
    }

    public function get_journalist_data_by_timeframe_by_id($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, nd.journalist_id, j.Journalist, nd.media_type_id, nd.publication_id, nd.sizeofArticle
                        FROM news_details as nd
                        JOIN journalist as j ON j.gidJournalist = nd.journalist_id
                        WHERE FIND_IN_SET(?, nd.company) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
                }
                $sql .= " GROUP BY label, nd.journalist_id, j.Journalist
                          ORDER BY nd.create_at";
                break;
    
            case 'weekly':
                $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, nd.journalist_id, j.Journalist, nd.media_type_id, nd.publication_id, nd.sizeofArticle
                        FROM news_details as nd
                        JOIN journalist as j ON j.gidJournalist = nd.journalist_id
                        WHERE FIND_IN_SET(?, nd.company) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                }
                $sql .= " GROUP BY label, nd.journalist_id, j.Journalist
                          ORDER BY nd.create_at";
                break;
    
            case 'monthly':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, nd.journalist_id, j.Journalist, nd.media_type_id, nd.publication_id, nd.sizeofArticle
                        FROM news_details as nd
                        JOIN journalist as j ON j.gidJournalist = nd.journalist_id
                        WHERE FIND_IN_SET(?, nd.company) > 0";
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
    
        $query = $this->db->query($sql, $params);
        $result = $query->result_array();
    
        // Calculate total AVE for all news
        $totalAve = 0;
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;

            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
                $totalAve += $ave; // Accumulate total AVE
            }

            // Remove detailed AVE from individual items
            unset($value['media_type_id']);
            unset($value['publication_id']);
            unset($value['sizeofArticle']);
            $value['total_ave'] = $totalAve; // Assign total AVE to each item
        }

        return $result;
    }


    public function get_geography_data_by_timeframe($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, e.Edition, media_type_id, publication_id, sizeofArticle
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
                $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, e.Edition, media_type_id, publication_id, sizeofArticle
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
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, e.Edition, media_type_id, publication_id, sizeofArticle
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
        $result = $query->result_array();
    
        // Calculate total AVE for all news
        $totalAve = 0;
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;

            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
                $totalAve += $ave; // Accumulate total AVE
            }

            // Remove detailed AVE from individual items
            unset($value['media_type_id']);
            unset($value['publication_id']);
            unset($value['sizeofArticle']);
            $value['total_ave'] = $totalAve; // Assign total AVE to each item
        }

        return $result;
    }

    public function get_geography_data_by_timeframe_by_id($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, e.Edition, media_type_id, publication_id, sizeofArticle
                        FROM news_details as nd
                        JOIN edition as e ON e.gidEdition = nd.edition_id
                        WHERE FIND_IN_SET(?, nd.company) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
                }
                $sql .= " GROUP BY label, e.Edition
                          ORDER BY nd.create_at";
                break;
    
            case 'weekly':
                $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, e.Edition, media_type_id, publication_id, sizeofArticle
                        FROM news_details as nd
                        JOIN edition as e ON e.gidEdition = nd.edition_id
                        WHERE FIND_IN_SET(?, nd.company) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                }
                $sql .= " GROUP BY label, e.Edition
                          ORDER BY nd.create_at";
                break;
    
            case 'monthly':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, e.Edition, media_type_id, publication_id, sizeofArticle
                        FROM news_details as nd
                        JOIN edition as e ON e.gidEdition = nd.edition_id
                        WHERE FIND_IN_SET(?, nd.company) > 0";
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
        $result = $query->result_array();
    
        // Calculate total AVE for all news
        $totalAve = 0;
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;

            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
                $totalAve += $ave; // Accumulate total AVE
            }

            // Remove detailed AVE from individual items
            unset($value['media_type_id']);
            unset($value['publication_id']);
            unset($value['sizeofArticle']);
            $value['total_ave'] = $totalAve; // Assign total AVE to each item
        }

        return $result;
    }


    public function get_media_data_by_timeframe($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, md.MediaType, nd.media_type_id, nd.publication_id, nd.sizeofArticle
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
                $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, md.MediaType, nd.media_type_id, nd.publication_id, nd.sizeofArticle
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
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, md.MediaType, nd.media_type_id, nd.publication_id, nd.sizeofArticle
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
        // $query = $this->db->query($sql, $params);
        // return $query->result_array();
    // Execute the query with bound parameters
    $query = $this->db->query($sql, $params);
    $result = $query->result_array();

    // Calculate total AVE for all news
    foreach ($result as &$value) {
        $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
        $ave = 0;

        if (!empty($rates_data)) {
            $article_size = $value['sizeofArticle'] ?? 0;
            $rate = $rates_data['Rate'];
            $Circulation_Fig = $rates_data['Circulation_Fig'];
            $ave = 3 * $article_size * $rate * $Circulation_Fig;
            $value['total_ave'] = $ave; // Assign AVE to each item
        } else {
            $value['total_ave'] = 0; // No rates data found
        }

        // Remove unnecessary fields from the result
        unset($value['media_type_id']);
        unset($value['publication_id']);
        unset($value['sizeofArticle']);
    }

    return $result;
}

public function get_media_data_by_timeframe_by_id($timeframe, $client_id, $from = null, $to = null) {
    // Base SQL query for each timeframe
    switch ($timeframe) {
        case 'daily':
            $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, md.MediaType, nd.media_type_id, nd.publication_id, nd.sizeofArticle
                    FROM news_details as nd
                    JOIN mediatype as md ON md.gidMediaType = nd.media_type_id
                    WHERE FIND_IN_SET(?, nd.company) > 0";
            if ($from && $to) {
                $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
            } else {
                $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
            }
            $sql .= " GROUP BY label, md.MediaType
                      ORDER BY nd.create_at";
            break;

        case 'weekly':
            $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, md.MediaType, nd.media_type_id, nd.publication_id, nd.sizeofArticle
                    FROM news_details as nd
                    JOIN mediatype as md ON md.gidMediaType = nd.media_type_id
                    WHERE FIND_IN_SET(?, nd.company) > 0";
            if ($from && $to) {
                $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
            } else {
                $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
            }
            $sql .= " GROUP BY label,  md.MediaType
                      ORDER BY nd.create_at";
            break;

        case 'monthly':
            $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, md.MediaType, nd.media_type_id, nd.publication_id, nd.sizeofArticle
                    FROM news_details as nd
                    JOIN mediatype as md ON md.gidMediaType = nd.media_type_id
                    WHERE FIND_IN_SET(?, nd.company) > 0";
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
    // $query = $this->db->query($sql, $params);
    // return $query->result_array();
// Execute the query with bound parameters
$query = $this->db->query($sql, $params);
$result = $query->result_array();

// Calculate total AVE for all news
foreach ($result as &$value) {
    $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
    $ave = 0;

    if (!empty($rates_data)) {
        $article_size = $value['sizeofArticle'] ?? 0;
        $rate = $rates_data['Rate'];
        $Circulation_Fig = $rates_data['Circulation_Fig'];
        $ave = 3 * $article_size * $rate * $Circulation_Fig;
        $value['total_ave'] = $ave; // Assign AVE to each item
    } else {
        $value['total_ave'] = 0; // No rates data found
    }

    // Remove unnecessary fields from the result
    unset($value['media_type_id']);
    unset($value['publication_id']);
    unset($value['sizeofArticle']);
}

return $result;
}
    
    public function get_Publication_data_by_timeframe($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, m.MediaOutlet, nd.media_type_id, nd.publication_id, nd.sizeofArticle
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
                $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, m.MediaOutlet, nd.media_type_id, nd.publication_id, nd.sizeofArticle
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
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, m.MediaOutlet, nd.media_type_id, nd.publication_id, nd.sizeofArticle
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
        // $query = $this->db->query($sql, $params);
        // return $query->result_array();
        $query = $this->db->query($sql, $params);
        $result = $query->result_array();
    
        // Calculate total AVE for all news
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
    
            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
                $value['total_ave'] = $ave; // Assign AVE to each item
            } else {
                $value['total_ave'] = 0; // No rates data found
            }
    
            // Remove unnecessary fields from the result
            unset($value['media_type_id']);
            unset($value['publication_id']);
            unset($value['sizeofArticle']);
        }
    
        return $result;
    }

    public function get_Publication_data_by_timeframe_by_id($timeframe, $client_id, $from = null, $to = null) {
        // Base SQL query for each timeframe
        switch ($timeframe) {
            case 'daily':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%W') as label, COUNT(*) as count, m.MediaOutlet, nd.media_type_id, nd.publication_id, nd.sizeofArticle
                        FROM news_details as nd
                        JOIN mediaoutlet as m ON m.gidMediaOutlet = nd.publication_id
                        WHERE FIND_IN_SET(?, nd.company) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
                }
                $sql .= " GROUP BY label, m.MediaOutlet
                          ORDER BY nd.create_at";
                break;
    
            case 'weekly':
                $sql = "SELECT CONCAT('Week ', WEEK(nd.create_at)) as label, COUNT(*) as count, m.MediaOutlet, nd.media_type_id, nd.publication_id, nd.sizeofArticle
                        FROM news_details as nd
                        JOIN mediaoutlet as m ON m.gidMediaOutlet = nd.publication_id
                        WHERE FIND_IN_SET(?, nd.company) > 0";
                if ($from && $to) {
                    $sql .= " AND DATE(nd.create_at) BETWEEN ? AND ?";
                } else {
                    $sql .= " AND DATE(nd.create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                }
                $sql .= " GROUP BY label, m.MediaOutlet
                          ORDER BY nd.create_at";
                break;
    
            case 'monthly':
                $sql = "SELECT DATE_FORMAT(nd.create_at, '%M') as label, COUNT(*) as count, m.MediaOutlet, nd.media_type_id, nd.publication_id, nd.sizeofArticle
                        FROM news_details as nd
                        JOIN mediaoutlet as m ON m.gidMediaOutlet = nd.publication_id
                        WHERE FIND_IN_SET(?, nd.company) > 0";
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
        // $query = $this->db->query($sql, $params);
        // return $query->result_array();
        $query = $this->db->query($sql, $params);
        $result = $query->result_array();
    
        // Calculate total AVE for all news
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
    
            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
                $value['total_ave'] = $ave; // Assign AVE to each item
            } else {
                $value['total_ave'] = 0; // No rates data found
            }
    
            // Remove unnecessary fields from the result
            unset($value['media_type_id']);
            unset($value['publication_id']);
            unset($value['sizeofArticle']);
        }
    
        return $result;
    }

//pro Analaticis size graph
public function get_size_data($timeframe, $client_id, $from, $to) {
    switch ($timeframe) {
        case 'daily':
            $sql = "SELECT DATE_FORMAT(create_at, '%W') as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle, category
                    FROM news_details
                    WHERE FIND_IN_SET(?, client_id) > 0";
            if ($from && $to) {
                $sql .= " AND DATE(create_at) BETWEEN ? AND ?";
            } else {
                $sql .= " AND DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
            }
            $sql .= " GROUP BY label, category
                      ORDER BY create_at";
            break;

        case 'weekly':
            $sql = "SELECT CONCAT('Week ', WEEK(create_at)) as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle, category
                    FROM news_details
                    WHERE FIND_IN_SET(?, client_id) > 0";
            if ($from && $to) {
                $sql .= " AND DATE(create_at) BETWEEN ? AND ?";
            } else {
                $sql .= " AND DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
            }
            $sql .= " GROUP BY label, category
                      ORDER BY create_at";
            break;

        case 'monthly':
            $sql = "SELECT DATE_FORMAT(create_at, '%M') as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle, category
                    FROM news_details
                    WHERE FIND_IN_SET(?, client_id) > 0";
            if ($from && $to) {
                $sql .= " AND DATE(create_at) BETWEEN ? AND ?";
            } else {
                $sql .= " AND YEAR(create_at) = YEAR(CURDATE())";
            }
            $sql .= " GROUP BY label, category
                      ORDER BY create_at";
            break;

        default:
            return [];
    }

    // Prepare parameters
    $params = [$client_id];
    if ($from && $to) {
        $params[] = $from;
        $params[] = $to;
    }

    // Execute the query with bound parameters
    $query = $this->db->query($sql, $params);
    $result = $query->result_array();

    // Calculate total AVE for all news
    foreach ($result as &$value) {
        $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
        $ave = 0;

        if (!empty($rates_data)) {
            $article_size = $value['sizeofArticle'] ?? 0;
            $rate = $rates_data['Rate'];
            $Circulation_Fig = $rates_data['Circulation_Fig'];
            $ave = 3 * $article_size * $rate * $Circulation_Fig;
            $value['total_ave'] = $ave; // Assign AVE to each item
        } else {
            $value['total_ave'] = 0; // No rates data found
        }

        // Remove unnecessary fields from the result
        unset($value['media_type_id']);
        unset($value['publication_id']);
        unset($value['sizeofArticle']);
    }

    return $result;
}

public function get_size_data_by_id($timeframe, $client_id, $from, $to) {
    switch ($timeframe) {
        case 'daily':
            $sql = "SELECT DATE_FORMAT(create_at, '%W') as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle, category
                    FROM news_details
                    WHERE FIND_IN_SET(?, company) > 0";
            if ($from && $to) {
                $sql .= " AND DATE(create_at) BETWEEN ? AND ?";
            } else {
                $sql .= " AND DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
            }
            $sql .= " GROUP BY label, category
                      ORDER BY create_at";
            break;

        case 'weekly':
            $sql = "SELECT CONCAT('Week ', WEEK(create_at)) as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle, category
                    FROM news_details
                    WHERE FIND_IN_SET(?, company) > 0";
            if ($from && $to) {
                $sql .= " AND DATE(create_at) BETWEEN ? AND ?";
            } else {
                $sql .= " AND DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
            }
            $sql .= " GROUP BY label, category
                      ORDER BY create_at";
            break;

        case 'monthly':
            $sql = "SELECT DATE_FORMAT(create_at, '%M') as label, COUNT(*) as count, media_type_id, publication_id, sizeofArticle, category
                    FROM news_details
                    WHERE FIND_IN_SET(?, company) > 0";
            if ($from && $to) {
                $sql .= " AND DATE(create_at) BETWEEN ? AND ?";
            } else {
                $sql .= " AND YEAR(create_at) = YEAR(CURDATE())";
            }
            $sql .= " GROUP BY label, category
                      ORDER BY create_at";
            break;

        default:
            return [];
    }

    // Prepare parameters
    $params = [$client_id];
    if ($from && $to) {
        $params[] = $from;
        $params[] = $to;
    }

    // Execute the query with bound parameters
    $query = $this->db->query($sql, $params);
    $result = $query->result_array();

    // Calculate total AVE for all news
    foreach ($result as &$value) {
        $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
        $ave = 0;

        if (!empty($rates_data)) {
            $article_size = $value['sizeofArticle'] ?? 0;
            $rate = $rates_data['Rate'];
            $Circulation_Fig = $rates_data['Circulation_Fig'];
            $ave = 3 * $article_size * $rate * $Circulation_Fig;
            $value['total_ave'] = $ave; // Assign AVE to each item
        } else {
            $value['total_ave'] = 0; // No rates data found
        }

        // Remove unnecessary fields from the result
        unset($value['media_type_id']);
        unset($value['publication_id']);
        unset($value['sizeofArticle']);
    }

    return $result;
}

    // function getClientNewsCount($timeframe, $client_id, $from = null, $to = null) {
    //     $this->db->select('*');
    //     $this->db->from('news_details');
    
    //     if ($from !== null && $to !== null) {
    //         $this->db->where('create_at >=', $from);
    //         $this->db->where('create_at <=', $to);
    //     }
    
    //     $this->db->group_start();
    //     $this->db->where("FIND_IN_SET('$client_id', company)", NULL, FALSE);
    //     $this->db->group_end();
    //     $result = $this->db->get()->result_array();
    //     $total_ave = 0;
    //     $news_count = 0;
    //     foreach ($result as $value) {
    //         $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
    //         $ave = 0;
    //         if (!empty($rates_data)) {
    //             $article_size = $value['sizeofArticle'] != null ? $value['sizeofArticle'] : 0;
    //             $rate = $rates_data['Rate'];
    //             $Circulation_Fig = $rates_data['Circulation_Fig'];
    //             $ave = 3 * $article_size * $rate * $Circulation_Fig;
    //         }
            
    //         $total_ave += $ave;
    //         $news_count++;
    //     }
    
    //     return array(
    //         'news_count' => $news_count,
    //         'total_ave' => $total_ave
    //     );
    // }
    function getClientNewsCount($timeframe, $client_id, $from = null, $to = null) {
        $this->db->select('*');
        $this->db->from('news_details');
        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }
        $this->db->group_start();
        $this->db->where("FIND_IN_SET('$client_id', company)", NULL, FALSE);
        $this->db->group_end();
        $result = $this->db->get()->result_array();
        $total_ave = 0;
        $news_count = 0;
        foreach ($result as $value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] != null ? $value['sizeofArticle'] : 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
            }
            $total_ave += $ave;
            $news_count++;
        }
    
        return array(
            'news_count' => $news_count,
            'total_ave' => $total_ave
        );
    }
    public function getCompData($timeframe, $client_id, $from = null, $to = null, $gidMediaType = null)
    {
        $this->db->select('*');
        $this->db->from('competitor');
        $this->db->where('client_id', $client_id);
        $result = $this->db->get()->result_array();
        $outArr = array();
        foreach ($result as $row){
            $news_count = $this->getCompNewsByKey($row['Keywords'], $client_id, $from, $to, $gidMediaType);
            $outArr[] = array(
                'label' => $row['Competitor_name'],
                'count' => $news_count
            );
        }
        return $outArr;
    }

    public function getCompNewsByKey($Keywords, $client_id, $from = null, $to = null, $gidMediaType)
    {
        
        $this->db->select('*');
        $this->db->from('news_details');

        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }

        if($gidMediaType !== null) {
            $this->db->where('media_type_id', $gidMediaType);
        }

        $this->db->group_start();
        $this->db->where("NOT FIND_IN_SET('$client_id', company)", NULL, FALSE);
        $this->db->group_end();
        
        $this->db->group_start();
        foreach (explode(',', $Keywords) as $keyword) {
            $keyword = trim($keyword); // Trim any whitespace around keywords
            $this->db->or_where("FIND_IN_SET('$keyword', keywords) >", 0);
        }
        $this->db->group_end();
        return $this->db->count_all_results();
        // $query = $this->db->get();
        // $result = $query->result_array(); 
        // return $result; 
    }


    public function getCompDataM($timeframe, $client_id, $from = null, $to = null, $gidMediaType = null)
{
    $this->db->select('*');
    $this->db->from('competitor');
    $this->db->where('client_id', $client_id);
    $result = $this->db->get()->result_array();
    $outArr = array();
    foreach ($result as $row) {
        $news_data = $this->getCompNewsByKeyM($row['Keywords'], $client_id, $from, $to, $gidMediaType);
        $totalAve = array_reduce($news_data, function($carry, $item) {
            return $carry + ($item['ave'] ?? 0);
        }, 0);

        $outArr[] = array(
            'label' => $row['Competitor_name'],
            'Count' => count($news_data), // News count
            'ave' => $totalAve, // Total ave value
        );
    }
    return $outArr;
}

public function getCompNewsByKeyM($Keywords, $client_id, $from = null, $to = null, $gidMediaType = null)
{
    $this->db->select('*');
    $this->db->from('news_details');

    if ($from !== null && $to !== null) {
        $this->db->where('create_at >=', $from);
        $this->db->where('create_at <=', $to);
    }

    if ($gidMediaType !== null) {
        $this->db->where('media_type_id', $gidMediaType);
    }

    $this->db->group_start();
    $this->db->where("NOT FIND_IN_SET('$client_id', company)", NULL, FALSE);
    $this->db->group_end();

    $this->db->group_start();
    foreach (explode(',', $Keywords) as $keyword) {
        $keyword = trim($keyword); // Trim any whitespace around keywords
        $this->db->or_where("FIND_IN_SET('$keyword', keywords) >", 0);
    }
    $this->db->group_end();

    $result = $this->db->get()->result_array();
    foreach ($result as &$value) {
        $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
        $ave = 0;

        if (!empty($rates_data)) {
            $article_size = $value['sizeofArticle'] ?? 0;
            $rate = $rates_data['Rate'];
            $Circulation_Fig = $rates_data['Circulation_Fig'];
            $ave = 3 * $article_size * $rate * $Circulation_Fig;
        }
        $value['ave'] = $ave;
    }
    return $result;
}

   public function getMediaData($timeframe, $client_id, $from = null, $to = null)
    {
        $this->db->select('*');
        $this->db->from('mediatype');
        $result = $this->db->get()->result_array();
        $outArr = array();
        
        foreach ($result as $row) {
            $news_data = $this->getNewsDetails($row['gidMediaType'], $client_id, $from, $to);
        
            // Sum up the 'ave' values from news_data
            $totalAve = array_reduce($news_data, function($carry, $item) {
                return $carry + ($item['ave'] ?? 0);
            }, 0);
            
            $outArr[] = array(
                'Media_name' => $row['MediaType'],
                'Count' => count($news_data), // News count
                'ave' => $totalAve, // Total ave value
                'Client_name' => $this->session->userdata('client_name')
            );

            $comp_data = $this->getCompDataM('daily', $client_id, $from, $to, $row['gidMediaType']);
            foreach ($comp_data as $key => $value) {
                $outArr[] = array(
                    'Media_name' => $row['MediaType'],
                    'Count' => $value['Count'], // Use 'Count' instead of 'count'
                    'ave' => $value['ave'] ?? 0, // Ensure 'ave' index exists
                    'Client_name' => $value['label']
                );
            }
        }

        $groupedData = array();

        foreach ($outArr as $record) {
            $mediaName = $record['Media_name'];
            if (!isset($groupedData[$mediaName])) {
                $groupedData[$mediaName] = array();
            }
            $groupedData[$mediaName][] = $record;
        }

        return $groupedData;
    }
    
    public function getNewsDetails($gidMediaType, $client_id, $from = null, $to = null) {
        $this->db->select('*');
        $this->db->from('news_details');
        $this->db->where('media_type_id', $gidMediaType); 
        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }
    
        $this->db->group_start();
        $this->db->where("FIND_IN_SET('$client_id', company)", NULL, FALSE);
        $this->db->group_end();
    
        $result = $this->db->get()->result_array();
        
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
    
            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
            }
            $value['ave'] = $ave;
        }
        return $result;
        
    }

    public function getPublicationData($timeframe, $client_id, $from = null, $to = null) {
        $this->db->select('*');
        $this->db->from('mediaoutlet');
        $result = $this->db->get()->result_array();
        $outArr = array();
    
        foreach ($result as $row) {
            $news_data = $this->getNewsDetails2($row['gidMediaOutlet'], $client_id, $from, $to);
            
            $totalAve = array_reduce($news_data, function($carry, $item) {
                return $carry + ($item['ave'] ?? 0);
            }, 0);
    
            $outArr[] = array(
                'Publication_name' => $row['MediaOutlet'],
                'Count' => count($news_data),
                'ave' => $totalAve,
                'Client_name' => $this->session->userdata('client_name')
            );
    
            $comp_data = $this->getCompData2('daily', $client_id, $from, $to, $row['gidMediaOutlet']);
            foreach ($comp_data as $value) {
                $outArr[] = array(
                    'Publication_name' => $row['MediaOutlet'],
                    'Count' => $value['Count'],
                    'ave' => $value['ave'] ?? 0,
                    'Client_name' => $value['label']
                );
            }
        }
        
        usort($outArr, function ($a, $b) {
            return $b['Count'] - $a['Count'];
        });
    
        $outArr = array_slice($outArr, 0, 5);
    
        $groupedData = array();
        foreach ($outArr as $record) {
            $PublicationName = $record['Publication_name'];
            if (!isset($groupedData[$PublicationName])) {
                $groupedData[$PublicationName] = array();
            }
            $groupedData[$PublicationName][] = $record;
        }
        return $groupedData;
    }
    
    public function getNewsDetails2($gidMediaOutlet, $client_id, $from = null, $to = null) {
        $this->db->select('*');
        $this->db->from('news_details');
        $this->db->where('publication_id', $gidMediaOutlet); 
        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }
    
        $this->db->group_start();
        $this->db->where("FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();
    
        $result = $this->db->get()->result_array();
        
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
    
            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
            }
            $value['ave'] = $ave;
        }
        return $result;
    }
    
    public function getCompData2($timeframe, $client_id, $from = null, $to = null, $gidMediaOutlet = null) {
        $this->db->select('*');
        $this->db->from('competitor');
        $this->db->where('client_id', $client_id);
        $result = $this->db->get()->result_array();
        $outArr = array();
    
        foreach ($result as $row) {
            $news_data = $this->getCompNewsByKey2($row['Keywords'], $client_id, $from, $to, $gidMediaOutlet);
            $totalAve = array_reduce($news_data, function($carry, $item) {
                return $carry + ($item['ave'] ?? 0);
            }, 0);
    
            $outArr[] = array(
                'label' => $row['Competitor_name'],
                'Count' => count($news_data),
                'ave' => $totalAve,
            );
        }
        return $outArr;
    }
    
    public function getCompNewsByKey2($Keywords, $client_id, $from = null, $to = null, $gidMediaOutlet) {
        $this->db->select('*');
        $this->db->from('news_details');
    
        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }
        if ($gidMediaOutlet !== null) {
            $this->db->where('publication_id', $gidMediaOutlet);
        }
    
        $this->db->group_start();
        $this->db->where("NOT FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();
        
        $this->db->group_start();
        foreach (explode(',', $Keywords) as $keyword) {
            $keyword = trim($keyword);
            $this->db->or_where("FIND_IN_SET('$keyword', keywords) >", 0);
        }
        $this->db->group_end();
    
        $result = $this->db->get()->result_array();
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
    
            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
            }
            $value['ave'] = $ave;
        }
        return $result;
    }

    public function getGeographyData($timeframe, $client_id, $from = null, $to = null) {
        $this->db->select('*');
        $this->db->from('edition');
        $result = $this->db->get()->result_array();
        $outArr = array();
    
        foreach ($result as $row) {
            $news_data = $this->getNewsDetails3($row['gidEdition'], $client_id, $from, $to);
            
            // Sum up the 'ave' values from news_data
            $totalAve = array_reduce($news_data, function($carry, $item) {
                return $carry + ($item['ave'] ?? 0);
            }, 0);
            
            $outArr[] = array(
                'Edition_name' => $row['Edition'],
                'Count' => count($news_data), // News count
                'ave' => $totalAve, // Total ave value
                'Client_name' => $this->session->userdata('client_name')
            );
    
            $comp_data = $this->getCompData3('daily', $client_id, $from, $to, $row['gidEdition']);
            foreach ($comp_data as $key => $value) {
                $outArr[] = array(
                    'Edition_name' => $row['Edition'],
                    'Count' => $value['Count'], // Use 'Count' instead of 'count'
                    'ave' => $value['ave'] ?? 0, // Ensure 'ave' index exists
                    'Client_name' => $value['label']
                );
            }
        }
    
        // Sort the array by Count in descending order
        usort($outArr, function ($a, $b) {
            return $b['Count'] - $a['Count'];
        });
    
        // Get only the top 5 records
        $outArr = array_slice($outArr, 0, 5);
    
        $groupedData = array();
        foreach ($outArr as $record) {
            $EditioName = $record['Edition_name'];
            if (!isset($groupedData[$EditioName])) {
                $groupedData[$EditioName] = array();
            }
            $groupedData[$EditioName][] = $record;
        }
        return $groupedData;
    }
    
    public function getNewsDetails3($gidEdition, $client_id, $from = null, $to = null) {
        $this->db->select('*');
        $this->db->from('news_details');
        $this->db->where('edition_id', $gidEdition); 
        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }
    
        $this->db->group_start();
        $this->db->where("FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();
    
        $result = $this->db->get()->result_array();
        
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
    
            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
            }
            $value['ave'] = $ave;
        }
        return $result;
    }
    
    public function getCompData3($timeframe, $client_id, $from = null, $to = null, $gidEdition = null) {
        $this->db->select('*');
        $this->db->from('competitor');
        $this->db->where('client_id', $client_id);
        $result = $this->db->get()->result_array();
        $outArr = array();
    
        foreach ($result as $row) {
            $news_data = $this->getCompNewsByKey3($row['Keywords'], $client_id, $from, $to, $gidEdition);
            $totalAve = array_reduce($news_data, function($carry, $item) {
                return $carry + ($item['ave'] ?? 0);
            }, 0);
    
            $outArr[] = array(
                'label' => $row['Competitor_name'],
                'Count' => count($news_data), // News count
                'ave' => $totalAve, // Total ave value
            );
        }
        return $outArr;
    }
    
    public function getCompNewsByKey3($Keywords, $client_id, $from = null, $to = null, $gidEdition) {
        $this->db->select('*');
        $this->db->from('news_details');
    
        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }
        if ($gidEdition !== null) {
            $this->db->where('edition_id', $gidEdition);
        }
    
        $this->db->group_start();
        $this->db->where("NOT FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();
    
        $this->db->group_start();
        foreach (explode(',', $Keywords) as $keyword) {
            $keyword = trim($keyword); // Trim any whitespace around keywords
            $this->db->or_where("FIND_IN_SET('$keyword', keywords) >", 0);
        }
        $this->db->group_end();
    
        $result = $this->db->get()->result_array();
    
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
    
            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
            }
            $value['ave'] = $ave;
        }
        return $result;
    }

    public function getJoutnalistData($timeframe, $client_id, $from = null, $to = null) {
        $this->db->select('*');
        $this->db->from('journalist');
        $result = $this->db->get()->result_array();
        $outArr = array();
    
        foreach ($result as $row) {
            $news_data = $this->getNewsDetails4($row['gidJournalist'], $client_id, $from, $to);
            $totalAve = array_reduce($news_data, function($carry, $item) {
                return $carry + ($item['ave'] ?? 0);
            }, 0);
            $outArr[] = array(
                'Journalist_name' => $row['Journalist'],
                'Count' => count($news_data), // News count
                'ave' => $totalAve, // Total ave value
                'Client_name' => $this->session->userdata('client_name')
            );
    
            $comp_data = $this->getCompData4('daily', $client_id, $from, $to, $row['gidJournalist']);
            foreach ($comp_data as $key => $value) {
                $outArr[] = array(
                    'Journalist_name' => $row['Journalist'],
                    'Count' => $value['Count'], // Use 'Count' instead of 'count'
                    'ave' => $value['ave'] ?? 0, // Ensure 'ave' index exists
                    'Client_name' => $value['label']
                );
            }
        }
    
        // Get only the top 5 records
        $outArr = array_slice($outArr, 0, 5);
    
        $groupedData = array();
        foreach ($outArr as $record) {
            $JournalistName = $record['Journalist_name'];
            if (!isset($groupedData[$JournalistName])) {
                $groupedData[$JournalistName] = array();
            }
            $groupedData[$JournalistName][] = $record;
        }
        return $groupedData;
    }
    
    public function getNewsDetails4($gidJournalist, $client_id, $from = null, $to = null) {
        $this->db->select('*');
        $this->db->from('news_details');
        $this->db->where('journalist_id', $gidJournalist);
        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }
    
        $this->db->group_start();
        $this->db->where("FIND_IN_SET('$client_id', company)", NULL, FALSE);
        $this->db->group_end();
    
        $result = $this->db->get()->result_array();
            
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
    
            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
            }
            $value['ave'] = $ave;
        }
        return $result;
    }
    
    public function getCompData4($timeframe, $client_id, $from = null, $to = null, $gidJournalist = null) {
        $this->db->select('*');
        $this->db->from('competitor');
        $this->db->where('client_id', $client_id);
        $result = $this->db->get()->result_array();
        $outArr = array();
        foreach ($result as $row) {
            $news_data = $this->getCompNewsByKey4($row['Keywords'], $client_id, $from, $to, $gidJournalist);
            $totalAve = array_reduce($news_data, function($carry, $item) {
                return $carry + ($item['ave'] ?? 0);
            }, 0);
            $outArr[] = array(
                'label' => $row['Competitor_name'],
                'Count' => count($news_data), // News count
                'ave' => $totalAve, // Total ave value
            );
        }
        return $outArr;
    }
    
    public function getCompNewsByKey4($Keywords, $client_id, $from = null, $to = null, $gidJournalist) {
        $this->db->select('*');
        $this->db->from('news_details');
        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }
        if($gidJournalist !== null) {
            $this->db->where('journalist_id', $gidJournalist);
        }
    
        $this->db->group_start();
        $this->db->where("NOT FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();
    
        $this->db->group_start();
        foreach (explode(',', $Keywords) as $keyword) {
            $keyword = trim($keyword); // Trim any whitespace around keywords
            $this->db->or_where("FIND_IN_SET('$keyword', keywords) >", 0);
        }
        $this->db->group_end();
        
        $result = $this->db->get()->result_array();
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
    
            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
            }
            $value['ave'] = $ave;
        }
        return $result;
    }

    public function get_quantity_compare_data_by_timeframe($timeframe, $client_id, $from = null, $to = null) {
        // Ensure the $client_id is properly escaped
        if (!is_array($client_id)) {
            $client_id = array($client_id);
        }
    
        $client_ids = implode(',', array_map('intval', $client_id));
        
        $this->db->select('com.Competitor_name, c.client_name ,COUNT(nd.news_details_id) as news_count');
        $this->db->from('news_details as nd');
        $this->db->join('competitor as com', 'com.client_id = nd.client_id', 'left');
        $this->db->join('client as c', 'c.client_id = nd.client_id', 'left');
        // Add condition for client_id
        $this->db->where("FIND_IN_SET(nd.client_id, '{$client_ids}') > 0");
        
        // Optionally add date filtering if $from and $to are provided
        if ($from !== null && $to !== null) {
            $this->db->where('nd.create_at >=', $from);
            $this->db->where('nd.create_at <=', $to);
        }
    
        // Group by competitor name to count the news entries per competitor
        $this->db->group_by('com.Competitor_name');
        
        $query = $this->db->get();
        return $query->result_array(); 
    }
    

    public function getAVEData($timeframe, $client_id, $from = null, $to = null){
        $outArr = array();
        $comp_data = $this->getCompititersWithAVE($client_id, $from, $to);
        $client_data = $this->getClientAVE($client_id, $from, $to);
        $comp_data[] = [
            'label' => $this->session->userdata('client_name'),
                'count' => $client_data[0]['news_count'],
                'ave' => $client_data[0]['total_ave']
            ];

        return $comp_data;
    }

    public function getCompititersWithAVE($client_id, $from = null, $to = null)
    {
        $this->db->select('*');
        $this->db->from('competitor');
        $this->db->where('client_id', $client_id);
        $result = $this->db->get()->result_array();
        $outArr = array();

        foreach ($result as $row){
            $news_count = $this->getAVEofClient($row['Keywords'], $client_id, $from, $to);
            $outArr[] = [
                'label' => $row['Competitor_name'],
                'count' => $news_count[0]['news_count'],
                'ave' => $news_count[0]['total_ave']
            ];
        }
        return $outArr;
    }

    public function getAVEofClient($Keywords, $client_id, $from = null, $to = null)
    {
        
        $this->db->select('*');
        $this->db->from('news_details');

        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }

        $this->db->group_start();
        $this->db->where("NOT FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();
        
        $this->db->group_start();
        foreach (explode(',', $Keywords) as $keyword) {
            $keyword = trim($keyword); // Trim any whitespace around keywords
            $this->db->or_where("FIND_IN_SET('$keyword', keywords) >", 0);
        }
        $this->db->group_end();
        // return $this->db->count_all_results();
        $result = $this->db->get()->result_array();

        $total_ave = 0;
        $news_count = 0;
        foreach ($result as $key => $value) {
            // echo $value['news_details_id'].'/'.$client_id.'<br>';

            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
            $news_count++;
            if (!empty($rates_data)) {
                $artical_size = 0;
                if ($value['sizeofArticle'] != null) {
                    $artical_size = $value['sizeofArticle'];
                }
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3*$artical_size*$rate*$Circulation_Fig;
            }
            
            $total_ave += $ave;
        }

        // echo $total_ave.' Total AVE'.'<br>';
        // echo $news_count.' Total Count'.'<br>';

        $outArr = array();
        $outArr[] = array(
            'news_count' => $news_count,
            'total_ave' => $total_ave
        );

        return $outArr;
        // $query = $this->db->get();
        // $result = $query->result_array(); 
        // return $result; 
    }

    public function getRates($gidMediaType, $gidMediaOutlet)
    {
        $this->db->select('Rate, Circulation_Fig');
        $this->db->from('AddRate');
        $this->db->where('gidMediaType', $gidMediaType);
        // $this->db->where('gidMediaOutlet', $gidMediaOutlet);
        return $this->db->get()->row_array();
    }

    function getClientAVE($client_id, $from = null, $to = null) {
        // WHERE FIND_IN_SET(?, client_id) > 0
        $this->db->select('*');
        $this->db->from('news_details');

        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }

        $this->db->group_start();
        $this->db->where("FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();
        
        $result = $this->db->get()->result_array();

        $total_ave = 0;
        $news_count = 0;
        foreach ($result as $key => $value) {
            // echo $value['news_details_id'].'/'.$client_id.'<br>';

            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
            $news_count++;
            if (!empty($rates_data)) {
                $artical_size = 0;
                if ($value['sizeofArticle'] != null) {
                    $artical_size = $value['sizeofArticle'];
                }
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3*$artical_size*$rate*$Circulation_Fig;
            }
            
            $total_ave += $ave;
        }

        // echo $total_ave.' Total AVE'.'<br>';
        // echo $news_count.' Total Count'.'<br>';

        $outArr = array();
        $outArr[] = array(
            'news_count' => $news_count,
            'total_ave' => $total_ave
        );
        return $outArr;
    }

    public function getSizeDataComp($timeframe, $client_id, $from = null, $to = null) {
        $outArr = array();
    
        // Get competitor data
        $comp_data = $this->getCompititersWithSize($client_id, $from, $to);
    
        // Get client data
        $client_data = $this->getClientSize($client_id, $from, $to);
    
        // Loop through client data and prepare output array
        foreach ($client_data as $value) {
            $outArr[] = [
                'label' => $this->session->userdata('client_name'),
                'count' => $value['count'],
                'category' => $value['category'],
                'ave' => $value['ave'],
            ];
        }
    
        // Merge client data with competitor data
        $final_array = array_merge($outArr, $comp_data);
    
        return $final_array;
    }
    
    public function getClientSize($client_id, $from = null, $to = null) {
        // Select required fields for AVE calculation
        $this->db->select('*');
        $this->db->from('news_details');
    
        // Apply date range filters if provided
        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }
    
        // Filter by client_id using FIND_IN_SET
        $this->db->group_start();
        $this->db->where("FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();
    
        // Group results by category
        $this->db->group_by('category');
    
        // Execute the query and fetch results as an array
        // $result = $this->db->get()->result_array();
        $result = $this->db->get()->result_array();
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;
    
            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
            }
            $value['ave'] = $ave;
        }
        return $result;
    }

    public function getCompititersWithSize($client_id, $from = null, $to = null)
    {
        $this->db->select('*');
        $this->db->from('competitor');
        $this->db->where('client_id', $client_id);
        $result = $this->db->get()->result_array();
        $outArr = array();

        foreach ($result as $row){
            $news_data = $this->getSizeofClient($row['Keywords'], $client_id, $from, $to);
            $totalAve = array_reduce($news_data, function($carry, $item) {
                return $carry + ($item['ave'] ?? 0);
            }, 0);
            foreach ($news_data as $key => $value) {
                $outArr[] = [
                    'label' => $row['Competitor_name'],
                    'category' => $value['category'],
                    'Count' => count($news_data), // News count
                    'ave' => $totalAve, // Total ave value
                ];
            }
            
        }
        return $outArr;
    }

    public function getSizeofClient($Keywords, $client_id, $from = null, $to = null)
    {
        
        $this->db->select('*');
        $this->db->from('news_details');

        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }

        $this->db->group_start();
        $this->db->where("NOT FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();
        
        $this->db->group_start();
        foreach (explode(',', $Keywords) as $keyword) {
            $keyword = trim($keyword); // Trim any whitespace around keywords
            $this->db->or_where("FIND_IN_SET('$keyword', keywords) >", 0);
        }
        $this->db->group_end();
        // return $this->db->count_all_results();
        $this->db->group_by('category');
        $result = $this->db->get()->result_array();
        // return $result;
        // $result = $this->db->get()->result_array();
        foreach ($result as &$value) {
            $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
            $ave = 0;

            if (!empty($rates_data)) {
                $article_size = $value['sizeofArticle'] ?? 0;
                $rate = $rates_data['Rate'];
                $Circulation_Fig = $rates_data['Circulation_Fig'];
                $ave = 3 * $article_size * $rate * $Circulation_Fig;
            }
            $value['ave'] = $ave;
        }
        return $result;
    }

    public function getClientName($client_id){
        $this->db->select('client_name');
        $this->db->from('client');
        $this->db->where('client_id', $client_id);
        return $this->db->get()->result_array(); 
    }

    //created for specific record 

    public function getMediaDataByID($timeframe, $client_id, $from = null, $to = null)
{
    $this->db->select('*');
    $this->db->from('mediatype');
    $result = $this->db->get()->result_array();
    $outArr = array();
    
    // Fetch client name
    $client_name = $this->getClientNameByID($client_id);

    foreach ($result as $row) {
        $news_data = $this->getNewsDetailsByID($row['gidMediaType'], $client_id, $from, $to);
    
        // Sum up the 'ave' values from news_data
        $totalAve = array_reduce($news_data, function($carry, $item) {
            return $carry + ($item['ave'] ?? 0);
        }, 0);
        
        $outArr[] = array(
            'Media_name' => $row['MediaType'],
            'Count' => count($news_data), // News count
            'ave' => $totalAve, // Total ave value
            'Client_name' => $client_name // Add client name
        );

        $comp_data = $this->getCompDataM('daily', $client_id, $from, $to, $row['gidMediaType']);
        foreach ($comp_data as $key => $value) {
            $outArr[] = array(
                'Media_name' => $row['MediaType'],
                'Count' => $value['Count'], // Use 'Count' instead of 'count'
                'ave' => $value['ave'] ?? 0, // Ensure 'ave' index exists
                'Client_name' => $value['label']
            );
        }
    }

    $groupedData = array();

    foreach ($outArr as $record) {
        $mediaName = $record['Media_name'];
        if (!isset($groupedData[$mediaName])) {
            $groupedData[$mediaName] = array();
        }
        $groupedData[$mediaName][] = $record;
    }

    return $groupedData;
}

public function getNewsDetailsByID($gidMediaType, $client_id, $from = null, $to = null) {
    $this->db->select('*');
    $this->db->from('news_details');
    $this->db->where('media_type_id', $gidMediaType); 
    if ($from !== null && $to !== null) {
        $this->db->where('create_at >=', $from);
        $this->db->where('create_at <=', $to);
    }

    $this->db->group_start();
    $this->db->where("FIND_IN_SET('$client_id', company)", NULL, FALSE);
    $this->db->group_end();

    $result = $this->db->get()->result_array();
    
    foreach ($result as &$value) {
        $rates_data = $this->getRates($value['media_type_id'], $value['publication_id']);
        $ave = 0;

        if (!empty($rates_data)) {
            $article_size = $value['sizeofArticle'] ?? 0;
            $rate = $rates_data['Rate'];
            $Circulation_Fig = $rates_data['Circulation_Fig'];
            $ave = 3 * $article_size * $rate * $Circulation_Fig;
        }
        $value['ave'] = $ave;
    }
    return $result;
}

//for publication
public function getPublicationDataByID($timeframe, $client_id, $from = null, $to = null) {
    $this->db->select('*');
    $this->db->from('mediaoutlet');
    $result = $this->db->get()->result_array();
    $outArr = array();

    $client_name = $this->getClientNameByID($client_id);
    foreach ($result as $row) {
        $news_data = $this->getNewsDetails2($row['gidMediaOutlet'], $client_id, $from, $to);
        
        $totalAve = array_reduce($news_data, function($carry, $item) {
            return $carry + ($item['ave'] ?? 0);
        }, 0);

        $outArr[] = array(
            'Publication_name' => $row['MediaOutlet'],
            'Count' => count($news_data),
            'ave' => $totalAve,
            'Client_name' => $client_name // Add client name
        );

        $comp_data = $this->getCompData2('daily', $client_id, $from, $to, $row['gidMediaOutlet']);
        foreach ($comp_data as $value) {
            $outArr[] = array(
                'Publication_name' => $row['MediaOutlet'],
                'Count' => $value['Count'],
                'ave' => $value['ave'] ?? 0,
                'Client_name' => $value['label']
            );
        }
    }
    
    usort($outArr, function ($a, $b) {
        return $b['Count'] - $a['Count'];
    });

    $outArr = array_slice($outArr, 0, 5);

    $groupedData = array();
    foreach ($outArr as $record) {
        $PublicationName = $record['Publication_name'];
        if (!isset($groupedData[$PublicationName])) {
            $groupedData[$PublicationName] = array();
        }
        $groupedData[$PublicationName][] = $record;
    }
    return $groupedData;
}


//for geograpy
public function getGeographyDataByID($timeframe, $client_id, $from = null, $to = null) {
    $this->db->select('*');
    $this->db->from('edition');
    $result = $this->db->get()->result_array();
    $outArr = array();
    $client_name = $this->getClientNameByID($client_id);
    foreach ($result as $row) {
        $news_data = $this->getNewsDetails3($row['gidEdition'], $client_id, $from, $to);
        
        // Sum up the 'ave' values from news_data
        $totalAve = array_reduce($news_data, function($carry, $item) {
            return $carry + ($item['ave'] ?? 0);
        }, 0);
        
        $outArr[] = array(
            'Edition_name' => $row['Edition'],
            'Count' => count($news_data), // News count
            'ave' => $totalAve, // Total ave value
            'Client_name' => $client_name // Add client name
        );

        $comp_data = $this->getCompData3('daily', $client_id, $from, $to, $row['gidEdition']);
        foreach ($comp_data as $key => $value) {
            $outArr[] = array(
                'Edition_name' => $row['Edition'],
                'Count' => $value['Count'], // Use 'Count' instead of 'count'
                'ave' => $value['ave'] ?? 0, // Ensure 'ave' index exists
                'Client_name' => $value['label']
            );
        }
    }

    // Sort the array by Count in descending order
    usort($outArr, function ($a, $b) {
        return $b['Count'] - $a['Count'];
    });

    // Get only the top 5 records
    $outArr = array_slice($outArr, 0, 5);

    $groupedData = array();
    foreach ($outArr as $record) {
        $EditioName = $record['Edition_name'];
        if (!isset($groupedData[$EditioName])) {
            $groupedData[$EditioName] = array();
        }
        $groupedData[$EditioName][] = $record;
    }
    return $groupedData;
}


//for Journalist
public function getJoutnalistDataByID($timeframe, $client_id, $from = null, $to = null) {
    $this->db->select('*');
    $this->db->from('journalist');
    $result = $this->db->get()->result_array();
    $outArr = array();
    $client_name = $this->getClientNameByID($client_id);
    foreach ($result as $row) {
        $news_data = $this->getNewsDetails4($row['gidJournalist'], $client_id, $from, $to);
        $totalAve = array_reduce($news_data, function($carry, $item) {
            return $carry + ($item['ave'] ?? 0);
        }, 0);
        $outArr[] = array(
            'Journalist_name' => $row['Journalist'],
            'Count' => count($news_data), // News count
            'ave' => $totalAve, // Total ave value
            'Client_name' => $client_name // Add client name
        );

        $comp_data = $this->getCompData4('daily', $client_id, $from, $to, $row['gidJournalist']);
        foreach ($comp_data as $key => $value) {
            $outArr[] = array(
                'Journalist_name' => $row['Journalist'],
                'Count' => $value['Count'], // Use 'Count' instead of 'count'
                'ave' => $value['ave'] ?? 0, // Ensure 'ave' index exists
                'Client_name' => $value['label']
            );
        }
    }

    // Get only the top 5 records
    $outArr = array_slice($outArr, 0, 5);

    $groupedData = array();
    foreach ($outArr as $record) {
        $JournalistName = $record['Journalist_name'];
        if (!isset($groupedData[$JournalistName])) {
            $groupedData[$JournalistName] = array();
        }
        $groupedData[$JournalistName][] = $record;
    }
    return $groupedData;
}


//for clientSize
public function getSizeDataCompByID($timeframe, $client_id, $from = null, $to = null) {
    $outArr = array();

    // Get competitor data
    $comp_data = $this->getCompititersWithSize($client_id, $from, $to);

    // Get client data
    $client_data = $this->getClientSize($client_id, $from, $to);
    $client_name = $this->getClientNameByID($client_id);
    // Loop through client data and prepare output array
    foreach ($client_data as $value) {
        $outArr[] = [
            'label' => $client_name,
            'count' => $value['count'],
            'category' => $value['category'],
            'ave' => $value['ave'],
        ];
    }

    // Merge client data with competitor data
    $final_array = array_merge($outArr, $comp_data);

    return $final_array;
}

public function getAVEDataByID($timeframe, $client_id, $from = null, $to = null){
    $outArr = array();
    $client_name = $this->getClientNameByID($client_id);
    $comp_data = $this->getCompititersWithAVE($client_id, $from, $to);
    $client_data = $this->getClientAVE($client_id, $from, $to);
    $comp_data[] = [
        'label' =>$client_name,
            'count' => $client_data[0]['news_count'],
            'ave' => $client_data[0]['total_ave']
        ];

    return $comp_data;
}
public function getClientNameByID($client_id) {
    $this->db->select('client_name');
    $this->db->from('client');
    $this->db->where('client_id', $client_id);
    $result = $this->db->get()->row_array();
    
    return $result ? $result['client_name'] : '';
}
}   
?>