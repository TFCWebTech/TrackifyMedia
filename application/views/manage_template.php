<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .modal-footer{
        justify-content: flex-start !important; 
        display: block !important;
    }
</style>
<div class="container" >
    <div class="card p-3">

        <form action="<?php echo site_url('EmailTemplate/addTemplate');?>" method="post"> 
            <div class="row">
                    <div class="col-md-12 py-2">
                        <div class="text-center">
                            <h5 class="font-weight-bold text-uppercase text-color">Add Email Tempate</h5>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-12" >
                        <div class="border-with-text" data-heading="Menu Information">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="client_id" value=" <?php echo $client_id; ?>" hidden>
                                            <label class="px-1 font-weight-bold" for="Trackify Link">Trackify Media</label>
                                            <select class="form-control" name="trackify_media">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="menu_bg_color">Trackify Link</label>
                                            <input type="text" class="form-control" name="trackify_link" placeholder="Trackify Link">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="menu_bg_color">Header Background Color</label>
                                            <input type="color" class="form-control" name="menu_bg_color" placeholder="Background Color">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="header_bg_color">Header Font Color</label>
                                            <input type="color" class="form-control" name="menu_font_color" placeholder="Header Font Color">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="menu_bg_color">Header Font </label>
                                            <select name="header_font" class="form-control" id="HTBFont1">
                                                            <option value="1">Select</option>
                                                            <option value="Arial" selected="">Arial</option>
                                                            <option value="Helvetica">Helvetica</option>
                                                            <option value="sans-serif">sans-serif</option>
                                                            <option value="Arial Black">Arial Black</option>
                                                            <option value="Times New Roman">Times New Roman</option>
                                                            <option value="Gadget,sans-serif">Gadget,sans-serif</option>
                                                            <option value="Comic Sans MS">Comic Sans MS</option>
                                                            <option value="cursive">cursive</option>
                                                            <option value="Courier New">Courier New</option>
                                                            <option value="Courier">Courier</option>
                                                            <option value="monospace">monospace</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="serif">serif</option>
                                                            <option value="Impact">Impact</option>
                                                            <option value="Charcoal">Charcoal</option>
                                                            <option value="Lucida Console">Lucida Console</option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
                                                            <option value="Lucida Grande">Lucida Grande</option>
                                                            <option value="Tahoma">Tahoma</option>
                                                            <option value="Geneva">Geneva</option>
                                                            <option value="Verdana">Verdana</option>
                                                        </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="px-1 font-weight-bold" for="menu_bg_color">Header Font Size</label>
                                            <select name="header_font_size" class="form-control" id="HTBFontSize1">
                                                            <option value="">Select</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3" selected="">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                        </select>
                                        </div>
                                       
                                        <div class="col-md-2">
                                            <label class="px-1 font-weight-bold" for="title_name">Row Background </label>
                                            <input type="color" class="form-control" name="row_background " placeholder="Row Background ">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="px-1 font-weight-bold" for="font_color">Row Font Color</label>
                                            <input type="color" class="form-control" name="row_font_color" placeholder="Row Font Color">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="px-1 font-weight-bold" for="header_bg_color">Row Font </label>
                                            <select name="row_font" class="form-control" id="HTBFont1">
                                                            <option value="1">Select</option>
                                                            <option value="Arial" selected="">Arial</option>
                                                            <option value="Helvetica">Helvetica</option>
                                                            <option value="sans-serif">sans-serif</option>
                                                            <option value="Arial Black">Arial Black</option>
                                                            <option value="Times New Roman">Times New Roman</option>
                                                            <option value="Gadget,sans-serif">Gadget,sans-serif</option>
                                                            <option value="Comic Sans MS">Comic Sans MS</option>
                                                            <option value="cursive">cursive</option>
                                                            <option value="Courier New">Courier New</option>
                                                            <option value="Courier">Courier</option>
                                                            <option value="monospace">monospace</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="serif">serif</option>
                                                            <option value="Impact">Impact</option>
                                                            <option value="Charcoal">Charcoal</option>
                                                            <option value="Lucida Console">Lucida Console</option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
                                                            <option value="Lucida Grande">Lucida Grande</option>
                                                            <option value="Tahoma">Tahoma</option>
                                                            <option value="Geneva">Geneva</option>
                                                            <option value="Verdana">Verdana</option>
                                                        </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="px-1 font-weight-bold" for="title_name">Row Font Size</label>
                                            <select name="row_font_size" class="form-control" id="HTBFontSize1">
                                                            <option value="">Select</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3" selected="">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                        </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="px-1 font-weight-bold" for="font_color">No News Text</label>
                                            <select name="no_news_text" class="form-control" id="HTBFontSize1">
                                                            <option value="">Select</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                            </select>
                                        </div>
                                       
                                    </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="border-with-text" data-heading="Quick Links">
                            <div class="quick-links" id="quick-links-container">
                                <div class="row quick-link">
                                    <div class="col-md-12 text-right">
                                    </div>
                                    <div class="col-md-4">  
                                        <label class="px-1 font-weight-bold" for="media_type">Name </label>
                                        <input type="text" class="form-control" name="quick_links_name[]" placeholder="Enter Name ">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="px-1 font-weight-bold" for="media_type">URL </label>
                                        <input type="text" class="form-control" name="quick_link_url[]" placeholder="Enter URL ">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-between">
                                        <label class="px-1 font-weight-bold" for="media_type">Quick links Position  </label>
                                        <a class="fa fa-trash mt-2 remove-quick-link text-danger" style="display: none;"></a>
                                        </div>
                                        
                                        <select  class="form-control" name="quick_links_position[]" id="Quicklink1">
                                            <option value="">Select</option>
                                            <option value="1">Row 1</option>
                                            <option value="2">Row 2</option>
                                            <option value="3">Row 3</option>
                                            <option value="4">Row 4</option>
                                            <option value="5">Row 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <a id="add-more" class="mt-3 p-2">Add More</a>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="border-with-text" data-heading="Header Information">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="header_bg_color">Header Background Color</label>
                                            <input type="color" class="form-control" name="header_bg_color" placeholder="Background Color">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="logo_url">Logo Url</label>
                                            <input type="text" class="form-control" name="logo_url" placeholder="Logo Url">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="logo_position">Logo Position</label>
                                            <select class="form-control" name="logo_position" >
                                                <option value="">Select</option>
                                                <option value="Left">Left</option>
                                                <option value="Right">Right</option>
                                                <option value="Center">Center</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="title_name">Title Name</label>
                                            <input type="text" class="form-control" name="title_name" placeholder="Title Name">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="font_color">Title Font Color</label>
                                            <input type="color" class="form-control" name="font_color" placeholder="Font Color">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="font_color">Title Font Size</label>
                                            <input type="text" class="form-control" name="font_size" placeholder="Font Color">
                                        </div>
                                       
                                    </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3" >
                        <div class="border-with-text" data-heading="Content News">
                            <div class="row">
                                    <div class="col-md-4">
                                            <label class="px-1 font-weight-bold" for="media_type">Category </label>
                                            <select name="content_category"  class="form-control" accesskey="n" onkeyup="validateUserType('?text=' + this.value);">
                                            <option value="0">Select</option>
                                            <option value="111" >111</option>
                                            <option value="After Market MFCSL" >After Market MFCSL</option>
                                            <option value="After Market MFCWL" >After Market MFCWL</option>
                                            <option value="Agri Andreas Stihl" >Agri Andreas Stihl</option>
                                            <option value="Agri Honda Siel Power Products" >Agri Honda Siel Power Products</option>
                                            <option value="Agri KisanKraft" >Agri KisanKraft</option>
                                            <option value="Agriculture INDUSTRY" >Agriculture INDUSTRY</option>
                                            <option value="Airline Air France" >Airline Air France</option>
                                            <option value="Airline Air India" >Airline Air India</option>
                                            <option value="Airline AirAsia" >Airline AirAsia</option>
                                            <option value="Airline Airbus" >Airline Airbus</option>
                                            <option value="Airline Airport Infrastructure" >Airline Airport Infrastructure</option>
                                            <option value="Airline Bengaluru International Airport" >Airline Bengaluru International Airport</option>
                                            <option value="Airline BIAL Transport" >Airline BIAL Transport</option>
                                            <option value="Airline Boeing" >Airline Boeing</option>
                                            </select>
                                    </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type">Publication</label>
                                            <select class="form-control" name="content_publication" >
                                                <option value="">Select</option>
                                                <option value="4Ps">4Ps</option>
                                                <option value="50 Fashion Brand Icons">50 Fashion Brand Icons</option>
                                                <option value="Aag">Aag</option>
                                                <option value="Abraxas Lifestyle Magazine">Abraxas Lifestyle Magazine</option>
                                                <option value="Acaai News">Acaai News</option>
                                                <option value="Accommodation Times">Accommodation Times</option>
                                                <option value="ACE">ACE</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="px-1 font-weight-bold" for="media_type">Edition</label>
                                            <select class="form-control" name="content_edition" >
                                                <option value="">Select</option>
                                                <option value="National">National</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="author">News Summary Color</label>
                                            <input type="color" class="form-control" placeholder="Enter Summary Color" name="content_news_summary_color">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type">News Summary Font Size</label>
                                            <input type="text" class="form-control" placeholder="Enter Font Size" name="content_news_summary_color_size">
                                        </div>

                                       
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type">Headline Color </label>
                                            <input type="color" class="form-control" placeholder="Enter Headline Color" name="content_headline_color">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type">Headline Font </label>
                                            <select name="headline_font" class="form-control" id="MediaFont1">
                                                            <option value="1">Select</option>
                                                            <option value="Arial">Arial</option>
                                                            <option value="Helvetica">Helvetica</option>
                                                            <option value="sans-serif">sans-serif</option>
                                                            <option value="Arial Black">Arial Black</option>
                                                            <option value="Times New Roman">Times New Roman</option>
                                                            <option value="Gadget,sans-serif">Gadget,sans-serif</option>
                                                            <option value="Comic Sans MS">Comic Sans MS</option>
                                                            <option value="cursive">cursive</option>
                                                            <option value="Courier New">Courier New</option>
                                                            <option value="Courier">Courier</option>
                                                            <option value="monospace">monospace</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="serif">serif</option>
                                                            <option value="Impact">Impact</option>
                                                            <option value="Charcoal">Charcoal</option>
                                                            <option value="Lucida Console">Lucida Console</option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
                                                            <option value="Lucida Grande">Lucida Grande</option>
                                                            <option value="Tahoma">Tahoma</option>
                                                            <option value="Geneva">Geneva</option>
                                                            <option value="Verdana">Verdana</option>
                                                        </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type">Headline Font Size </label>
                                            <input type="text" class="form-control" placeholder="Enter Font Size " name="headline_font_size">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type">Media Details </label>
                                            <select name="media_details"  class="form-control" accesskey="n" onkeyup="validateUserType('?text=' + this.value);">
                                            <option value="0">Select</option>
                                            <option value="Yes" >Yes</option>
                                            <option value="No" >No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type">Media Color </label>
                                            <input type="color" class="form-control" placeholder="Enter Media Color" name="media_color">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="Time">Media Font  </label>
                                            <select name="media_font" class="form-control" id="MediaFont1">
                                                            <option value="1">Select</option>
                                                            <option value="Arial">Arial</option>
                                                            <option value="Helvetica">Helvetica</option>
                                                            <option value="sans-serif">sans-serif</option>
                                                            <option value="Arial Black">Arial Black</option>
                                                            <option value="Times New Roman">Times New Roman</option>
                                                            <option value="Gadget,sans-serif">Gadget,sans-serif</option>
                                                            <option value="Comic Sans MS">Comic Sans MS</option>
                                                            <option value="cursive">cursive</option>
                                                            <option value="Courier New">Courier New</option>
                                                            <option value="Courier">Courier</option>
                                                            <option value="monospace">monospace</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="serif">serif</option>
                                                            <option value="Impact">Impact</option>
                                                            <option value="Charcoal">Charcoal</option>
                                                            <option value="Lucida Console">Lucida Console</option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
                                                            <option value="Lucida Grande">Lucida Grande</option>
                                                            <option value="Tahoma">Tahoma</option>
                                                            <option value="Geneva">Geneva</option>
                                                            <option value="Verdana">Verdana</option>
                                                        </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="Duration">Media Font Size</label>
                                            <input type="text" class="form-control" placeholder="Enter Font Size" name="media_font_size">
                                        </div>
                                    

                                        <div class="col-md-4">
                                            <label class="px-1 font-weight-bold" for="media_type">Context  </label>
                                            <select name="context"  class="form-control" accesskey="n" onkeyup="validateUserType('?text=' + this.value);">
                                            <option value="0">Select</option>
                                            <option value="Yes" >Yes</option>
                                            <option value="No" >No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="Time">Context Font</label>
                                            <select name="context_font" class="form-control" id="MediaFont1">
                                                            <option value="1">Select</option>
                                                            <option value="Arial">Arial</option>
                                                            <option value="Helvetica">Helvetica</option>
                                                            <option value="sans-serif">sans-serif</option>
                                                            <option value="Arial Black">Arial Black</option>
                                                            <option value="Times New Roman">Times New Roman</option>
                                                            <option value="Gadget,sans-serif">Gadget,sans-serif</option>
                                                            <option value="Comic Sans MS">Comic Sans MS</option>
                                                            <option value="cursive">cursive</option>
                                                            <option value="Courier New">Courier New</option>
                                                            <option value="Courier">Courier</option>
                                                            <option value="monospace">monospace</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="serif">serif</option>
                                                            <option value="Impact">Impact</option>
                                                            <option value="Charcoal">Charcoal</option>
                                                            <option value="Lucida Console">Lucida Console</option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
                                                            <option value="Lucida Grande">Lucida Grande</option>
                                                            <option value="Tahoma">Tahoma</option>
                                                            <option value="Geneva">Geneva</option>
                                                            <option value="Verdana">Verdana</option>
                                                        </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="Duration">Context Font Size</label>
                                            <input type="text" class="form-control" placeholder="Context Font Size" name="context_font_size">
                                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="border-with-text" data-heading="Footer Information">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="footer_bg_color">Footer Background Color</label>
                                            <input type="color" class="form-control" name="footer_bg_color" placeholder="Background Color">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="logo_url">Logo Url</label>
                                            <input type="text" class="form-control" name="footer_logo_url" placeholder="Logo Url">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="logo_position">Logo Position</label>
                                            <select class="form-control" name="footer_logo_position" >
                                                <option value="">Select</option>
                                                <option value="Left">Left</option>
                                                <option value="Right">Right</option>
                                                <option value="Center">Center</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="title_name">Title Name</label>
                                            <input type="text" class="form-control" name="footer_title_name" placeholder="Title Name">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="font_color">Title Font Color</label>
                                            <input type="color" class="form-control" name="footer_font_color" placeholder="Font Color">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="font_color">Title Font Size</label>
                                            <input type="text" class="form-control" name="footer_font_size" placeholder="Font size">
                                        </div>
                                    </div>
                         </div>
                    </div>

                    <div class="col-md-12 text-right px-4 py-2">
                        <!-- <a  class="btn btn-success" data-toggle="modal" data-target="#tatamoters">Preview</a> -->
                        <button  class="btn btn-primary">Save Page</button>
                    </div>
        </form>
    </div>
