<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsLetter extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
		$this->load->library('form_validation');
        $this->load->model('NewsLetter_Model', 'newsLetter', TRUE);
    }
    public function index()
    {
        $data['get_clients'] = $this->newsLetter->getClients();
        // print_r($data);
        $this->load->view('common/header');
        $this->load->view('news_letter', $data);
        $this->load->view('common/footer');
    }
    public function newsMail($client_id){
        $data['details'] = $this->newsLetter->getClientById($client_id);
        $data['get_client_details'] = $this->newsLetter->getClientTemplateDetails($client_id);
        // echo '<pre>';
        // print_r($data['get_client_details']);
        // echo '</pre>';
        $this->load->view('common/header');
        $this->load->view('mail_letter', $data);
        $this->load->view('common/footer');
    }

   public function DisplayNews($news_details_id){
    // echo $news_details_id;
    $data['news_details'] = $this->newsLetter->getNewsDataById($news_details_id);
    // print_r($data);
    $this->load->view('common/header');
    $this->load->view('news_details', $data);
    $this->load->view('common/footer');
   }

   public function sendMail($client_id){
        $data['details'] = $this->newsLetter->getClientById($client_id);
        $email = $data['details']['email'];
        $data['get_client_details'] = $this->newsLetter->getClientTemplateDetails($client_id);
        // echo '<pre>';
        // print_r($data['get_client_details']);
        // echo '</pre>';
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
        $this->email->from('admin@pressbro.com', 'Test');
        $this->email->to($email);
        $this->email->subject('News');
        $this->email->message($this->load->view('email/send_mail', $data, TRUE));
        $result = $this->email->send();
        if($result){
            $this->session->set_flashdata('success', 'Mail Send Successfully');
            redirect('NewsLetter/newsMail/' . $client_id);
        }
        
   }

   public function sendMailToMultipleClient() {
    $client_ids = $this->input->post('client_id');
    
    $all_client_details = array();
    $emails = array();  
    $all_template_details = array(); 
    foreach ($client_ids as $client_id) {
        $client_details = $this->newsLetter->getClientById($client_id);
        if ($client_details) {
            $all_client_details[] = $client_details;
            $emails[] = $client_details['email'];
            $client_template_details = $this->newsLetter->getClientTemplateDetails($client_details['client_id']);
            if ($client_template_details) {
                $all_template_details[] = $client_template_details;
                $data = array(
                    'details' => $client_details,
                    'get_client_details' => $client_template_details
                );
                $config = array(
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
                $this->email->from('admin@pressbro.com', 'Test');
                $this->email->to($client_details['email']);
                $this->email->subject('News');
                $this->email->message($this->load->view('email/send_mail', $data, TRUE));
                $result = $this->email->send();
                if ($result) {
                    echo "Mail sent successfully to " . $client_details['email'] . "<br>";
                } else {
                    echo "Failed to send mail to " . $client_details['email'] . "<br>";
                }
            } else {
                echo "No template details found for client ID: " . $client_details['client_id'] . "<br>";
            }
        } else {
            echo "No client details found for client ID: " . $client_id . "<br>";
        }
    }
    $this->session->set_flashdata('success', 'Mails processed');
    redirect('NewsLetter');
    }
}
?>