<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageSupplement extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
		$this->load->library('form_validation');
        $this->load->model('ManageSupplementModal', 'supplement', TRUE);
    }
    public function index()
    {  
        $data['get_MediaOutLet'] = $this->supplement->getMediaOutLet();
        $data['get_Edition'] = $this->supplement->getEdition();
        $data['all'] = $this->supplement->getAllSuplement();
        $this->load->view('common/header');
        $this->load->view('manage_supplement', $data);
        $this->load->view('common/footer');
    }

    public function addSupliment(){
        
        $Supplement = $this->input->post('Supplement');
        $gidSupplement = bin2hex(random_bytes(40 / 2));

        $data = array(
            'gidSupplement' => $gidSupplement,
            'Supplement' => $Supplement,
            'Status' => 1,
            'CreatedOn' => date('Y-m-d h:i:s')
        );

        $this->supplement->insert('supplements', $data);

        redirect('ManageSupplement');
    }
    
    public function editSupliment(){
        
        $Supplement = $this->input->post('Supplement');
        $supplement_id = $this->input->post('supplement_id');
        $Status = $this->input->post('Status');

        $data = array(
            'Supplement' => $Supplement,
            'Status' => $Status
        );

        $this->supplement->update('supplements', 'supplement_id', $supplement_id, $data);

        redirect('ManageSupplement');
    }
}
