<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageClient extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
        $this->load->model('Client_Model', 'client', TRUE);
    }
    public function index()
    {
        // $data['all_staff'] = $this->staff->getStaffData();
        $this->load->view('common/header2');
        $this->load->view('superAdmin/manage_client');
        $this->load->view('common/footer');
    }
    public function addClient() {
        $client_name = $this->input->post('client_name');
        // $client_password = $this->input->post('client_password');
        // $enc_pass = md5($client_password);
        $is_active = $this->input->post('is_active');
        $Sector = $this->input->post('Sector');
        // $client = $this->input->post('client_select');
        // $e_date = $this->input->post('e_date');
        // $version = $this->input->post('version');
        // $website_url = $this->input->post('website_url');
        // $blank_mail = $this->input->post('blank_mail');
        $Keyword = $this->input->post('Keywords');
    
        $Keywords_string = implode(',', $Keyword);
        $data = [
            'client_name' => $client_name,
            // 'password' => $enc_pass,
            'cilent_status' => $is_active,
            'client_type' => 'Company',
            'sector_id' => $Sector,
            // 'client_type' => $client,
            // 'expiry_date' => $e_date,
            // 'version' => $version,
            // 'website_url' => $website_url,
            // 'blank_mail' => $blank_mail,
            'client_keywords' => $Keywords_string,
        ];
        // print_r($data); 
        $result = $this->db->insert('client', $data);
        // Uncomment the line above if you want to insert data into the database
        if($result){
            $this->session->set_flashdata('success', 'Client added successfully');
            redirect('ManageClient/ClientInfo');
        }
    }   
    
    public function addUsersEmail(){
      // Retrieve posted data
             $client_id = $this->input->post('client_id_1');
            $client_email = $this->input->post('client_email');
            $report_service = $this->input->post('report_service');

            // Retrieve client email data from the database
            $get_client_email = $this->client->getUserEMail($client_email);

            if ($get_client_email) {
                $existing_client_id = $get_client_email['client_id'];
                $email = $get_client_email['email'];
                $clients = $get_client_email['clients'];

                // Merge the new client_id with the existing clients
                $clients_array = explode(',', $clients);
                if (!in_array($client_id, $clients_array)) {
                    $clients_array[] = $client_id;
                }
                $updated_clients = implode(',', $clients_array);

                // Prepare data for updating
                $data = [
                    'email' => $client_email,
                    'client_type' => 'User',
                    'report_service' => $report_service,
                    'clients' => $updated_clients
                ];
                // print_r($data);
                $this->client->update('client', 'client_id', $existing_client_id, $data);      
                // $this->session->set_flashdata('success', 'User Information added successfully');
                // redirect('ManageClient/ClientInfo'); 
        }else{
        
        $min = 100000000000000000; // Minimum value
        $max = 999999999999999999; // Maximum value
        $random_number = rand((int)$min, (int)$max);

        $data = [
            // 'client_id' => $client_id,
            'email' => $client_email,
            'client_type' => 'User',
            'report_service' => $report_service,
            'clients' => $client_id,
            'token' => $random_number
        ];
        // print_r($data);
        $result = $this->db->insert('client', $data);
        if($result){
            // $this->session->set_flashdata('success', 'User Information added successfully');
            // redirect('ManageClient/ClientInfo');
            $insert_id = $this->db->insert_id();
            $token = $this->client->getUserEMailToken($insert_id);
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'master.herosite.pro',
                '_smtp_auth' => TRUE,
                'smtp_port' => 465,
                'smtp_user' => 'admin@pressbro.com',
                'smtp_pass' => 'Vajra@5566',
                'smtp_crypto' => 'ssl',
                'mailtype' => 'html',
                'charset' => 'utf-8'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $this->email->from('admin@pressbro.com', 'Trackify Media');
            $this->email->to($client_email);
            $this->email->subject('Set Your Password!');
            
            $msg="<!DOCTYPE html>
                    <html>
                    <head>
                        <title></title>
                    </head>
                    <body style='border-top: 10px solid #3fa3df;text-align: center; color:#000 !important;'>
                    <div style='text-align: center;padding: 10px; background-color:white;'>
                            <img src='https://pressbro.com/News/assets/img/mediaLogo.png' style='width: 25%;vertical-align:middle'>
                        </div>
                        <div style='background-color: #fff; color:#000 !important; padding: 0% 10%; text-align: center;'>
                            <h1 align='center'>Set  Password</h1>
                            <p style='color: #757272; text-align:'center' >To set your password please click on the below button.</p>
                            <div style='text-align: center;'>
                                <a href='".site_url('ManageClient/setPassword/'.$insert_id.'/'.$data['token'])."'><button style='background-color: #3fa3df;border: 1px solid #3fa3df;color: #fff;padding: 10px;'> Reset Password</button></a>  
                            </div>
                        </div>
                        <p style='color: gray;padding: 10px;'>If you didn't make this request, ignore this email.</p>
                    </body>.
                    </html>";
            $this->email->message($msg);
            
            $results = $this->email->send();
            
            if($results) {
                $this->session->set_flashdata('success','Email is Sent');
            } else {
                $this->session->set_flashdata('error','Email is not sent');
            }
              $this->session->set_flashdata('success', 'User Information added successfully');
            redirect('ManageClient/ClientInfo');
        }
        }
    }
    public function setPassword($users_mails_id, $token)
    {
        $data['token'] = $this->client->checkLoginToken($users_mails_id, $token); 
        $data['token'] = $token;
		$data['client_id'] = $users_mails_id;
        // print_r($users_mails_id);
        $this->load->view('common/user_reset_password', $data);
    }

    public function newPassword()
    {
        $token = $this->input->post('token');
        $client_id = $this->input->post('client_id');
        $password1 = $this->input->post('password1');
        $confirm_password2 = $this->input->post('password2');

        $customer_password = md5($password1);
        $confirm_password = md5($confirm_password2);

        if($customer_password!=$confirm_password)
        {
            $this->session->set_flashdata('error', 'Passwords did not match, Please try again!!!');
            redirect('ManageClient/setPassword/'.$users_mails_id.'/'.$token);
        }
        else
        {
            $data = array(
                'password' => $customer_password,
                'token' => '',
            );
			// print_r($data);
			// echo $login_id;
            $this->client->update('client', 'client_id', $client_id, $data);
            $this->session->set_flashdata('success', 'Password Updated Successfully');
            redirect('ManageClient/ClientInfo');
        }
    }
    public function ClientInfo(){
        $data['get_clients'] = $this->client->getClients();
        $this->load->view('common/header');
        $this->load->view('manage_client', $data);
        $this->load->view('common/footer');
    }
    public function Competitor()
    {
        // $data['all_staff'] = $this->staff->getStaffData();
        $this->load->view('common/header');
        $this->load->view('superAdmin/competitor');
        $this->load->view('common/footer');
    }

    public function addCompetitor(){
        $client_id = $this->input->post('client_id');
        $Competitor_name = $this->input->post('Competitor_name');
        $is_active = $this->input->post('is_active');
        $Keywords = $this->input->post('CompetetorKeywords');
        $Keywords_string = implode(',', $Keywords); // Convert array to string
        $data = [
            'client_id' => $client_id,
            'Competitor_name' => $Competitor_name,
            'is_active' => $is_active,
            'Keywords' => $Keywords_string, // Use the string version here
        ];
        // print_r($data);
        $result = $this->db->insert('competitor', $data);
        
        if($result){
            $this->session->set_flashdata('success', 'Competitor added successfully');
            redirect('ManageClient/ClientInfo');
        }
    }
    
}
?>