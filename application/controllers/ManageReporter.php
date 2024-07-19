<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageReporter extends CI_Controller {

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
        $data['all_reporter'] = $this->reporter->getReporterData();
        $this->load->view('common/header2');
        $this->load->view('superAdmin/manage_reporter',$data);
        $this->load->view('common/footer');
    }

	public function ReporterInfo()
    {
        $data['all_reporter'] = $this->reporter->getReporterData();
        $this->load->view('common/header');
        $this->load->view('manage_reporter',$data);
        $this->load->view('common/footer');
    }

    public function addReporter(){
        $this->form_validation->set_rules('reporter_name', 'reporter_name', 'trim|required');
		$this->form_validation->set_rules('user_email', 'user_email', 'trim|required');
	    $this->form_validation->set_rules('password', 'password', 'trim|required');
	    $this->form_validation->set_rules('is_active', 'is_active', 'trim|required');
	    if ($this->form_validation->run() == FALSE) {
	        // If validation fails for any field, set flash message for the first error encountered
	        if (form_error('reporter_name')) {
	            $this->session->set_flashdata('error', 'Invalid reporter name');
			} elseif (form_error('user_email')) {
	            $this->session->set_flashdata('error', 'Invalid Email');
	        } elseif (form_error('password')) {
	            $this->session->set_flashdata('error', 'Invalid password');
	        } elseif (form_error('is_active')) {
	            $this->session->set_flashdata('error', 'Invalid active');
	        }
	        redirect('ManageReporter/ReporterInfo');
	    } else {
	        $reporter_name = $this->input->post('reporter_name');
			$user_email = $this->input->post('user_email');
	        $Password = $this->input->post('password');
            $enc_pass = md5($Password);
	        $is_active = $this->input->post('is_active');
	        $data = array(
	        	'user_name' => $reporter_name,
				'user_email' => $user_email,
	        	'user_password' => $enc_pass,
	        	'user_status' => $is_active,
				'user_type' => 'Reporter'
	        );
				$this->reporter->insert('user', $data);
				$this->session->set_flashdata('success', 'Reporter Added Successfully.');
	       		redirect('ManageReporter/ReporterInfo');
	    }
	}

	public function editReporter(){
		$this->form_validation->set_rules('reporter_name', 'reporter_name', 'trim|required');
		$this->form_validation->set_rules('user_email', 'user_email', 'trim|required');
	    $this->form_validation->set_rules('password', 'password', 'trim|required');
	    $this->form_validation->set_rules('is_active', 'is_active', 'trim|required');
	    if ($this->form_validation->run() == FALSE) {
	        // If validation fails for any field, set flash message for the first error encountered
	        if (form_error('reporter_name')) {
	            $this->session->set_flashdata('error', 'Invalid reporter name');
			} elseif (form_error('user_email')) {
	            $this->session->set_flashdata('error', 'Invalid Email');
	        } elseif (form_error('password')) {
	            $this->session->set_flashdata('error', 'Invalid password');
	        } elseif (form_error('is_active')) {
	            $this->session->set_flashdata('error', 'Invalid active');
	        }
	        redirect('ManageReporter/ReporterInfo');
	    } else {
			$user_id = $this->input->post('user_id');
			$reporter_name = $this->input->post('reporter_name');
			$user_email = $this->input->post('user_email');
			$is_active = $this->input->post('is_active');
			$data = array(
				'user_name' => $reporter_name,
				'user_email' => $user_email,
				'user_status' => $is_active,
			);
			$this->reporter->update('user', 'user_id', $user_id, $data);
				$this->session->set_flashdata('success', 'Reporter Updated Successfully.');
				redirect('ManageReporter/ReporterInfo');
		}
	}
}
?>