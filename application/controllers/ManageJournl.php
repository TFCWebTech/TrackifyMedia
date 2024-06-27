<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageJournl extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
        // $this->load->library('form_validation');
        $this->load->model('Managejournlmodel', 'Journalist', TRUE); 
    }

    public function index() {
        $data['journalist'] = $this->Journalist->getalljournalists();
        $data['get_MediaOutLet'] = $this->Journalist->getMediaOutLet();
        // print_r($data);
        $this->load->view('common/header');
        $this->load->view('manage_journl', $data);
        $this->load->view('common/footer');
    }

    // Example method to handle addition (not directly used in your provided HTML)
    public function addjournalist() {
        // $media_type = $this->input->post('media_type');
        // $media_outlet = $this->input->post('gigMediaOutlet');
        $Journalist = $this->input->post('name');
        $JEmailId = $this->input->post('JEmailId');
        $Status = $this->input->post('Status');
       
        // Handle other fields as needed
        $data = array(
            'Journalist' => $Journalist,
            'JEmailId' => $JEmailId,
            'Status' => 1,
            'CreatedOn' => date('Y-m-d h:i:s')
            
            // Add other fields here
        );

        $this->Journalist->addjournalist($data); 
        redirect('ManageJournl'); // Corrected redirect URL
        
    }

    public function editJournalist() {
        // Retrieve posted data
        $Journalist = $this->input->post('gidJournalist');
        // media_outlet
        // Journalist
        // JEmailId
        // Status
        $Journalist = $this->input->post('Journalist');
        $JEmailId = $this->input->post('JEmailId');
        $Status = $this->input->post('Status');
    
        // Prepare data for update
        $data = array(
            'Journalist' => $Journalist,
            'JEmailId' => $JEmailId,
            'Status' => $Status,
        );
    
        // Perform the update
        $this->Journalist->update('Journalist', 'gidJournalist', $gidJournalist, $data);
        // Redirect to the management page
        redirect('ManageJournl');
    }

    
}


