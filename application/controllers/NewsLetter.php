<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsLetter extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
		$this->load->library('form_validation');
        $this->load->model('NewsLetter_Model', 'newsLetter', TRUE);
    }
    public function index()
    {
        $data['get_clients'] = $this->newsLetter->getClients();
        // print_r($data);
        $this->load->view('common/header');
        $this->load->view('news_letter', $data);
        $this->load->view('common/footer');
    }
    public function newsMail($client_id){
        $data['details'] = $this->newsLetter->getClientById($client_id);
        $data['get_client_details'] = $this->newsLetter->getClientTemplateDetails($client_id);
        // echo '<pre>';
        // print_r($data['get_client_details']);
        // echo '</pre>';
        $this->load->view('common/header');
        $this->load->view('mail_letter', $data);
        $this->load->view('common/footer');
    }
 
}
?>