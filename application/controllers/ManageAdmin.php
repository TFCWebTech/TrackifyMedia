<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageAdmin extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
		$this->load->library('form_validation');
        $this->load->model('Reporter_Model', 'reporter', TRUE);
    }
    public function index()
    {
        // $data['all_staff'] = $this->staff->getStaffData();
        $this->load->view('common/header2');
        $this->load->view('superAdmin/manage_admin');
        $this->load->view('common/footer');
    }
    
}
?>