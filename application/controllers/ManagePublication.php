<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManagePublication extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
		$this->load->library('form_validation');
        $this->load->model('Manage_Admin_Model', 'manangeAdmin', TRUE);
    }

    public function index()
    {
        $data['get_media_type'] = $this->manangeAdmin->mediatype();
        $data['get_publication_type'] = $this->manangeAdmin->getPublicationType();
        
        $data['get_publication_data'] = $this->manangeAdmin->getPublicationData();
        // echo '<pre>';
        // print_r($data['get_publication_data']);
        // echo '</pre>';
        $this->load->view('common/header');
        $this->load->view('admin/manage_publication',$data);
        $this->load->view('common/footer');
    }

    public function addPublication(){
        $user_id = $this->session->userdata('user_id');
        $publiction_name = $this->input->post('publiction_name');
        $get_media_type = $this->input->post('get_media_type');
        $publication_type = $this->input->post('publication_type');
        $tier_type = $this->input->post('tier_type');
        $publication_language = $this->input->post('publication_language');
        $master_head = $this->input->post('master_head');
        $priority = $this->input->post('priority');
        $short_name = $this->input->post('short_name');
        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');
        $gidMediaOutlet = bin2hex(random_bytes(40 / 2));
        $data = array(
            'gidMediaOutlet' => $gidMediaOutlet,
            'MediaOutlet' => $publiction_name,
            'gidMediaType' => $get_media_type,
            'gidPublicationType' => $publication_type,
            'gidTier' => $tier_type,
            'Language' => $publication_language,
            'Masthead' => $master_head,
            'Priority' => $priority,
            'ShortName' => $short_name,
            'CreatedBy' => $user_id,
            'CreatedOn' => $formatted_date
            );
            // print_r($data);
        $this->manangeAdmin->insert('mediaoutlet', $data);
        $this->session->set_flashdata('success', 'Publication Added Successfully.');
        redirect('ManagePublication');

    }

    public function updatedPublication(){
        $user_id = $this->session->userdata('user_id');
        $publiction_name = $this->input->post('publiction_name');
        $get_media_type = $this->input->post('get_media_type');
        $publication_type = $this->input->post('publication_type');
        $tier_type = $this->input->post('tier_type');
        $publication_language = $this->input->post('publication_language');
        $master_head = $this->input->post('master_head');
        $priority = $this->input->post('priority');
        $short_name = $this->input->post('short_name');
        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');
        $gidMediaOutlet_id = $this->input->post('gidMediaOutlet_id');
        
        $data = array(
            'MediaOutlet' => $publiction_name,
            'gidMediaType' => $get_media_type,
            'gidPublicationType' => $publication_type,
            'gidTier' => $tier_type,
            'Language' => $publication_language,
            'Masthead' => $master_head,
            'Priority' => $priority,
            'ShortName' => $short_name,
            'UpdatedBy' => $user_id,
            'UpdatedOn' => $formatted_date
            );
            // print_r($data);
            $this->manangeAdmin->update('mediaoutlet', 'gidMediaOutlet', $gidMediaOutlet_id, $data);
            $this->session->set_flashdata('success', 'Publication Updated Successfully.');
            redirect('ManagePublication');
    }

    // public function addReporter(){
    //     $this->form_validation->set_rules('reporter_name', 'reporter_name', 'trim|required');
	//     $this->form_validation->set_rules('password', 'password', 'trim|required');
	//     $this->form_validation->set_rules('is_active', 'is_active', 'trim|required');
	//     if ($this->form_validation->run() == FALSE) {
	//         // If validation fails for any field, set flash message for the first error encountered
	//         if (form_error('reporter_name')) {
	//             $this->session->set_flashdata('error', 'Invalid reporter name');
	//         } elseif (form_error('password')) {
	//             $this->session->set_flashdata('error', 'Invalid password');
	//         } elseif (form_error('is_active')) {
	//             $this->session->set_flashdata('error', 'Invalid active');
	//         }
	//         // redirect('Reporter');
	//     } else {
	//         $reporter_name = $this->input->post('reporter_name');
	//         $Password = $this->input->post('password');
    //         $enc_pass = md5($Password);
	//         $is_active = $this->input->post('is_active');
	//         $data = array(
	//         	'user_name' => $reporter_name,
	//         	'user_password' => $enc_pass,
	//         	'user_status' => $is_active,
	// 			'user_type' => 'Reporter'
	//         );
	// 			$this->reporter->insert('user', $data);
	// 			$this->session->set_flashdata('success', 'Reporter Added Successfully.');
	//        		redirect('ManageReporter/ReporterInfo');
	//     }
	// }
}
?>