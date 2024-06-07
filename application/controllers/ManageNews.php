<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageNews extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
		$this->load->library('form_validation');
        $this->load->model('Reporter_Model', 'reporter', TRUE);
        $this->load->model('ManageNewsModel', 'manageNews', TRUE);

    }
    public function index()
    {
        $data['getAllNews'] = $this->reporter->getALlNews();
        // print_r($data);
        $data['get_keywords'] = $this->reporter->getAllKeywords();
        
        $data['get_clients'] = $this->reporter->getClients();
        $this->load->view('common/header');
        $this->load->view('admin/manage_news', $data);
        $this->load->view('common/footer');
    }
    public function viewNews(){
        $this->load->view('common/header');
        $this->load->view('view_news');
        $this->load->view('common/footer');
    }

    public function EditNews($news_details_id){
        $data['get_news'] = $this->manageNews->getNews($news_details_id);
        // print_r($data);
        $data['get_clients'] = $this->reporter->getClients();
        $this->load->view('common/header');
        $this->load->view('admin/edit_news', $data);
        $this->load->view('common/footer');
    }
    public function editArticle() {
        // Retrieve data from POST array
        $news_details_id = $this->input->post('news_details_id');
        $index_no = $this->input->post('index');
        $media_type = $this->input->post('media_type');
        $publication = $this->input->post('publication');
        $edition = $this->input->post('edition');
        $supplement_id = $this->input->post('SupplementId');
        $journalist_name = $this->input->post('journalist_name');
        $agency = $this->input->post('agency');
        $news_position = $this->input->post('NewsPosition');
        $news_city = $this->input->post('NewsCity');
        $category = $this->input->post('category'); 
        $headline = $this->input->post('headline');
        $summary = $this->input->post('Summary');
    
        // Initialize arrays for storing keys and clients
        $all_keys = [];
        $all_clients = [];
    
        // Loop through each index to retrieve keys and clients
        for ($i = 1; $i <= $index_no; $i++) {
            $keys = $this->input->post('getKeys' . $i);
            $clients = $this->input->post('getclient' . $i);
    
            // Merge keys and clients arrays
            if (is_array($keys)) {
                $all_keys = array_merge($all_keys, $keys);
            }
            if (is_array($clients)) {
                $all_clients = array_merge($all_clients, $clients);
            }
        }
        // Remove duplicates
        $all_keys = array_unique($all_keys);
        $all_clients = array_unique($all_clients);
    
        // Convert arrays back to strings
        $keys_string = implode(',', $all_keys);
        $clients_string = implode(',', $all_clients);  
        
        // Prepare data array for updating 'news_details' table
        $data = [
            'media_type_id' => $media_type,
            'publication_id' => $publication,
            // 'edition_id' => $edition,
            'supplement_id' => $supplement_id,
            'journalist_id' => $journalist_name,
            'agencies_id' => $agency,
            'news_position' => $news_position,
            'news_city_id' => $news_city,
            'category_id' => $category,
            'head_line' => $headline,
            'Summary' => $summary,
            'keywords' => $keys_string,
            'client_id' => $clients_string,
        ];
        //  print_r($data);
        // Update 'news_details' tabl
        $update_success = $this->reporter->update('news_details','news_details_id',$news_details_id, $data);
        
        if ($update_success) {
            $article_ids = $this->input->post('artical_id'); // Assuming 'artical_id' is the correct key
            $editor_count = count($article_ids);
        
            $page_nos = $this->input->post('page_no'); // Retrieve the array of page numbers
            $updated_records = array();
            for ($i = 0; $i < $editor_count; $i++) {
                $editor = $this->input->post('editor' . ($i + 1));
                $pageNo = $page_nos[$i]; // Accessing each page number sequentially
                $articleId = $article_ids[$i]; // Accessing each article_id sequentially
                $newsArtical = array(
                    'news_artical_id' => $articleId,
                    'news_artical' => $editor,
                    'page_no' => $pageNo,
                );
                // Store the updated record in the array
                $updated_records[] = $newsArtical;
            }
        
            // Update all the records in the database
            foreach ($updated_records as $record) {
                $this->reporter->update('news_artical', 'news_artical_id', $record['news_artical_id'], $record);
            }
            $this->session->set_flashdata('success', 'Your News Is Updated');
            redirect('ManageNews');
        }  
        }
        public function sendMail() {
            $clients = $this->manageNews->getClientDetailsForSending();
            print_r($clients);
    //         foreach ($clients['client_details'] as $client) {
    //             $client_id = $client['client_id'];
    //             $email = $client['email'];
    //             $client_name = $client['client_name'];
    //             $data['news_details'] = $this->manageNews->news($client_id);
    //             $data['client_name'] = $client_name;
    //             foreach ($data['news_details'] as &$news) {
    //                 if (!isset($news['news_article_data'])) {
    //                     $news['news_article_data'] = [];
    //                 }
    //             }
    //             if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //             $config = Array(
    //                 'protocol' => 'smtp',
    //                 'smtp_host' => 'master.herosite.pro',
    //                 '_smtp_auth' => TRUE,
    //                 'smtp_port' => 465,
    //                 'smtp_user' => 'admin@pressbro.com',
    //                 'smtp_pass' => 'Vajra@5566',
    //                 'smtp_crypto' => 'ssl',
    //                 'mailtype' => 'html',
    //                 'charset' => 'utf-8'
    //             );
    //             $this->load->library('email', $config);
    //             $this->email->set_newline("\r\n");
    //             $this->email->set_mailtype("html");
    //             $this->email->from('admin@pressbro.com', 'Test');
    //             $this->email->to($email);
    //             $this->email->subject('News');
    //             $this->email->message($this->load->view('view_news', $data, TRUE));
    //             $result = $this->email->send();

    //             if ($result) {
    //                 // Debugging output
    //                 echo "Email sent to: $email\n";
    //                 foreach ($data['news_details'] as $news) {
    //                     if (isset($news['news_details_id'])) {
    //                         $news_details_id = $news['news_details_id'];
    //                         $this->db->query("UPDATE `news_details` SET `is_send`= ? WHERE `news_details_id`= ?", array(1, $news_details_id));
    //                         echo "Updated news_details_id: $news_details_id\n";
    //                     }
    //                 }
    //             } else {
    //                 echo "Failed to send email to: $email\n";
    //                 echo $this->email->print_debugger();
    //             }
    //     } else {
    //             echo "Invalid email address: $email\n";
    //         }
    // }
    //     $this->session->set_flashdata('success', 'News Sent Successfully');
    // redirect('ManageNews');
   }
        
}
?>