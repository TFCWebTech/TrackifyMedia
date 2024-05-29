<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporter extends CI_Controller {
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
        $this->load->view('common/header');
        $this->load->view('report_upload'); 
        $this->load->view('common/footer');
    }

	public function saveArticalImage() {
		$this->load->helper('url');
		$target_dir = $this->config->item('PicDir');
		$response = array();
	
		if (!empty($_FILES['image_upload']['name'][0])) { // Check if files are present
			$image_data = array(); // Array to store image URLs and IDs
	
			foreach ($_FILES['image_upload']['tmp_name'] as $key => $tmp_name) {
				$file_name = $_FILES['image_upload']['name'][$key];
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
				$mtime = uniqid(microtime(), true);
				$uniqueid = substr(md5($mtime), 0, 8);
				$image_upload = 'image_upload_' . $uniqueid . '.' . $ext;
				$target_file = $target_dir . 'Uploads/' . $image_upload;
	
				if (move_uploaded_file($_FILES['image_upload']['tmp_name'][$key], $target_file)) {
					// Insert image name into database
					$this->db->insert('artical_images', array('artical_images_name' => $image_upload));
					$article_images_id = $this->db->insert_id();
	
					$image_data[] = array(
						'image_url' => base_url() . 'Uploads/' . $image_upload,
						'article_images_id' => $article_images_id
					);
				}
			}
	
			if (!empty($image_data)) {
				$response['success'] = true;
				$response['image_data'] = $image_data; // Include image URLs and IDs in the response
			} else {
				$response['success'] = false;
				$response['error'] = 'Failed to upload files';
			}
		} else {
			$response['success'] = false;
			$response['error'] = 'No files uploaded';
		}
	
		header('Content-Type: application/json');
		echo json_encode($response);
	}

		public function searchKeywords() {
			$description = $this->input->post('description');
			// Get the keywords from your model
			$find_keywords = $this->reporter->getKeywords();
			// Check if any of the description words match the keywords
			$matched_keywords = array();
			foreach ($find_keywords as $keyword) {
				$keyword = trim($keyword); // Trim each individual keyword
				if (stripos($description, $keyword) !== false) { // Case-insensitive comparison
					// If the keyword is found in the description, add it to the matched keywords array
					$matched_keywords[] = $keyword;
				}
			}
			// Send the matched keywords back via AJAX
			echo json_encode($matched_keywords);
		}

		public function EditReporter(){
			$user_id = $this->session->userdata('user_id');
			$data['user_data'] = $this->reporter->getUserData($user_id); 
			$this->load->view('common/header');
			$this->load->view('reporter/manage_accound', $data); 
			$this->load->view('common/footer');
		}

		public function editReporterPassword(){
			$user_id = $this->input->post('user_id');
			$password = $this->input->post('password');
			$hashed_password = md5($password);
				$data = array(
					'user_password' => $hashed_password,
				);
			$this->reporter->update('user', 'user_id', $user_id, $data);
			$this->session->set_flashdata('success', 'Password Updated Successfully');
			redirect('Reporter/EditReporter');
		}

		public function editInfo(){
			// $user_id = $this->input->post();
			$user_id = $this->input->post('userId');
			$user_name = $this->input->post('user_name');
			$user_mail = $this->input->post('user_mail');

			$data = array(
	        	'user_name' => $user_name,
	        	'user_email' => $user_mail,
	        );
			$this->reporter->update('user', 'user_id', $user_id, $data);
			$this->session->set_flashdata('success', 'User Information Updated Successfully');
			redirect('Reporter/EditReporter');
		}

    	public function addArtical(){
			$this->form_validation->set_rules('media_type', 'media_type', 'trim|required');
			$this->form_validation->set_rules('publication', 'publication', 'trim|required');
			$this->form_validation->set_rules('edition', 'edition', 'trim|required');
			$this->form_validation->set_rules('SupplementId', 'SupplementId', 'trim|required');
			$this->form_validation->set_rules('publication_date', 'publication_date', 'trim|required');
			$this->form_validation->set_rules('journalist_name', 'journalist_name', 'trim|required');
			$this->form_validation->set_rules('journalist_email', 'journalist_email', 'trim|required');
			$this->form_validation->set_rules('author', 'author', 'trim|required');
			$this->form_validation->set_rules('page_no', 'page_no', 'trim|required');
			$this->form_validation->set_rules('width', 'width', 'trim|required');
			$this->form_validation->set_rules('Height', 'Height', 'trim|required');
			$this->form_validation->set_rules('AgencyId', 'AgencyId', 'trim|required');
			$this->form_validation->set_rules('NewsPositionId', 'NewsPositionId', 'trim|required');
			$this->form_validation->set_rules('NewsCityID', 'NewsCityID', 'trim|required');
			$this->form_validation->set_rules('category', 'category', 'trim|required');
			// $this->form_validation->set_rules('current_time', 'current_time', 'trim|required');
			$this->form_validation->set_rules('Duration', 'Duration', 'trim|required');
			// $this->form_validation->set_rules('headline', 'headline', 'trim|required');
			// $this->form_validation->set_rules('Summary', 'Summary', 'trim|required');
			// Run overall form validation
			if ($this->form_validation->run() == FALSE) {
				// If validation fails for any field, set flash message for the first error encountered
				if (form_error('media_type')) {
					$this->session->set_flashdata('error', 'Invalid Media Type');
				} elseif (form_error('publication')) {
					$this->session->set_flashdata('error', 'Invalid Publication');
				} elseif (form_error('edition')) {
					$this->session->set_flashdata('error', 'Invalid Edition');
				}elseif (form_error('SupplementId')) {
					$this->session->set_flashdata('error', 'Invalid Supplement');
				}elseif (form_error('publication_date')) {
					$this->session->set_flashdata('error', 'Invalid Publication Date');
				}elseif (form_error('journalist_name')) {
					$this->session->set_flashdata('error', 'Invalid Journalist Name');
				}elseif (form_error('journalist_email')) {
					$this->session->set_flashdata('error', 'Invalid Journalist Email');
				}elseif (form_error('author')) {
					$this->session->set_flashdata('error', 'Invalid Author ');
				}elseif (form_error('page_no')) {
					$this->session->set_flashdata('error', 'Invalid Page No');
				}elseif (form_error('width')) {
					$this->session->set_flashdata('error', 'Invalid width');
				}elseif (form_error('Height')) {
					$this->session->set_flashdata('error', 'Invalid Height');
				}elseif (form_error('AgencyId')) {
					$this->session->set_flashdata('error', 'Invalid Agency ');
				}elseif (form_error('NewsPositionId')) {
					$this->session->set_flashdata('error', 'Invalid News Position');
				}elseif (form_error('NewsCityID')) {
					$this->session->set_flashdata('error', 'Invalid News City ');
				}elseif (form_error('category')) {
					$this->session->set_flashdata('error', 'Invalid Category');
				// }elseif (form_error('current_time')) {
				//     $this->session->set_flashdata('error', 'Invalid current time');
				}elseif (form_error('Duration')) {
					$this->session->set_flashdata('error', 'Invalid Duration');
				}
				// redirect('Reporter');
			} else {
				// Validation passed, process the form submission
				$media_type = $this->input->post('media_type');
				$publication = $this->input->post('publication');
				$edition = $this->input->post('edition');
				$SupplementId = $this->input->post('SupplementId');
				$publication_date = $this->input->post('publication_date');
				$journalist_name = $this->input->post('journalist_name');
				$journalist_email = $this->input->post('journalist_email');
				$author = $this->input->post('author');
				$page_no = $this->input->post('page_no');
				$width = $this->input->post('width');
				$Height = $this->input->post('Height');
				$AgencyId = $this->input->post('AgencyId');
				$NewsPositionId = $this->input->post('NewsPositionId');
				$NewsCityID = $this->input->post('NewsCityID');
				$category = $this->input->post('category');
				$current_time = $this->input->post('current_time');
				$Duration = $this->input->post('Duration');
				$headline = $this->input->post('headline');
				$Summary = $this->input->post('Summary');
				$data = array(
					'media_type' => $media_type,
					'publication' => $publication,
					'edition' => $edition,
					'supplement' => $SupplementId,	
					'publication_date' => $publication_date,
					'journalist_name' => $journalist_name,
					'journalist_email' => $journalist_email,
					'author' => $author,
					'page_no' => $page_no,
					'width' => $width,
					'height' => $Height,
					'Agency' => $AgencyId,
					'news_position' => $NewsPositionId,
					'news_city' => $NewsCityID,
					'category' => $category,
					'time' => $current_time,
					'duration' => $Duration,
					'headline' => $headline,
					'summary' => $Summary
				);
					print_r($data);
					// $this->reporter->insert('reporter', $data);
					// $this->session->set_flashdata('success', 'Artical Added Successfully.');
					// redirect('Reporter');
			}
		}
     // $this->content->insert('contact_us', $data);
	        // $this->session->set_flashdata('success', 'Your message has been sent. Thank you!');
	        // redirect('Home');
    public function OldReporter(){
        $this->load->view('common/header');
        $this->load->view('report_upload');
        $this->load->view('common/footer');
    }




}
?>