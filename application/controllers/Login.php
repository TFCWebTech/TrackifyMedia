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
        $userId = $this->input->post('userId');            
        $password = $this->input->post('user_password');
        $type = $this->input->post('type');
        $enc_pass = md5($password);

        if(!empty($userId) && !empty($password)) {
            // Check user credentials
            $user = $this->login->checkUser($userId, $enc_pass);

            if($user) {
                // echo json_encode($user); 
                $user_id = $user['user_id'];
                $user_name = $user['user_name'];
                $user_type = $user['user_type'];
                $Start_session = array (
                    'user_id' => $user_id,
                    'user_name' => $user_name,
                    'user_type' => $user_type
                    );
                    // print_r($Start_session);
                $this->session->set_userdata($Start_session);
                // $this->session->set_flashdata('success','Login successfully'); 
                if($this->session->userdata('user_type') == 'Reporter')  {   
                    redirect('NewsUpload');
                }elseif($this->session->userdata('user_type') == 'Admin'){
                    redirect('ManageNews');
                }else{
                    redirect('Login'); 
                }  

            } else {
                // User not found or credentials incorrect
                    $this->session->set_flashdata('error','Your credentials are incorrect');
		             redirect('Login');
            }
        } else {
            $this->session->set_flashdata('error','Please provide both username and password');
            redirect('Login');
        }
    }

	// public function resetPassword($login_id, $token)
    // {
    //     $data['check_token'] = $this->login->checkLoginToken($login_id, $token); 
	// 	$data['login_id'] = $login_id;
	// 	$data['token']=$token;
    //     $this->load->view('reset_password', $data);
    // }
    // public function generatePassword($login_id, $token)
    // {
    //     $data['check_token'] = $this->login->checkLoginToken($login_id, $token); 
	// 	$data['login_id'] = $login_id;
	// 	$data['token']=$token;
    //     $this->load->view('generate_password', $data);
    // }

    // public function generateCustomerPassword($customer_id, $token)
    // {
    //     $data['check_token'] = $this->login->checkCustomerToken($customer_id, $token); 
	// 	$data['customer_id'] = $customer_id;
	// 	$data['token']=$token;
    //     $this->load->view('generate_customer_password', $data);
    // }

	// public function newPassword()
    // {
    //     $token = $this->input->post('token');
    //     $login_id = $this->input->post('login_id');
    //     $password1 = $this->input->post('password1');
    //     $confirm_password2 = $this->input->post('password2');

    //     $password = md5($password1);
    //     $confirm_password = md5($confirm_password2);

    //     if($password!=$confirm_password)
    //     {
    //         $this->session->set_flashdata('error', 'Passwords did not match, Please try again!!!');
    //         redirect('Login/generate_password/'.$login_id.'/'.$token);
    //     }
    //     else
    //     {
    //         $data = array(
    //             'password' => $password,
    //             'token' => ''
    //         );
	// 		// print_r($data);
	// 		// echo $login_id;
    //         $this->login->update('login', 'login_id', $login_id, $data);
    //         $this->session->set_flashdata('success', 'Password Updated Successfully');
    //         redirect('Login');
    //     }
    // }


    // public function newPasswordGenerate()
    // {
    //     $token = $this->input->post('token');
    //     $login_id = $this->input->post('login_id');
    //     $password1 = $this->input->post('password1');
    //     $confirm_password2 = $this->input->post('password2');

    //     $password = md5($password1);
    //     $confirm_password = md5($confirm_password2);

    //     if($password!=$confirm_password)
    //     {
    //         $this->session->set_flashdata('error', 'Passwords did not match, Please try again!!!');
    //         redirect('Login/generatePassword/'.$login_id.'/'.$token);
    //     }
    //     else
    //     {
    //         $data = array(
    //             'password' => $password,
    //             'token' => ''
    //         );
	// 		// print_r($data);
	// 		// echo $login_id;
    //         $this->login->update('login', 'login_id', $login_id, $data);
    //         $this->session->set_flashdata('success', 'Password generated Successfully');
    //         redirect('Login');
    //     }
    // }

    // public function customerPasswordGenerate()
    // {
    //     $token = $this->input->post('token');
    //     $customer_id = $this->input->post('customer_id');
    //     $password1 = $this->input->post('password1');
    //     $confirm_password2 = $this->input->post('password2');

    //     $password = md5($password1);
    //     $confirm_password = md5($confirm_password2);

    //     if($password!=$confirm_password)
    //     {
    //         $this->session->set_flashdata('error', 'Passwords did not match, Please try again!!!');
    //         redirect('Login/generateCustomerPassword/'.$customer_id.'/'.$token);
    //     }
    //     else
    //     {
    //         $data = array(
    //             'customer_password' => $password,
    //             'token' => ''
    //         );
	// 		// print_r($data);
	// 		// echo $login_id;
    //         $this->login->updateCustomer('customer', 'customer_id', $customer_id, $data);
    //         $this->session->set_flashdata('success', 'Password generated Successfully');
    //         redirect('CustomerLogin');
    //     }
    // }


 	public function Logout()
 	{
 		$this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        redirect('Login');
 	}

}
?>