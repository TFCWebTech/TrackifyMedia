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
        // print_r($data['details']);
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

   public function getEmail(){
    $client_id = $this->input->post('client_id');
    $client_mails = $this->newsLetter->getEmailsByClientId($client_id);
    // print_r($client_mails);
    echo json_encode($client_mails);
   }

   public function newsupdate(){
    $news_details_id = $this->input->post('news_details_id');
    $client_id = $this->input->post('client_id');
    // // $data['news_details'] = $this->newsLetter->getNewsByNewsDetailsId($news_details_id);
    //     // Retrieve the data using getNewsByNewsDetailsId
    // $news_details = $this->newsLetter->getNewsByNewsDetailsId($news_details_id);

    // // Initialize an empty array to hold the client IDs
    // $client_ids = [];

    // // Check if data is retrieved and if the client_id field exists
    // if (!empty($news_details) && isset($news_details[0]['client_id'])) {
    //     // Extract the client_id field
    //     $client_id_string = $news_details[0]['client_id'];
        
    //     // Split the client_id string into an array using comma as delimiter
    //     $client_ids = explode(',', $client_id_string);
    // }

    // // Remove the specific client_id from the array
    // if (($key = array_search($client_id, $client_ids)) !== false) {
    //     unset($client_ids[$key]);
    // }
    // // Re-index the array to ensure the keys are continuous
    // $client_ids = array_values($client_ids);

    // // Convert the array back to a comma-separated string
    // $client_ids_string = implode(',', $client_ids);

    // // Prepare data for updating the database
    // $data = array(
    //     'client_id' => $client_ids_string,
    // );
    // // Print the array of remaining client IDs for debugging
    // // echo '<pre>';
    // // print_r($data);
    // // echo '</pre>';
    

    // $client_id = $this->input->post('client_id');
    $headline = $this->input->post('headline');
    $summary = $this->input->post('summary');
    $media_type_id = $this->input->post('media_type_id');
    $publication_id = $this->input->post('publication_id');
    $edition_id = $this->input->post('edition_id');
    $supplement_id = $this->input->post('supplement_id');
    $journalist_id = $this->input->post('journalist_id');
    $agencies_id = $this->input->post('agencies_id');
    $author = $this->input->post('author');
    $news_position = $this->input->post('news_position');
    $news_city_id = $this->input->post('news_city_id');
    $category_id = $this->input->post('category_id');
    $is_send = $this->input->post('is_send');
    $keywords = $this->input->post('keywords'); 

    $response = array(
        'news_details_id' => $news_details_id,
        'client_id' => $client_id,
        'summary' => $summary,
        'head_line' => $headline,	
        'media_type_id' => $media_type_id,
        'publication_id' => $publication_id,
        'edition_id' => $edition_id,
        'supplement_id' => $supplement_id,
        'journalist_id' => $journalist_id,
        'agencies_id' => $agencies_id,
        'author' => $author,
        'news_position' => $news_position,
        'news_city_id' => $news_city_id,
        'category_id' => $category_id,
        'is_send' => $is_send,
        'keywords' => $keywords,
    );
    // print_r($response);
    $this->newsLetter->update('news_details', 'news_details_id', $news_details_id, $response);
    $this->session->set_flashdata('success', 'Information updated Successfully');
}


   public function sendMail(){
    
    $clientMails = $this->input->post('clientMails');
        // $data['details'] = $this->newsLetter->getClientById($client_id);
        // $email = $data['details']['email'];
        // $data['get_client_details'] = $this->newsLetter->getClientTemplateDetails($client_id);

        // echo '<pre>';
        // print_r($data['details']);
        // echo '</pre>';
        // $config = Array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'master.herosite.pro',
        //     '_smtp_auth' => TRUE,
        //     'smtp_port' => 465,
        //     'smtp_user' => 'admin@pressbro.com',
        //     'smtp_pass' => 'Vajra@5566',
        //     'smtp_crypto' => 'ssl',
        //     'mailtype' => 'html',
        //     'charset' => 'utf-8'
        // );
        // $this->load->library('email', $config);
        // $this->email->set_newline("\r\n");
        // $this->email->set_mailtype("html");
        // $this->email->from('admin@pressbro.com', 'Test');
        // $this->email->to($email);
        // $this->email->subject('News');
        // $this->email->message($this->load->view('email/send_mail', $data, TRUE));
        // $result = $this->email->send();
        // if($result){
        //     $this->session->set_flashdata('success', 'Mail Send Successfully');
        //     redirect('NewsLetter/newsMail/' . $client_id);
        // }
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

    public function delteNews(){
        $news_details_id = $this->input->post('news_details_id');
        $client_id = $this->input->post('client_id');

        $response = array(
            'news_details_id' => $news_details_id,
            'client_id' => $client_id,
            'is_delete' => 1
        );
        // print_r($response);
        $this->newsLetter->insert('delete_news', $response);
        echo json_encode(array('status' => 'success', 'message' => 'News deleted successfully', 'news_details_id' => $news_details_id));
    }

    public function hideNews(){
        $news_details_id = $this->input->post('news_details_id');
        $client_id = $this->input->post('client_id');

        $response = array(
            'news_details_id' => $news_details_id,
            'client_id' => $client_id,
            'is_hide' => 1
        );
        // print_r($response);
        $this->newsLetter->insert('delete_news', $response);
        echo json_encode(array('status' => 'success', 'message' => 'News deleted successfully', 'news_details_id' => $news_details_id));
    }
}
?>