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
    public function CompareCharts($from = null, $to = null)
    {
        $client_id = $this->session->userdata('client_id');
        // echo $client_id;
        $compititers_data = $this->newsLetter->getCompData('daily', $client_id, $from, $to, '');
        $clients_news_count = $this->newsLetter->getClientNewsCount('daily', $client_id, $from, $to);

        $compititers_data[] = array(
            'label' => $this->session->userdata('client_name'),
            'count' => $clients_news_count
        );
        $data['get_quantity_compare_data'] = $compititers_data;
        //Media Data

        $data['media_data'] = $this->newsLetter->getMediaData('daily', $client_id, $from, $to);
        
        //Publication Data
        $data['Publication_data'] = $this->newsLetter->getPublicationData('daily', $client_id, $from, $to);
        // echo '<pre>';
        // print_r($data['Publication_data']);
        // echo '</pre>';
        $this->load->view('common/header');
        $this->load->view('compare_charts', $data);
        $this->load->view('common/footer');
    }




    public function DisplayNews($news_details_id){
        $data['news_details'] = $this->newsLetter->getNewsDataById($news_details_id);
        $this->load->view('common/header');
        $this->load->view('news_details', $data);
        $this->load->view('common/footer');

    }



}
?>