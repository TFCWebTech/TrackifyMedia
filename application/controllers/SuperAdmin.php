<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {
  
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
		$this->load->database();
		$this->load->model('SuperAdmin_model', 'super_admin', TRUE);
    }

    public function index()
	{
        $this->load->view('superAdmin/super_login');
	}

    public function adminLogin(){
        $userId = $this->input->post('userId');            
        $password = $this->input->post('user_password');

        $enc_pass = md5($password);

        if(!empty($userId) && !empty($password)) {
            // Check user credentials
            $admin = $this->super_admin->checkUser($userId, $enc_pass);
            if($admin) {
                // echo json_encode($user); 
                $super_admin_id = $admin['super_admin_id'];
                $super_admin_name = $admin['super_admin_name'];
                $Start_session = array (
                    'super_admin_id' => $userId,
                    'super_admin_name' => $enc_pass
                    );
                    // print_r($Start_session);
                $this->session->set_userdata($Start_session);
                $this->session->set_flashdata('success','Login successfully');      
                redirect('ManageClient');
            } else {
                // User not found or credentials incorrect
                    $this->session->set_flashdata('error','Your credentials are incorrect');
		             redirect('SuperAdmin');
            }
        } else {
            $this->session->set_flashdata('error','Please provide both username and password');
            redirect('SuperAdmin');
        }
    }

    public function Dashboard(){
        $this->load->view('common/header2');
        $this->load->view('superAdmin/dashboard');
        $this->load->view('common/footer');
    }
    public function Logout()
 	{
 		$this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        redirect('SuperAdmin');
 	}
}
?>    