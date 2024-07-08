<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageAddRate extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('security');
		$this->load->library('form_validation');
        $this->load->model('AddRate_Model', 'addRate', TRUE);
        $this->load->model('Manage_Admin_Model', 'manageAdmin', TRUE);
    }
    public function index()
    {
        // $data['get_publication'] = $this->staff->getPublication();
        $data['get_media_type'] = $this->manageAdmin->mediatype();
        $data['get_publication'] = $this->manageAdmin->getPublication();
        $data['get_edition'] = $this->manageAdmin->getEdition();
        $data['get_supplements'] = $this->manageAdmin->getsupplements();
        $data['get_add_rate'] = $this->addRate->getAddRate();
        // echo '<pre>';
        // print_r($data['get_add_rate']);
        // echo '</pre>';
        $this->load->view('common/header');
        $this->load->view('Manage_AddRate',$data);
        $this->load->view('common/footer');
    }

    public function addNewRate(){
        $user_id = $this->session->userdata('user_id');
        $get_media_type = $this->input->post('get_media_type');
        $Publication = $this->input->post('Publication');
        $Edtion = $this->input->post('Edtion');
        $Supplements = $this->input->post('Supplements');
        $rate = $this->input->post('rate');
        $new_rate = $this->input->post('new_rate');
        $Number_of_circulation = $this->input->post('Number_of_circulation');
        $Status = $this->input->post('Status');
        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');
        $gidAddRate = bin2hex(random_bytes(40 / 2));
        $data = array(
            'gidAddRate' => $gidAddRate,
            'gidMediaType' => $get_media_type,
            'gidMediaOutlet' => $Publication,
            'gidEdition' => $Edtion,
            'gidSupplement' => $Supplements,
            'Rate' => $rate,
            'NewRate' => $new_rate,
            'Circulation_Fig' => $Number_of_circulation,
            'Status' => $Status,
            'CreatedBy' => $user_id,
            'CreatedOn' => $formatted_date
            );
            // print_r($data);
        $this->addRate->insert('AddRate', $data);
        $this->session->set_flashdata('success', 'Rate Added Successfully.');
        redirect('ManageAddRate');
    }
    
    public function updatedAddRate(){
        $user_id = $this->session->userdata('user_id');
        $gidAddRate_id = $this->input->post('gidAddRate_id');
        $get_media_type = $this->input->post('get_media_type');
        $Publication = $this->input->post('Publication');
        $Edtion = $this->input->post('Edtion');
        $Supplements = $this->input->post('Supplements');
        $rate = $this->input->post('rate');
        $new_rate = $this->input->post('new_rate');
        $Number_of_circulation = $this->input->post('Number_of_circulation');
        $Status = $this->input->post('Status');
        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');

        $data = array(
            'gidMediaType' => $get_media_type,
            'gidMediaOutlet' => $Publication,
            'gidEdition' => $Edtion,
            'gidSupplement' => $Supplements,
            'Rate' => $rate,
            'NewRate' => $new_rate,
            'Circulation_Fig' => $Number_of_circulation,
            'Status' => $Status,
            'CreatedBy' => $user_id,
            'CreatedOn' => $formatted_date
            );
            // print_r($data);
            $this->client->update('AddRate', 'gidAddRate_id', $gidAddRate_id, $data);
        $this->session->set_flashdata('success', 'Rate Updated Successfully.');
        redirect('ManageAddRate');
    }

    public function getPublicaton(){
        $media = $this->input->post('media');
		$get_publication = $this->addRate->getPublication($media);
		?>
		<option value="">Select Publication</option>
		<?php 
		foreach ($get_publication as $value) { ?>
			<option value="<?php echo $value['gidMediaOutlet'] ?>"><?php echo $value['MediaOutlet'] ?></option>
		<?php }
    }

    public function getPublicaton2() {
        $media = $this->input->post('media');
        log_message('debug', 'Received media: ' . $media); // Log received media for debugging
        $get_publication = $this->addRate->getPublication($media);
    
        // Log publication data for debugging
        log_message('debug', 'Publication data: ' . print_r($get_publication, true));
    
        ?>
        <option value="">Select Publication</option>
        <?php 
        foreach ($get_publication as $value) { ?>
            <option value="<?php echo $value['gidMediaOutlet']; ?>"><?php echo $value['MediaOutlet']; ?></option>
        <?php }
    }

    public function getEdition(){
        $publication = $this->input->post('publication');
		$get_edition = $this->addRate->getEdition($publication);
		?>
		<option value="">Select Edition</option>
		<?php 
		foreach ($get_edition as $value) { ?>
			<option value="<?php echo $value['gidEdition'] ?>"><?php echo $value['Edition'] ?></option>
		<?php }
    }
    public function getEdition2(){
        $publication = $this->input->post('publication');
        $get_edition = $this->addRate->getEdition($publication);
        $get_journalist = $this->addRate->getJournalist($publication);
    
        $response = array();
    
        // Prepare edition options
        $edition_options = '<option value="">Select Edition</option>';
        foreach ($get_edition as $value) {
            $edition_options .= '<option value="' . $value['gidEdition'] . '">' . $value['Edition'] . '</option>';
        }
    
        // Prepare journalist options
        $journalist_options = '<option value="">Select</option>';
        foreach ($get_journalist as $value) {
            $journalist_options .= '<option value="' . $value['gidJournalist'] . '">' . $value['Journalist'] . '</option>';
        }
    
        $response['edition_options'] = $edition_options;
        $response['journalist_options'] = $journalist_options;
    
        echo json_encode($response);
    }
    public function getSupplements(){
        $edition = $this->input->post('edition');
		$get_supplements = $this->addRate->getSupplement($edition);
        ?>
		<option value="">Select Supplement</option>
		<?php 
		foreach ($get_supplements as $value) { ?>
			<option value="<?php echo $value['gidSupplement'] ?>"><?php echo $value['Supplement'] ?></option>
		<?php }
    }

    public function findData() {
        $media_type = $this->input->post('media_type');
        $get_data = $this->addRate->getAddRateDataBySearch($media_type);
        echo json_encode($get_data);
    }
}
?>
