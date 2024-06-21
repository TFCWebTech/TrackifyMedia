<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Login_model', 'login', TRUE);
        $this->load->model('NewsLetter_Model', 'newsLetter', TRUE);
    }

    public function allGraphs($from = null, $to = null)
    {
        $client_id = $this->session->userdata('client_id');
        // echo $client_id;
        $data['quantity_graph_daily'] = $this->newsLetter->get_data_by_timeframe('daily', $client_id, $from, $to);
        $data['quantity_graph_weekly'] = $this->newsLetter->get_data_by_timeframe('weekly', $client_id, $from, $to);
        $data['quantity_graph_monthly'] = $this->newsLetter->get_data_by_timeframe('monthly', $client_id, $from, $to);
       
        $data['Journalist_graph_daily'] = $this->newsLetter->get_journalist_data_by_timeframe('daily', $client_id, $from, $to);
        $data['Journalist_graph_weekly'] = $this->newsLetter->get_journalist_data_by_timeframe('weekly', $client_id, $from, $to);
        $data['Journalist_graph_monthly'] = $this->newsLetter->get_journalist_data_by_timeframe('monthly', $client_id, $from, $to);
       
        $data['geography_graph_daily'] = $this->newsLetter->get_geography_data_by_timeframe('daily', $client_id, $from, $to);
        $data['geography_graph_weekly'] = $this->newsLetter->get_geography_data_by_timeframe('weekly', $client_id, $from, $to);
        $data['geography_graph_monthly'] = $this->newsLetter->get_geography_data_by_timeframe('monthly', $client_id, $from, $to);

        $data['media_graph_daily'] = $this->newsLetter->get_media_data_by_timeframe('daily', $client_id, $from, $to);
        $data['media_graph_weekly'] = $this->newsLetter->get_media_data_by_timeframe('weekly', $client_id, $from, $to);
        $data['media_graph_monthly'] = $this->newsLetter->get_media_data_by_timeframe('monthly', $client_id, $from, $to);

        $data['publication_graph_daily'] = $this->newsLetter->get_Publication_data_by_timeframe('daily', $client_id, $from, $to);
        $data['publication_graph_weekly'] = $this->newsLetter->get_Publication_data_by_timeframe('weekly', $client_id, $from, $to);
        $data['publication_graph_monthly'] = $this->newsLetter->get_Publication_data_by_timeframe('monthly', $client_id, $from, $to);

        $data['size_daily_data'] = $this->newsLetter->get_size_data('daily', $client_id, $from, $to);
        $data['size_weekly_data'] = $this->newsLetter->get_size_data('weekly', $client_id, $from, $to);
        $data['size_monthly_data'] = $this->newsLetter->get_size_data('monthly', $client_id, $from, $to);
        // print_r($data['publication_graph_daily']);

        $this->load->view('common/header');
        $this->load->view('index', $data);
        $this->load->view('common/footer');
    }

    public function filterGraphs()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');

        redirect('Home/allGraphs/'.$from.'/'.$to);
    }

    // Pro Compare Charts
    // public function CompareCharts($from = null, $to = null)
    // {
    //     $client_id = $this->session->userdata('client_id');
    //     $clients = $this->session->userdata('clients');
    //     // Convert $clients to an array
    //     $client_ids = explode(',', $clients);
    
    //     $compititers_data = $this->newsLetter->getCompData('daily', $client_id, $from, $to, '');
    //     $clients_news_count = $this->newsLetter->getClientNewsCount('daily', $client_id, $from, $to);
    //     $compititers_data[] = array(
    //         'label' => $this->session->userdata('client_name'),
    //         'count' => $clients_news_count
    //     );
    //     $data['get_quantity_compare_data'] = $compititers_data;
    //     //Media Data

    //     $data['media_data'] = $this->newsLetter->getMediaData('daily', $client_id, $from, $to);
       
    //     $data['Publication_data'] = $this->newsLetter->getPublicationData('daily', $client_id, $from, $to);
    // $data['size_data'] = $this->newsLetter->getSizeDataComp('daily', $client_id, $from, $to);
    //     $data['geography_data'] = $this->newsLetter->getGeographyData('daily', $client_id, $from, $to);
    //     $data['Journalist_data'] = $this->newsLetter->getJoutnalistData('daily', $client_id, $from, $to);
    //     $data['ave_data'] = $this->newsLetter->getAVEData('daily', $client_id, $from, $to);
    //     // echo '<pre>';
    //     // print_r($data['clients']);
    //     // echo '</pre>';

    //     // $this->load->view('common/header');
    //     // $this->load->view('compare_charts', $data);
    //     // $this->load->view('common/footer');
    // }

    // Pro Compare Charts
        public function CompareCharts($from = null, $to = null)
        {
            $client_id = $this->session->userdata('client_id');
            $clients = $this->session->userdata('clients');
            
            // Convert $clients to an array
            $client_ids = explode(',', $clients);
            
            // Loop through each client ID and gather data
            $compititers_data = [];
            foreach ($client_ids as $id) {
                $compititers_data = array_merge($compititers_data, $this->newsLetter->getCompData('daily', $id, $from, $to, ''));
            }

            $clients_news_count = $this->newsLetter->getClientNewsCount('daily', $client_id, $from, $to);
            $compititers_data[] = array(
                'label' => $this->session->userdata('client_name'),
                'count' => $clients_news_count
            );
            $data['get_quantity_compare_data'] = $compititers_data;

            // Initialize arrays to hold the combined data for each client
            $media_data = [];
            $publication_data = [];
            $geography_data = [];
            $journalist_data = [];
            $ave_data = [];
            $size_data = [];

            // Loop through each client ID and gather data
            foreach ($client_ids as $id) {
                $media_data = array_merge($media_data, $this->newsLetter->getMediaData('daily', $id, $from, $to));
                $publication_data = array_merge($publication_data, $this->newsLetter->getPublicationData('daily', $id, $from, $to));
                $geography_data = array_merge($geography_data, $this->newsLetter->getGeographyData('daily', $id, $from, $to));
                $journalist_data = array_merge($journalist_data, $this->newsLetter->getJoutnalistData('daily', $id, $from, $to));
                $ave_data = array_merge($ave_data, $this->newsLetter->getAVEData('daily', $id, $from, $to));
                $size_data = array_merge($size_data, $this->newsLetter->getSizeDataComp('daily', $id, $from, $to));
            }

            // Assign combined data to $data array
            $data['media_data'] = $media_data;
            $data['Publication_data'] = $publication_data;
            $data['geography_data'] = $geography_data;
            $data['Journalist_data'] = $journalist_data;
            $data['ave_data'] = $ave_data;
            $data['size_data'] = $size_data;
            
            // Uncomment these lines to load views if necessary
            $this->load->view('common/header');
            $this->load->view('compare_charts', $data);
            $this->load->view('common/footer');
        }

        

        public function compareFilterGraphs2()
        {
            $from = $this->input->post('from');
            $to = $this->input->post('to');

            redirect('Home/CompareCharts/'.$from.'/'.$to);
        }

        public function DisplayNews($news_details_id){
            $data['news_details'] = $this->newsLetter->getNewsDataById($news_details_id);
            $this->load->view('common/header');
            $this->load->view('news_details', $data);
            $this->load->view('common/footer');

        }



}
?>