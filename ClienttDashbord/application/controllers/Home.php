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
        // print_r($data['geography_graph_monthly']);
        
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
    
    // public function allJournalistGraphs($from = null, $to = null)
    // {
    //     $client_id = $this->session->userdata('client_id');
    //     // echo $client_id;
    //     $data['Journalist_graph_daily'] = $this->newsLetter->get_journalist_data_by_timeframe('daily', $client_id, $from, $to);
    //     $data['Journalist_graph_weekly'] = $this->newsLetter->get_journalist_data_by_timeframe('weekly', $client_id, $from, $to);
    //     $data['Journalist_graph_monthly'] = $this->newsLetter->get_journalist_data_by_timeframe('monthly', $client_id, $from, $to);
    //     print_r($data['Journalist_graph_weekly']);
    //     // $this->load->view('common/header');
    //     // $this->load->view('index', $data);
    //     // $this->load->view('common/footer');
    // }



    public function DisplayNews($news_details_id){
        $data['news_details'] = $this->newsLetter->getNewsDataById($news_details_id);
        $this->load->view('common/header');
        $this->load->view('news_details', $data);
        $this->load->view('common/footer');

    }

}
?>