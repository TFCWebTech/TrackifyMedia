<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailTemplate extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        $this->load->model('MailTemplate_Model', 'email', TRUE);
        $this->load->model('Reporter_Model', 'reporter', TRUE);
        $this->load->model('ManageNewsModel', 'manageNews', TRUE);
    }

    public function index()
    {
        // $data['all_staff'] = $this->staff->getStaffData();
        $this->load->view('common/header2');
        $this->load->view('manage_template');
        $this->load->view('common/footer');
    }
    public function CreateTemplate($client_id)
    {
        $data['client_id'] = $client_id;
        $this->load->view('common/header');
        $this->load->view('manage_template', $data);
        $this->load->view('common/footer');
    }
    public function viewNews() {
        // Fetch client details
        $clients_data = $this->manageNews->getClientDetailsForSending();
        foreach ($clients_data as $client) {
            // Debugging: Inspect the structure of $client
            // print_r($client);
            foreach ($client as $clients) {
                            $client_id = $clients['client_id'];
                            $email = $clients['email'];
                            $client_name = $clients['client_name'];
                            $data['news_details'] = $this->manageNews->news($client_id);
                            $data['data'] = $client_name;
                            // print_r($data);
                            foreach ($data['news_details'] as &$news) {
                                if (!isset($news['news_article_data'])) {
                                    $news['news_article_data'] = [];
                                }
                            }
        }
    }
    $this->load->view('view_news', $data);
}
    
        public function addTemplate(){
            $client_id = $this->input->post('client_id');
            $trackify_media = $this->input->post('trackify_media');
            $trackify_link = $this->input->post('trackify_link');
            $menu_bg_color = $this->input->post('menu_bg_color');
            $menu_font_color = $this->input->post('menu_font_color');
            $header_font = $this->input->post('header_font');
            $header_font_size = $this->input->post('header_font_size');
            $row_background = $this->input->post('row_background');
            $row_font_color = $this->input->post('row_font_color');
            $row_font = $this->input->post('row_font');
            $row_font_size = $this->input->post('row_font_size');
            $no_news_text = $this->input->post('no_news_text');
            
            $header_bg_color = $this->input->post('header_bg_color');
            $logo_url = $this->input->post('logo_url');
            $logo_position = $this->input->post('logo_position');
            $title_name = $this->input->post('title_name');
            $font_color = $this->input->post('font_color');
            $font_size = $this->input->post('font_size');
            $content_category = $this->input->post('content_category');
            $content_publication = $this->input->post('content_publication');
            $content_edition = $this->input->post('content_edition');
            $content_news_summary_color = $this->input->post('content_news_summary_color');
            $content_news_summary_color_size = $this->input->post('content_news_summary_color_size');
            $content_headline_color = $this->input->post('content_headline_color');
            $headline_font = $this->input->post('headline_font');
            $headline_font_size = $this->input->post('headline_font_size');
            $media_details = $this->input->post('media_details');
            $media_color = $this->input->post('media_color');
            $media_font = $this->input->post('media_font');
            $media_font_size = $this->input->post('media_font_size'); // not getting
            $context = $this->input->post('context');
            $context_font = $this->input->post('context_font');
            $context_font_size = $this->input->post('context_font_size');
            $footer_bg_color = $this->input->post('footer_bg_color');
            $footer_logo_url = $this->input->post('footer_logo_url');
            $footer_logo_position = $this->input->post('footer_logo_position');
            $footer_title_name = $this->input->post('footer_title_name');
            $footer_font_color = $this->input->post('footer_font_color');
            $footer_font_size = $this->input->post('footer_font_size');
            $data = [
                'client_id' => $client_id,
                // 'media_type_id' => $trackify_media,
                'trackify_link' => $trackify_link,
                'trackify_link_status' => $trackify_media,
                'menu_background_color' => $menu_bg_color,
                'menu_font_color' => $menu_font_color,
                'menu_font' => $header_font,
                'menu_font_size' => $header_font_size,
                'menu_row_background' => $row_background,
                'menu_row_font_color' => $row_font_color,
                'menu_row_font' => $row_font,
                'menu_row_font_Size' => $row_font_size,
                'menu_no_news_text' => $no_news_text,
                'header_background_color' => $header_bg_color,
                'header_logo_url' => $logo_url,
                'logo_position' => $logo_position,
                'header_title_name' => $title_name,
                'header_title_font_color' => $font_color,
                'header_title_font_size' => $font_size,
                'content_category' => $content_category,
                'content_publication' => $content_publication,
                'content_edition' => $content_edition,
                'content_news_summary_color' => $content_news_summary_color,
                'content_news_summary_font_size' => $content_news_summary_color_size,
                'content_headline_color' => $content_headline_color,
                'content_headline_font' => $headline_font,
                'content_headline_font_size' => $headline_font_size,
                'content_media_details' => $media_details,
                'content_media_color' => $media_color,
                'content_media_font' => $media_font,
                'content_media_font_size' => $media_font_size,    
                'content_context' => $context,
                'content_context_font' => $context_font,
                'content_context_font_size' => $context_font_size,
                'footer_background_color' => $footer_bg_color,
                'footer_logo_url' => $footer_logo_url,
                'footer_logo_position' => $footer_logo_position,
                'footer_title_name' => $footer_title_name,
                'footer_title_font_color' => $footer_font_color,
                'footer_title_font_size' => $footer_font_size,
            ];
            $this->db->insert('mail_template', $data);
            $mail_template_id = $this->db->insert_id();
            if ($mail_template_id) {
                $quick_links_name = $this->input->post('quick_links_name');
                $quick_link_url = $this->input->post('quick_link_url');
                $quick_links_position = $this->input->post('quick_links_position');
                $quick_links_data = [];
            
                for ($i = 0; $i < count($quick_links_name); $i++) {
                    $quick_links_data[] = [
                        'mail_template_id' => $mail_template_id,
                        'quick_links_name' => $quick_links_name[$i],
                        'quick_links_url' => $quick_link_url[$i],
                        'quick_links_position' => $quick_links_position[$i]
                    ];
                }
            
                $all_inserted = true;
                foreach ($quick_links_data as $link_data) {
                    if (!$this->db->insert('quick_links', $link_data)) {
                        $all_inserted = false;
                        break;
                    }
                }
                if ($all_inserted) {
                    $this->session->set_flashdata('success', 'Template Added Successfully');
                    redirect('EmailTemplate/CreateTemplate/' . $client_id);
                } else {
                    $this->session->set_flashdata('error', 'Error adding template');
                    redirect('EmailTemplate/CreateTemplate/' . $client_id);
                }
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong');
                redirect('EmailTemplate/CreateTemplate/' . $client_id);
            }
            
        }
}
?>