</div>          
</div>

<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

 <script type="text/javascript">
   CKEDITOR.replace( 'editor1' );
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
   
   $(document).ready(function() {
    $('#image_upload').on('change', function() {
        const file = this.files[0];
        const formData = new FormData();
        formData.append('image_upload', file); // Correct key name

        // Get CSRF token from meta tag
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Send AJAX request to store the image
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Reporter/saveArticalImage')?>",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
            },
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                // Get the image URI from the parsed response
                var imageUri = jsonResponse.image_uri.replace(/\\/g, ''); // Remove backslashes
                // var imageUri = response;
                console.log("Image URI:", imageUri);
                imageToText(imageUri);
            }
        });
    });
});
// imageToText(imageUri);
function imageToText(imageUri) {
    $.ajax({
        url: 'https://vision.googleapis.com/v1/images:annotate?key=AIzaSyBYb7FLN__svPKZUbaOeoV4kxZrNoxehLw', 
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            "requests": [
                {
                    "image": {
                        "source": {
                            "imageUri": imageUri
                        }
                    },
                    "features": [
                        {
                            "type": "TEXT_DETECTION"
                        }
                    ]
                }
            ]
        }),
        success: function(response) {
            // Handle success
            var description = response.responses[0].textAnnotations[0].description;
            console.log(description);

            // Get the CKEditor instance by ID
            var editor = CKEDITOR.instances.text_convert;

            if (editor) {
                // Set the content of the CKEditor instance
                editor.setData(description);
            } else {
                console.error('CKEditor instance not found.');
            }
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error(error);
        }
    });
}
</script>

