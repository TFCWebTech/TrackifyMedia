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
        $client_password = $this->input->post('client_password');
        $enc_pass = md5($client_password);
        $is_active = $this->input->post('is_active');
        $Sector = $this->input->post('Sector');
        $client = $this->input->post('client_select');
        $e_date = $this->input->post('e_date');
        $version = $this->input->post('version');
        $website_url = $this->input->post('website_url');
        $blank_mail = $this->input->post('blank_mail');
        $Keyword = $this->input->post('Keywords');
    
        $Keywords_string = implode(',', $Keyword);
        $data = [
            'client_name' => $client_name,
            'password' => $enc_pass,
            'cilent_status' => $is_active,
            'sector_id' => $Sector,
            'client_type' => $client,
            'expiry_date' => $e_date,
            'version' => $version,
            'website_url' => $website_url,
            'blank_mail' => $blank_mail,
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