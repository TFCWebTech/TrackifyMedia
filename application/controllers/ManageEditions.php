
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
        $Edition = $this->input->post('Edition');
        $EditionOrder = $this->input->post('EditionOrder');
        $MediaOutletId = $this->input->post('MediaOutletId'); // This matches the name attribute in the form
    
        // Handle other fields as needed
    
        $data = array(
            'Edition' => $Edition,
            'EditionOrder' => $EditionOrder,
            'MediaOutletId' => $MediaOutletId,
            'CreatedOn' => date('Y-m-d h:i:s')
            // Add other fields here
        );
    
        $this->editions->add_editions($data);
        redirect('ManageEditions');
    }


    public function editEditions() {
        $edition_id = $this->input->post('edition_id');
        $Edition = $this->input->post('Edition');
        $EditionOrder = $this->input->post('EditionOrder');
        $Status = $this->input->post('Status');

        $data = array(
            'edition_id' => $edition_id,
            'Edition' => $Edition,
            'EditionOrder' => $EditionOrder,
            'Status' => $Status,
            // Add other fields here
        );

        $this->editions->update('edition', 'edition_id', $edition_id, $data);
        redirect('ManageEditions');
        
    }
}

  
