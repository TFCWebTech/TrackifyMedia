<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsUpload extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->model('Reporter_Model', 'reporter', TRUE);
    }
	public function newsUpload()
    {
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token_value'] = $this->security->get_csrf_hash();
		$data['get_clients'] = $this->reporter->getClients();
        $this->load->view('common/header');
		$this->load->view('reporter/reporter_dashbord',$data);
        $this->load->view('common/footer');
    }
    public function index()
    {
		$data['get_keywords'] = $this->reporter->getAllKeywords();
		$data['get_clients'] = $this->reporter->getClients();
        $this->load->view('common/header');
		$this->load->view('reporter/news_upload',$data);
        $this->load->view('common/footer');
    }

	
	public function addArticle() {
		$index_no = $this->input->post('index');
		$media_type = $this->input->post('media_type');
		$publication = $this->input->post('publication');
		$SupplementId = $this->input->post('SupplementId');
		$journalist_name = $this->input->post('journalist_name');
		$agency = $this->input->post('agency');
		$NewsPosition = $this->input->post('NewsPosition');
		$NewsCity = $this->input->post('NewsCity');
		$headline = $this->input->post('headline');
		$Summary = $this->input->post('Summary');
	
		$allKeys = array();
		$allClients = array();
	
		for ($i = 1; $i <= $index_no; $i++) {
			$getKeys = $this->input->post('getKeys' . $i);
			$getclient = $this->input->post('getclient' . $i);
	
			if (is_array($getKeys)) {
				$allKeys = array_merge($allKeys, $getKeys);
			}
			
			if (is_array($getclient)) {
				$allClients = array_merge($allClients, $getclient);
			}
		}
	
		// Remove duplicates
		$allKeys = array_unique($allKeys);
		$allClients = array_unique($allClients);
	
		// Convert arrays back to strings
		$getKeysString = implode(',', $allKeys);
		$getclientsString = implode(',', $allClients);
		// exit();
		$data = array(
			'media_type_id' => $media_type,
			'publication_id' => $publication,
			'supplement_id' => $SupplementId,
			'journalist_id' => $journalist_name,
			'agencies_id' => $agency,
			'news_position' => $NewsPosition,
			'news_city_id' => $NewsCity,
			'head_line' => $headline,
			'Summary' => $Summary,
			'keywords' => $getKeysString,
			'client_id' => $getclientsString,
		);
		// print_r($data);
		$newsDetailsId = $this->reporter->insert('news_details', $data);
		if ($newsDetailsId) {
			for ($i = 1; $i <= $index_no; $i++) {
				 $editor = $this->input->post('editor' . $i);
				 $pageNo = $this->input->post('page_no' . $i);
				 $image_id = $this->input->post('image_id' . $i);
				$newsArtical = array(
					'news_details_id' => $newsDetailsId,
					'news_artical' => $editor,
					'page_no' => $pageNo,
					'artical_images_id' => $image_id,
				);
				$this->reporter->insert('news_artical', $newsArtical);
			}
		}
		$this->session->set_flashdata('success','Your News Is Uploaded');
		redirect('NewsUpload');
	}
	
	public function getClientsFromKeywords() {
		// Get keywords from POST request
		$keywordsToMatch = $this->input->post('keywordData');
	
		// Ensure keywordsToMatch is an array
		if (!is_array($keywordsToMatch)) {
			$keywordsToMatch = explode(',', $keywordsToMatch);
		}
	
		// Normalize keywords to lower case for case-insensitive matching
		$keywordsToMatch = array_map('strtolower', array_map('trim', $keywordsToMatch));
	
		// Fetch client data from the model
		$get_Clients_data = $this->reporter->getClients();
	
		// Array to hold matching clients
		$matchingClients = [];
	
		// Iterate over the client data
		foreach ($get_Clients_data as $client) {
			// Ensure client_keywords is a string before processing
			if (isset($client['client_keywords']) && is_string($client['client_keywords'])) {
				// Get client keywords and normalize them to lower case
				$clientKeywords = array_map('strtolower', array_map('trim', explode(',', $client['client_keywords'])));
	
				// Check for intersection of client keywords and keywords to match
				$matches = array_intersect($clientKeywords, $keywordsToMatch);
	
				// If there is a match, add client to the matching clients array
				if (!empty($matches)) {
					$matchingClients[] = $client['client_id'];
				}
			}
		}
	
		// Join matching client names with a comma
		$clientNamesString = implode(', ', $matchingClients);
		// Print matching client names
		echo $clientNamesString;
	}
		
	public function addClients(){
		$news_details_id = $this->input->post('news_details_id');
		$client_name_ids = $this->input->post('client_name');
		$client_name_id = implode(',', $client_name_ids);
		$data = array(
			'client_id' => $client_name_id,
		);
		// print_r($data);
		$this->reporter->update('news_details', 'news_details_id', $news_details_id, $data);
        $this->session->set_flashdata('success', 'Clients Updated Successfully');
        redirect('ManageNews');
	}

	public function addKeywords() {
		// Retrieve POST data
		echo $news_details_id = $this->input->post('news_details_id'); // Corrected variable name
		$newKeywords = $this->input->post('newKeywords');
		
		// Ensure newKeywords is an array
		if (!is_array($newKeywords)) {
			$newKeywords = explode(',', $newKeywords);
		}
		$newKeywords = array_map('strtolower', array_map('trim', $newKeywords));
	
		// Fetch client data
		$get_Clients_data = $this->reporter->getClients();
	
		$matchingClients = [];
	
		// Iterate over the client data
		foreach ($get_Clients_data as $client) {
			// Ensure client_keywords is a string before processing
			if (isset($client['client_keywords']) && is_string($client['client_keywords'])) {
				// Get client keywords and normalize them to lower case
				$clientKeywords = array_map('strtolower', array_map('trim', explode(',', $client['client_keywords'])));
	
				// Check for intersection of client keywords and keywords to match
				$matches = array_intersect($clientKeywords, $newKeywords);
	
				// If there is a match, add client to the matching clients array
				if (!empty($matches)) {
					$matchingClients[] = $client['client_id'];
				}
			}
		}
	
		// Join matching client names with a comma
		$clientNamesString = implode(', ', $matchingClients);
	
		// Convert newKeywords array to a string
		$newKeywordsString = implode(', ', $newKeywords);
		$data = array(
			'keywords' => $newKeywordsString,
			'client_id' => $clientNamesString,
		);
		// Prepare data array
		$this->reporter->update('news_details', 'news_details_id', $news_details_id, $data);
		$this->session->set_flashdata('success', 'Keywords Updated Successfully');
		redirect('ManageNews');
		
	}
	
	
}
?>