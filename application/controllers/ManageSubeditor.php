<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageSubeditor extends CI_Controller {

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
        $this->load->view('common/header');
        $this->load->view('manage_subeditor');
        $this->load->view('common/footer');
    }
 
    public function Logout()
 	{
 		$this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        redirect('Login');
 	}
}
?>