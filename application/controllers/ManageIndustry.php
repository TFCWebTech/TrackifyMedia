<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageIndustry extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
        $this->load->model('ManageNewsModel', 'news', TRUE);
    }
    public function index()
    {
        $data['get_industry'] = $this->news->industry();
       
        $data['get_clients'] = $this->news->getClients();
        $data['get_compitertors'] = $this->news->getCompitetors();
        //  print_r($data['get_compitertors']);
        $this->load->view('common/header');
        $this->load->view('superAdmin/industry', $data);
        $this->load->view('common/footer');
    }
    
    public function addIndustry(){
            $client_name = $this->input->post('industry_name');
            $is_active = $this->input->post('is_active');
            $client_id = $this->input->post('client_name');
            $client_id_string = implode(',', $client_id);
            $Keywords = $this->input->post('Keywords');
            $Keywords_string = implode(',', $Keywords); // Convert array to string
            $compitertors_names = $this->input->post('compitertors_name');
            $compitertors_names_string = implode(',', $compitertors_names); 
            
            $data = [
                // 'client_id' => $client_id,
                'Industry_name' => $client_name,
                'is_active' => $is_active,
                'client_id' => $client_id_string,
                'Keywords' => $Keywords_string, // Use the string version here
                'competitor_id' => $compitertors_names_string
            ];
            // print_r($data);
            $result = $this->db->insert('industry', $data);
            
            if($result){
                $this->session->set_flashdata('success', 'Industry added successfully');
                redirect('ManageIndustry');
            }
	}


}
?>