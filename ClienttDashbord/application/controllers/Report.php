<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load PhpSpreadsheet manually
require_once APPPATH . 'third_party/Phpspreadsheet.php';
    


class Report extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Login_model', 'login', TRUE);
        $this->load->model('News_data_Model', 'NewsData', TRUE);
        
    }

    public function index(){
        $data['publication_type'] = $this->NewsData->getPublicationTypeData();
        $data['news_city'] = $this->NewsData->getNewsCityData();
        $client_id = $this->session->userdata('client_id');
        $data['details'] = $this->NewsData->getClientById($client_id);
        $data['get_client_details'] = $this->NewsData->getClientTemplateDetails($client_id);
        // echo "<pre>";
        // print_r($data['news_city']);
        // echo "</pre>";
        $this->load->view('common/header');
        $this->load->view('report', $data);
        $this->load->view('common/footer');
    }

    // public function exportWord() {
    //     try {
    //         $client_id = $this->session->userdata('client_id');
    //         $from_date = $this->input->post('from_date');
    //         $to_date = $this->input->post('to_date');
    //         $publication_type = $this->input->post('publication_type');
    //         $Cities = $this->input->post('Cities');

            
    //         $WordFileData = $this->NewsData->getReportData($client_id, $from_date, $to_date, $publication_type, $Cities);
           
    //         echo '<pre>';
    //         print_r($WordFileData);
    //         echo '</pre>';
    //         // Send response as JSON
    //         header('Content-Type: application/json');
    //         echo json_encode($WordFileData);
    //     } catch (Exception $e) {
    //         // Handle exceptions
    //         http_response_code(500); // Internal Server Error
    //         echo json_encode(array('error' => $e->getMessage()));
    //     }
    // }
    public function exportWord() {
        try {
            $client_id = $this->session->userdata('client_id');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $publication_type = $this->input->post('publication_type');
            $Cities = $this->input->post('Cities');
            $client_name = $this->session->userdata('client_name');
    
            // Get report data
            $WordFileData = $this->NewsData->getReportData($client_id, $from_date, $to_date, $publication_type, $Cities);
    
            // Initialize an array to hold all the data, including news articles
            $completeData = array();
    
            // Loop through the report data and get news articles for each news_details_id
            foreach ($WordFileData as $report) {
                $news_details_id = $report['news_details_id'];
                $newsArticles = $this->NewsData->getNewsArticalData($news_details_id);
                $report['news_articles'] = $newsArticles; // Add news articles to the report data
                $completeData[] = $report;
            }
            // Add client name and date range to the response
            $response = array(
                'client_name' => $client_name,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'data' => $completeData
            );
            // Send response as JSON
            header('Content-Type: application/json');
            echo json_encode($response); // Properly output the JSON-encoded response
        } catch (Exception $e) {
            // Handle exceptions
            http_response_code(500); // Internal Server Error
            echo json_encode(array('error' => $e->getMessage()));
        }
    }


}
?>