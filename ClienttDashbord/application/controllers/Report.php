<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load PhpSpreadsheet manually
require_once APPPATH . 'third_party/Phpspreadsheet.php';
    


class Report extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Login_model', 'login', TRUE);
        $this->load->model('News_data_Model', 'NewsData', TRUE);
        
    }

    public function index(){
        $data['publication_type'] = $this->NewsData->getPublicationTypeData();
        $data['news_city'] = $this->NewsData->getNewsCityData();
        $client_id = $this->session->userdata('client_id');

        $data['details'] = $this->NewsData->getClientById($client_id);
        // Extract clients from the array
        $clientsString = $data['details']['clients'];
       
        $clientIDs = explode(',', $clientsString);
        $data['clients'] = $this->NewsData->getClients($clientIDs);
        $firstClient = $data['clients'][0];
        $firstClientId = $firstClient['client_id'];
        // $firstClientId = 3;
        // Convert the string to an array of client IDs
        $data['get_client_details'] = $this->NewsData->getClientTemplateDetails($firstClientId);
       
        // echo "<pre>";
        // print_r($data['get_client_details']);
        // echo "</pre>";
       
        $this->load->view('common/header');
        $this->load->view('report', $data);
        $this->load->view('common/footer');
        
    }

    // public function downloadPDF() {
    //     // Set headers to indicate JSON response
    //     header('Content-Type: application/json');
        
    //     // Collect necessary POST data
    //     // $select_client = $this->input->post('select_client');
    //     $select_client = 3;
    //     $from_date = $this->input->post('from_date');
    //     $to_date = $this->input->post('to_date');
    //     $publication_type = $this->input->post('publication_type');
    //     $Cities = $this->input->post('Cities');
    
    //     // Fetch data from NewsData model or wherever it's sourced from
    //     $data['details'] = $this->NewsData->getClientById($select_client);
    //     $data['get_client_details'] = $this->NewsData->getClientTemplateDetails2($select_client, $from_date, $to_date, $publication_type, $Cities);
    //     // $this->load->view('dowload_pdf', $data);

    //      // Load the TCPDF library
    //     $this->load->library('tcpdf');
    //     // Create PDF object
    //     $pdf = new TCPDF();

    //     // Set some properties of the PDF
    //     $pdf->SetCreator(PDF_CREATOR);
    //     $pdf->SetTitle('Your PDF Title');

    //     // Load your view into a variable
    //     // $data = array(
    //     //     // Any data you want to pass to the view
    //     // );
    //     // $data['user_data'] = $this->home->getUserProfileData('9');
    //     // $data['all'] = $this->inquiry->generateCertificate('7');
    //     // $html = $this->load->view('certificate_pdf.php', true);

    //     $html = $this->load->view('dowload_pdf.php',$data, true);
        
    //     // Add a page to the PDF
    //     $pdf->AddPage();

    //     // Set font
    //     $pdf->SetFont('times', 'N', 12);

    //     // Add the HTML content to the PDF
    //     $pdf->writeHTML($html, true, false, true, false, '');

    //     // Save the PDF to a folder
    //     $pdfPath = FCPATH . 'dowload_pdf/';
    //     $pdfName = 'dowload_pdf.pdf';
    //     $pdf->Output($pdfPath . $pdfName, 'F');

    //     // Optionally, you can show the PDF in the browser instead of saving it
    //     $pdf->Output($pdfName, 'I');
    // }

    
    public function downloadPDF() {
        // Collect necessary POST data
        $select_client = $this->input->post('select_client'); // Assuming this is passed correctly via AJAX
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $publication_type = $this->input->post('publication_type');
        $Cities = $this->input->post('Cities');
        
        // Fetch data from NewsData model or wherever it's sourced from
        $data['details'] = $this->NewsData->getClientById($select_client);
        $data['get_client_details'] = $this->NewsData->getClientTemplateDetails2($select_client, $from_date, $to_date, $publication_type, $Cities);
        
        // var_dump($data['details']);
        // var_dump($data['get_client_details']);
        // Load TCPDF library
        require_once(APPPATH . 'libraries/tcpdf/tcpdf.php');
        
        // Create PDF object
        $pdf = new TCPDF();
        
        // Set properties of the PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Your PDF Title');
        
        // Load the view file into HTML
        $html = $this->load->view('dowload_pdf', $data, true); // Assuming 'dowload_pdf.php' is your view file
        
        // Add a page to the PDF
        $pdf->AddPage();
        
        // Set font
        $pdf->SetFont('times', 'N', 12);
        
        // Add the HTML content to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        
        // Save the PDF to a folder on the server
        $pdfPath = FCPATH . 'download_pdf/'; // Ensure 'download_pdf' folder exists and is writable
        if (!is_dir($pdfPath)) {
            mkdir($pdfPath, 0777, true); // Create directory if it doesn't exist
        }
        $pdfName = 'downloaded_pdf.pdf'; // Name of the PDF file
        $outputPath = $pdfPath . $pdfName;
        
        // Save PDF to file
        $pdf->Output($outputPath, 'F');
        
        // Prepare response for AJAX
        $response = array(
            'success' => true,
            'pdf_url' => base_url('download_pdf/' . $pdfName) // URL to download the PDF
        );
        
        // Send JSON response back to AJAX request
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    

    public function exportWord() {
        try {
            $client_id = $this->session->userdata('client_id');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $publication_type = $this->input->post('publication_type');
            $Cities = $this->input->post('Cities');
            $client_name = $this->session->userdata('client_name');
    
            // Get report data
            $WordFileData = $this->NewsData->getReportData($client_id, $from_date, $to_date, $publication_type, $Cities);
    
            // Initialize an array to hold all the data, including news articles
            $completeData = array();
    
            // Loop through the report data and get news articles for each news_details_id
            foreach ($WordFileData as $report) {
                $news_details_id = $report['news_details_id'];
                $newsArticles = $this->NewsData->getNewsArticalData($news_details_id);
                $report['news_articles'] = $newsArticles; // Add news articles to the report data
                $completeData[] = $report;
            }
            // Add client name and date range to the response
            $response = array(
                'client_name' => $client_name,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'data' => $completeData
            );
            // Send response as JSON
            header('Content-Type: application/json');
            echo json_encode($response); // Properly output the JSON-encoded response
        } catch (Exception $e) {
            // Handle exceptions
            http_response_code(500); // Internal Server Error
            echo json_encode(array('error' => $e->getMessage()));
        }
    }


}
?>