<!-- The Modal -->
<div class="modal" id="tatamoters">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:#f5f9ff;">

      <!-- Modal Header -->
      <div class="modal-header " style="background-color:#0a0a5f;">
        <h4 class="modal-title text-light">TATA Moters</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <h4 class="text-primary">Wind energy surpasses gas in electricity generation</h4>
            <p>In a first for the European Union (EU), wind energy has surpassed gas, with more of it being used to generate energy in 2023.
               In a win for the renewable energy sector, wind energy produced 18 percent of the electricity generated last year, compared with 17% for gas. Combined with solar energy, the two renewable sources created 27% of the EU’s electricity, which is the first time it has ever generated more than a quarter. This is an increase from 2022, where wind energy generated 13% of all electricity. “The EU’s power sector is in the middle of a monumental shift,” says Sarah Brown, Ember’s Europe programme director. “Fossil fuels are playing a smaller role than ever as a system with wind and solar as its backbone comes into view.”
               This is great news for the EU, as they battle to cut their greenhouse gas usage by 90% by 2040.
                Some countries are leading the way in renewable wind power. With 58% of its electricity coming from turbines, Denmark’s wind production exceeds any other OEDC (Organisation for Economic Co-operation and Development) country per capita.</p>
      </div>
        <div class="modal-footer text-start" style="background-color:#0a0a5f;">
             <h6 class="text-white">SOCIAL MEDIA</h6> 
             <div >
                <i class="fa fa-facebook text-white"></i> &nbsp;
                <i class="fa fa-instagram text-white"></i> &nbsp;
                <i class="fa fa-linkedin text-white"></i> &nbsp;
                <i class="fa fa-youtube-play text-white"></i>
             </div>
        </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#add-more').click(function(){
            var newQuickLink = $('.quick-link').first().clone();
            newQuickLink.find('input').val('');
            newQuickLink.find('select').val('');
            newQuickLink.find('.remove-quick-link').show(); 
            $('#quick-links-container').append(newQuickLink);
        });

        $(document).on('click', '.remove-quick-link', function(){
            $(this).closest('.quick-link').remove();
        });
    });
</script>