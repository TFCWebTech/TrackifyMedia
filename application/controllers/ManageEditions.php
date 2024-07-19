
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageEditions extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
        $this->load->library('form_validation');
        $this->load->model('ManageEditionsModel', 'editions', TRUE); 
    }

    public function index() {
        $data['editions'] = $this->editions->getAlledition(); // Fetch data using the model
        $data['get_MediaOutLet'] = $this->editions->getMediaOutLet();
       
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        $this->load->view('common/header');
        $this->load->view('manage_editions', $data); // Pass data to the view
        $this->load->view('common/footer');
    }

     // Example method to handle edition addition (not directly used in the provided HTML)
      public function add_editions() {
        $this->form_validation->set_rules('Edition', 'Edition', 'trim|required');
        $this->form_validation->set_rules('EditionOrder', 'EditionOrder', 'trim|required');
        $this->form_validation->set_rules('MediaOutletId', 'MediaOutletId', 'trim|required');
        $this->form_validation->set_rules('Status', 'Status', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            // If validation fails for any field, set flash message for the first error encountered
            if (form_error('Edition')) {
                $this->session->set_flashdata('error', 'Invalid Edition name');
            } elseif (form_error('EditionOrder')) {
                $this->session->set_flashdata('error', 'Invalid EditionOrder');
           } elseif (form_error('MediaOutletId')) {
                   $this->session->set_flashdata('error', 'Invalid Publication');
            } elseif (form_error('Status')) {
                $this->session->set_flashdata('error', 'Invalid Active Status');
            }
            redirect('ManageEditions');
        } else {
            $Edition = $this->input->post('Edition');
            $EditionOrder = $this->input->post('EditionOrder');
            $MediaOutletId = $this->input->post('MediaOutletId'); // This matches the name attribute in the form
            $Status = $this->input->post('Status');
            // Handle other fields as needed
            $gidEdition = bin2hex(random_bytes(40 / 2));
            $data = array(
                'Edition' => $Edition,
                'gidEdition' => $gidEdition,
                'EditionOrder' => $EditionOrder,
                'MediaOutletId' => $MediaOutletId,
                'Status' => $Status,
                'CreatedOn' => date('Y-m-d h:i:s')
                // Add other fields here
            );
            $this->editions->add_editions($data);
            redirect('ManageEditions');
        }
    }

    public function editEditions() {
        $this->form_validation->set_rules('Edition', 'Edition', 'trim|required');
        $this->form_validation->set_rules('EditionOrder', 'EditionOrder', 'trim|required');
        $this->form_validation->set_rules('MediaOutletId', 'MediaOutletId', 'trim|required');
        $this->form_validation->set_rules('Status', 'Status', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            // If validation fails for any field, set flash message for the first error encountered
            if (form_error('Edition')) {
                $this->session->set_flashdata('error', 'Invalid Edition name');
            } elseif (form_error('EditionOrder')) {
                $this->session->set_flashdata('error', 'Invalid EditionOrder');
            } elseif (form_error('MediaOutletId')) {
                   $this->session->set_flashdata('error', 'Invalid Publication');
            } elseif (form_error('Status')) {
                $this->session->set_flashdata('error', 'Invalid Active Status');
            }
            redirect('ManageEditions');
        } else {
        $edition_id = $this->input->post('edition_id');
        $Edition = $this->input->post('Edition');
        $EditionOrder = $this->input->post('EditionOrder');
        $MediaOutletId = $this->input->post('MediaOutletId');
        $Status = $this->input->post('Status');

        $data = array(
            'edition_id' => $edition_id,
            'Edition' => $Edition,
            'EditionOrder' => $EditionOrder,
            'MediaOutletId' => $MediaOutletId,
            'Status' => $Status,
            // Add other fields here
        );
        // print_r($data);
        $this->editions->update('edition', 'edition_id', $edition_id, $data);
        redirect('ManageEditions');
    } 
    }
}

  
