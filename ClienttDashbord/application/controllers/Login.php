<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
		$this->load->database();
		$this->load->model('Login_model', 'login', TRUE);
    }

    public function index()
	{
        // $this->load->view('common/header');
		$this->load->view('login');
        // $this->load->view('common/footer');
	}

	public function userLogin()
    {
        $clientId = $this->input->post('userId');            
        $password = $this->input->post('user_password');
        $enc_pass = md5($password);

        if(!empty($clientId) && !empty($password)) {
            $Client = $this->login->checkClient($clientId, $enc_pass);

            if($Client) {
                $client_id = $Client['client_id'];
                $client_name = $Client['client_name'];
                $Start_session = array (
                    'client_id' => $client_id,
                    'client_name' => $client_name,
                    );
                    // print_r($Start_session);
                    $this->session->set_userdata($Start_session);
                    redirect('Home'); 

            } else {
                    $this->session->set_flashdata('error','Your credentials are incorrect');
		             redirect('Login');
            }
        } else {
            $this->session->set_flashdata('error','Please provide both username and password');
            redirect('Login');
        }
    }

	
 	public function Logout()
 	{
 		$this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        redirect('Login');
 	}

}
?>