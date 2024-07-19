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
        $this->load->model('ManageJournlModel', 'Journalist', TRUE); 
    }

    public function index() {
        $data['journalist'] = $this->Journalist->getalljournalists();
        $data['get_media_type'] = $this->Journalist->mediatype(); // Corrected array key
    
        // Uncomment these lines for debugging if needed
        // echo '<pre>';
        // print_r($data['get_media_type']);
        // echo '</pre>';
    
        $this->load->view('common/header');
        $this->load->view('manage_journl', $data);
        $this->load->view('common/footer');
    }

    // Example method to handle addition (not directly used in your provided HTML)
    public function addjournalist() {
        $this->form_validation->set_rules('media_outlet', 'media_outlet', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('Status', 'Status', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            // If validation fails for any field, set flash message for the first error encountered
            if (form_error('media_outlet')) {
                $this->session->set_flashdata('error', 'Invalid publiction name');
            } elseif (form_error('name')) {
                $this->session->set_flashdata('error', 'Invalid Journalist name');
            } elseif (form_error('email')) {
                   $this->session->set_flashdata('error', 'Invalid Email');
            } elseif (form_error('Status')) {
                $this->session->set_flashdata('error', 'Invalid Status');
            }
            redirect('ManagePublication');
        } else {
        // $media_type = $this->input->post('media_type');
            $media_outlet = $this->input->post('media_outlet');
            $Journalist = $this->input->post('name');
            $JEmailId = $this->input->post('email');
            $Status = $this->input->post('Status');
        
            // Handle other fields as needed
            $data = array(
                'gigMediaOutlet' => $media_outlet,
                'Journalist' => $Journalist,
                'JEmailId' => $JEmailId,
                'Status' => 1,
                'CreatedOn' => date('Y-m-d h:i:s')
                
                // Add other fields here
            );
            // print_r($data);
            $this->Journalist->addjournalist($data); 
            redirect('ManageJournl'); // Corrected redirect URL
        }
    }

    public function editJournalist() {
        $this->form_validation->set_rules('media_outlet', 'media_outlet', 'trim|required');
        $this->form_validation->set_rules('Journalist', 'Journalist', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('Status', 'Status', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            // If validation fails for any field, set flash message for the first error encountered
            if (form_error('media_outlet')) {
                $this->session->set_flashdata('error', 'Invalid publiction name');
            } elseif (form_error('Journalist')) {
                $this->session->set_flashdata('error', 'Invalid Journalist name');
            } elseif (form_error('email')) {
                   $this->session->set_flashdata('error', 'Invalid Email');
            } elseif (form_error('Status')) {
                $this->session->set_flashdata('error', 'Invalid Status');
            }
            redirect('ManageJournl');
        } else {
        // Retrieve posted data
        $media_outlet = $this->input->post('media_outlet');
        $Journalist = $this->input->post('Journalist');
        $JEmailId = $this->input->post('email');
        $Status = $this->input->post('Status');
    
        // Prepare data for update
        $data = array(
            'gigMediaOutlet' => $media_outlet,
            'Journalist' => $Journalist,
            'JEmailId' => $JEmailId,
            'Status' => $Status,
        );
    // print_r($data);
        // Perform the update
        $this->Journalist->update('Journalist', 'gidJournalist', $gidJournalist, $data);
        // Redirect to the management page
        redirect('ManageJournl');
    }
    }
    
}


