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

    public function index()
    {
        $client_id = $this->session->userdata('client_id');
        // echo $client_id;
        
        $this->load->view('common/header');
        $this->load->view('index');
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