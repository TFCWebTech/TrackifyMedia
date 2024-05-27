<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailTemplate extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        // $this->load->model('Reporter_Model', 'reporter', TRUE);
    }

    public function index()
    {
        // $data['all_staff'] = $this->staff->getStaffData();
        $this->load->view('common/header2');
        $this->load->view('manage_template');
        $this->load->view('common/footer');
    }
    public function CreateTemplate()
    {
        // $data['all_staff'] = $this->staff->getStaffData();
        $this->load->view('common/header');
        $this->load->view('manage_template');
        $this->load->view('common/footer');
    }
    public function viewNews(){
        $this->load->view('common/header');
        $this->load->view('view_news');
        $this->load->view('common/footer');
    }

    
}
?>