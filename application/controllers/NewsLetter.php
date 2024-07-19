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

        $get_news_data = [
            'get_client_data' => $this->newsLetter->getClientById($client_id),
            'get_news_details' => $this->newsLetter->getNewsDetails($client_id),
            'get_comp_data' => $this->newsLetter->getCompData($client_id),
            'get_industry_data' => $this->newsLetter->getIndustryData($client_id)
        ];
      
        // echo '<pre>';
        // print_r($data['get_client_details']);
        // echo '</pre>';
        // $this->load->view('common/header');
        // $this->load->view('mail_letter', $data);
        // $this->load->view('common/footer');
        if (empty($data['get_client_details'][0]['client_id'])) {
            $this->load->view('common/header');
            $this->load->view('newsLetter_defult_template', $get_news_data);
            $this->load->view('common/footer');
        }else{
            $this->load->view('common/header');
            $this->load->view('mail_letter', $data);
            $this->load->view('common/footer');
        }
        

    }

   public function DisplayNews($news_details_id){
    // echo $news_details_id;
    $data['news_details'] = $this->newsLetter->getNewsDataById($news_details_id);
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    $this->load->view('common/header');
    $this->load->view('news_details', $data);
    $this->load->view('common/footer');
   }

   public function getEmail() {
    $c_id = $this->input->post('client_id');
    // $c_id = 2;
    $get_client_email = $this->newsLetter->getclientsforEmail();
    
    $client_emails = [];
    $client_ids = [];

    foreach ($get_client_email as $client) {
        // Check if the client_id exists in the clients column
        if (!empty($client['clients'])) {
            $clients_array = explode(',', $client['clients']);
            if (in_array($c_id, $clients_array)) {
                $client_emails[] = ['client_email' => $client['email']];
                $client_ids[] = $client['client_id'];
            }
        }
    }

    // Ensure uniqueness if needed
    $client_ids = array_unique($client_ids);

    // Return JSON response
    $response = [
        'emails' => $client_emails,
        'client_id' => $client_ids, // Note this is an array now
        'c_id' => $c_id
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
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
    // $category_id = $this->input->post('category_id');
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
        // 'category_id' => $category_id,
        'is_send' => $is_send,
        'keywords' => $keywords,
    );
    // print_r($response);
    $this->newsLetter->update('news_details', 'news_details_id', $news_details_id, $response);
    $this->session->set_flashdata('success', 'Information updated Successfully');
}

public function sendMail() {
    $client_id = $this->input->post('client_id');
    $index = $this->input->post('index');
    $client_ids = $this->input->post('client_ids');
    
    // Fetch client details and template details once outside the loop if needed
    $data['details'] = $this->newsLetter->getClientById($client_id);
    $data['get_client_details'] = $this->newsLetter->getClientTemplateDetails($client_id);

    // Array to store all news_details_id
    $news_details_ids = [];

    // Check if client details contain 'client_news' and extract 'news_details_id'
    if (!empty($data['get_client_details'][0]['client_news'])) {
        foreach ($data['get_client_details'][0]['client_news'] as $news) {
            if (isset($news['news_details_id'])) {
                $news_details_id = $news['news_details_id'];
                $news_details_ids[] = $news_details_id;
                
                // Prepare data for update
                $update_data = array(
                    'client_id' => $client_ids,
                    'is_send' => '1'
                );
                // Update news_details table
                $this->newsLetter->update('news_details', 'news_details_id', $news_details_id, $update_data);
            }
        }
    }

    $mail_sent = false; // Flag to check if at least one email was successfully sent

    for ($i = 1; $i <= $index; $i++) {
        $clientMails = $this->input->post('clientMails' . $i);

        if ($clientMails) {
            foreach ($clientMails as $email) {
                // Load email library and configure email parameters
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

                // Send email
                if ($this->email->send()) {
                    // Set flag if at least one email is successfully sent
                    $mail_sent = true;
                } else {
                    // Display error message if email sending failed
                    echo $this->email->print_debugger();
                    $this->session->set_flashdata('error', 'Failed to send email.');
                }
            }
        } else {
            echo "No emails found for clientMails" . $i . "<br>";
        }
    }
    if ($mail_sent) {
        $this->session->set_flashdata('success', 'News sent successfully.');
    } else {
        $this->session->set_flashdata('error', 'Failed to send email(s).');
    }
    redirect('NewsLetter/newsMail/' . $client_id);
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