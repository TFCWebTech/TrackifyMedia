<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageEditions extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
        $this->load->model('ManageEditionsModel', 'editions', TRUE); 
    }

    public function index() {
        $data['editions'] = $this->editions->get_editions(); // Fetch data using the model
        $this->load->view('common/header');
        $this->load->view('manage_editions', $data); // Pass data to the view
        $this->load->view('common/footer');
    }

    // Example method to handle edition addition (not directly used in the provided HTML)
    public function add_editions() {
        $Edition = $this->input->post('Edition');
        $Edition = $this->input->post('Edition');
        $EditionOrder = $this->input->post('EditionOrder');
        // Handle other fields as needed

        $data = array(
            'Edition' => $Edition,
            'Edition' => $Edition,
            'EditionOrder' => $EditionOrder,
            // Add other fields here
        );

        $this->editions->add_edition($data);
        redirect('ManageEditions');
    }


    
    public function editEditions() {
        
        $Edition = $this->input->post('Edition');
        $EditionOrder = $this->input->post('EditionOrder');
        $Status = $this->input->post('Status');

        $data = array(
            'Edition' => $Edition,
            // 'EditionOrder' => $EditionOrder,
            'Status' => $Status,
            // Add other fields here
        );

        $this->editions->update('edition', 'EditionOrder', $Edition, $data);

        redirect('ManageEditions');
    }
}


