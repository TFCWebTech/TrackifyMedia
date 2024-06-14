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

    function getClientNewsCount($timeframe, $client_id, $from = null, $to = null) {
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
        
        return $this->db->count_all_results();
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
        $this->db->where("NOT FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
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

    public function getMediaData($timeframe, $client_id, $from = null, $to = null){
        $this->db->select('*');
        $this->db->from('mediatype');
        $result = $this->db->get()->result_array();
        $outArr = array();
        foreach ($result as $row){
            $news_data = $this->getNewsDetails($row['gidMediaType'], $client_id, $from , $to );
            $outArr[] = array(
                'Media_name' => $row['MediaType'],
                'Count' => $news_data,
                'Client_name' =>$this->session->userdata('client_name')
            );

            $comp_data = $this->getCompData('daily', $client_id, $from, $to, $row['gidMediaType']);
            foreach ($comp_data as $key => $value) {
               
                $outArr[] = array(
                    'Media_name' => $row['MediaType'],
                    'Count' => $value['count'],
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

    public function getNewsDetails($gidMediaType, $client_id, $from = null, $to = null){
        $this->db->select('*');
        $this->db->from('news_details');
        $this->db->where('media_type_id', $gidMediaType); 
        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }

        $this->db->group_start();
        $this->db->where("FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();

       return $this->db->count_all_results();       
    }

    public function getPublicationData($timeframe, $client_id, $from = null, $to = null) {
        $this->db->select('*');
        $this->db->from('mediaoutlet');
        $result = $this->db->get()->result_array();
        $outArr = array();
    
        foreach ($result as $row) {
            $news_data = $this->getNewsDetails2($row['gidMediaOutlet'], $client_id, $from, $to);
            $outArr[] = array(
                'Publication_name' => $row['MediaOutlet'],
                'Count' => $news_data,
                'Client_name' => $this->session->userdata('client_name')
            );
    
            $comp_data = $this->getCompData2('daily', $client_id, $from, $to, $row['gidMediaOutlet']);
            foreach ($comp_data as $key => $value) {
                $outArr[] = array(
                    'Publication_name' => $row['MediaOutlet'],
                    'Count' => $value['count'],
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
            $PublicationName = $record['Publication_name'];
            if (!isset($groupedData[$PublicationName])) {
                $groupedData[$PublicationName] = array();
            }
            $groupedData[$PublicationName][] = $record;
        }
    
        return $groupedData;
    }
    
    public function getNewsDetails2($gidMediaOutlet, $client_id, $from = null, $to = null){
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

       return $this->db->count_all_results();       
    }

    public function getCompData2($timeframe, $client_id, $from = null, $to = null, $gidMediaOutlet = null)
    {
        $this->db->select('*');
        $this->db->from('competitor');
        $this->db->where('client_id', $client_id);
        $result = $this->db->get()->result_array();
        $outArr = array();
        foreach ($result as $row){
            $news_count = $this->getCompNewsByKey2($row['Keywords'], $client_id, $from, $to, $gidMediaOutlet);
            $outArr[] = array(
                'label' => $row['Competitor_name'],
                'count' => $news_count
            );
        }
        return $outArr;
    }

    public function getCompNewsByKey2($Keywords, $client_id, $from = null, $to = null, $gidMediaOutlet)
    {
        
        $this->db->select('*');
        $this->db->from('news_details');

        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }
        if($gidMediaOutlet !== null) {
            $this->db->where('publication_id', $gidMediaOutlet);
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
        return $this->db->count_all_results();
        // $query = $this->db->get();
        // $result = $query->result_array(); 
        // return $result; 
    }

    public function getGeographyData($timeframe, $client_id, $from = null, $to = null){

        $this->db->select('*');
        $this->db->from('edition');
        $result = $this->db->get()->result_array();
        $outArr = array();
    
        foreach ($result as $row) {
            $news_data = $this->getNewsDetails3($row['gidEdition'], $client_id, $from, $to);
            $outArr[] = array(
                'Edition_name' => $row['Edition'],
                'Count' => $news_data,
                'Client_name' => $this->session->userdata('client_name')
            );
    
            $comp_data = $this->getCompData3('daily', $client_id, $from, $to, $row['gidEdition']);
            foreach ($comp_data as $key => $value) {
                $outArr[] = array(
                    'Edition_name' => $row['Edition'],
                    'Count' => $value['count'],
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
    
    public function getNewsDetails3($gidEdition, $client_id, $from = null, $to = null){
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

       return $this->db->count_all_results();       
    }

    public function getCompData3($timeframe, $client_id, $from = null, $to = null, $gidEdition = null)
    {
        $this->db->select('*');
        $this->db->from('competitor');
        $this->db->where('client_id', $client_id);
        $result = $this->db->get()->result_array();
        $outArr = array();
        foreach ($result as $row){
            $news_count = $this->getCompNewsByKey3($row['Keywords'], $client_id, $from, $to, $gidEdition);
            $outArr[] = array(
                'label' => $row['Competitor_name'],
                'count' => $news_count
            );
        }
        return $outArr;
    }

    public function getCompNewsByKey3($Keywords, $client_id, $from = null, $to = null, $gidEdition)
    {
        
        $this->db->select('*');
        $this->db->from('news_details');

        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }
        if($gidEdition !== null) {
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
        return $this->db->count_all_results();
        // $query = $this->db->get();
        // $result = $query->result_array(); 
        // return $result; 
    }

    public function getJoutnalistData($timeframe, $client_id, $from = null, $to = null){

        $this->db->select('*');
        $this->db->from('journalist');
        $result = $this->db->get()->result_array();
        $outArr = array();
    
        foreach ($result as $row) {
            $news_data = $this->getNewsDetails4($row['gidJournalist'], $client_id, $from, $to);
            $outArr[] = array(
                'Journalist_name' => $row['Journalist'],
                'Count' => $news_data,
                'Client_name' => $this->session->userdata('client_name')
            );
    
            $comp_data = $this->getCompData4('daily', $client_id, $from, $to, $row['gidJournalist']);
            foreach ($comp_data as $key => $value) {
                $outArr[] = array(
                    'Journalist_name' => $row['Journalist'],
                    'Count' => $value['count'],
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
            $JournalistName = $record['Journalist_name'];
            if (!isset($groupedData[$JournalistName])) {
                $groupedData[$JournalistName] = array();
            }
            $groupedData[$JournalistName][] = $record;
        }
        return $groupedData;
    }
    
    public function getNewsDetails4($gidJournalist, $client_id, $from = null, $to = null){
        $this->db->select('*');
        $this->db->from('news_details');
        $this->db->where('journalist_id', $gidJournalist); 
        if ($from !== null && $to !== null) {
            $this->db->where('create_at >=', $from);
            $this->db->where('create_at <=', $to);
        }

        $this->db->group_start();
        $this->db->where("FIND_IN_SET('$client_id', client_id)", NULL, FALSE);
        $this->db->group_end();

       return $this->db->count_all_results();       
    }

    public function getCompData4($timeframe, $client_id, $from = null, $to = null, $gidJournalist = null)
    {
        $this->db->select('*');
        $this->db->from('competitor');
        $this->db->where('client_id', $client_id);
        $result = $this->db->get()->result_array();
        $outArr = array();
        foreach ($result as $row){
            $news_count = $this->getCompNewsByKey3($row['Keywords'], $client_id, $from, $to, $gidJournalist);
            $outArr[] = array(
                'label' => $row['Competitor_name'],
                'count' => $news_count
            );
        }
        return $outArr;
    }

    public function getCompNewsByKey4($Keywords, $client_id, $from = null, $to = null, $gidJournalist)
    {
        
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
        return $this->db->count_all_results();
        // $query = $this->db->get();
        // $result = $query->result_array(); 
        // return $result; 
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
    
}   
?>