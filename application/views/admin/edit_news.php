<head>
<meta name="csrf-token" content="<?php echo $this->security->get_csrf_hash(); ?>">
<style>
.files input {
    outline: 2px dashed #92b0b3;
    outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear;
    padding: 18px 0px 60px 5%;
    text-align: center !important;
    margin: 0;
    width: 100% !important;
}
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
 }
.files{ position:relative}
.files:after {  pointer-events: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 50px;
    right: 0;
    content: "";
    background-image: url('https://image.flaticon.com/icons/png/128/109/109612.png');
    display: block;
    margin: 0 auto;
    background-size: 100%;
    background-repeat: no-repeat;
}
.color input{ background-color:#f1f1f1;}
.files:before {
    position: absolute;
    bottom: 10px;
    pointer-events: none;
    width: 100%;
    content: " or drag it here. ";
    display: block;
    margin: 0 20px;
    color: #2ea591;
    font-weight: 600;
    text-transform: capitalize;
}
</style>
</head>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="container" >
    <div class="card p-3">
        <?php foreach($get_news as $news){?>
        <!-- <form id="articleForm"  method="post">  -->
        <form action="<?php echo base_url('ManageNews/editArticle')?>" method="post">
            <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h5 class="font-weight-bold text-uppercase text-color">Edit News</h5>
                        </div>  
                        <hr>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="border-with-text" data-heading="Article Editing">
                            <div class="row">
                            <input type="text" name="news_details_id" value="<?php echo $news['news_details_id']; ?>" hidden>
                            <?php 
                                $id_counter = 0;
                                foreach ($news['news_article_data'] as $article_data) {
                                    foreach ($article_data['articles'] as $article) {
                                        $id_counter++;
                                        ?>
                                       <div class="col-md-6">
                                            <div class="row">
                                                <input type="text" name="index" value="<?php echo $id_counter; ?>" hidden>
                                                <div class="col-md-12">
                                                    <input type="text" name="artical_id[]" value="<?php echo $article['news_artical_id'];?>" hidden>
                                                    <textarea class="form-control" name="editor<?php echo $id_counter; ?>" id="editor<?php echo $id_counter; ?>" oninput="getKeywords('<?php echo $id_counter; ?>')"><?php echo htmlspecialchars($article['news_artical']); ?></textarea>
                                                </div>
                                                <div class="col-md-12 mt-1" id="keyword_container_<?php echo $id_counter; ?>">
                                                </div>
                                                <div class="col-md-12 mt-1" id="client_container_<?php echo $id_counter; ?>">
                                                </div>
                                                <div class="col-md-6 mt-1">
                                                    <label for="">Page No</label>
                                                    <input type="text" class="form-control" name="page_no[]" id="page_no" value="<?php echo $article['page_no']; ?>" placeholder="Enter Page No">
                                                </div>
                                            </div>
                                        </div>
                                <?php 
                                    } 
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 py-2 mt-3" >
                        <div class="border-with-text" data-heading="Media Information">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type">Media Type </label>
                                            <select class="form-control" name="media_type" id="media_type" >
                                            <option value="">Select</option>
                                                <option value="Magazine" <?php echo ($news['media_type_id'] == 'Magazine') ? 'selected' : ''; ?>>Magazine</option>
                                                <option value="NewsPaper" <?php echo ($news['media_type_id'] == 'NewsPaper') ? 'selected' : ''; ?>>NewsPaper</option>
                                                <option value="Online" <?php echo ($news['media_type_id'] == 'Online') ? 'selected' : ''; ?>>Online</option>
                                                <option value="RSS" <?php echo ($news['media_type_id'] == 'RSS') ? 'selected' : ''; ?>>RSS</option>
                                                <option value="TV" <?php echo ($news['media_type_id'] == 'TV') ? 'selected' : ''; ?>>TV</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="publication">Publication</label>
                                            <select class="form-control" name="publication" id="publication">
                                                <option value="">Select</option>
                                                <option value="4Ps" <?php echo ($news['publication_id'] == '4Ps') ? 'selected' : ''; ?>>4Ps</option>
                                                <option value="50 Fashion Brand Icons" <?php echo ($news['publication_id'] == '50 Fashion Brand Icons') ? 'selected' : ''; ?>>50 Fashion Brand Icons</option>
                                                <option value="Aag" <?php echo ($news['publication_id'] == 'Aag') ? 'selected' : ''; ?>>Aag</option>
                                                <option value="Abraxas Lifestyle Magazine" <?php echo ($news['publication_id'] == 'Abraxas Lifestyle Magazine') ? 'selected' : ''; ?>>Abraxas Lifestyle Magazine</option>
                                                <option value="Acaai News" <?php echo ($news['publication_id'] == 'Acaai News') ? 'selected' : ''; ?>>Acaai News</option>
                                                <option value="Accommodation Times" <?php echo ($news['publication_id'] == 'Accommodation Times') ? 'selected' : ''; ?>>Accommodation Times</option>
                                                <option value="ACE" <?php echo ($news['publication_id'] == 'ACE') ? 'selected' : ''; ?>>ACE</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="edition">Edition</label>
                                            <select class="form-control" name="edition" id="edition">
                                                <option value="">Select</option>
                                                <option value="National" <?php echo ($news['publication_id'] == '4Ps') ? 'selected' : ''; ?>>National</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="SupplementId">Supplement</label>
                                            <select  class="form-control" name="SupplementId" id="SupplementId" accesskey="s">
                                                <option value="">Select</option>
                                                <option value="A Celebration Of Life" <?php echo ($news['supplement_id'] == 'A Celebration Of Life') ? 'selected' : ''; ?>> A Celebration Of Life </option>
                                                <option value="Baja Saeindia" <?php echo ($news['supplement_id'] == 'Baja Saeindia') ? 'selected' : ''; ?>> Baja Saeindia </option>
                                                <option value="bangaloreplus" <?php echo ($news['supplement_id'] == 'bangaloreplus') ? 'selected' : ''; ?>> bangaloreplus </option>
                                                <option value="Bankers Trust" <?php echo ($news['supplement_id'] == 'Bankers Trust') ? 'selected' : ''; ?>> Bankers Trust </option>
                                                <option value="Banking annual" <?php echo ($news['supplement_id'] == 'Banking annual') ? 'selected' : ''; ?>> Banking annual </option>
                                                <option value="Banking Technology" <?php echo ($news['supplement_id'] == 'Banking Technology') ? 'selected' : ''; ?>> Banking Technology </option>
                                                <option value="Banking Technology Award 2015" <?php echo ($news['supplement_id'] == 'Banking Technology Award 2015') ? 'selected' : ''; ?>> Banking Technology Award 2015 </option>
                                                <option value="BENGAL Towards Economic Resurgence" <?php echo ($news['supplement_id'] == 'BENGAL Towards Economic Resurgence') ? 'selected' : ''; ?>> BENGAL Towards Economic Resurgence  </option>
                                                <option value="Bhubaneswar" <?php echo ($news['supplement_id'] == 'Bhubaneswar') ? 'selected' : ''; ?>> Bhubaneswar </option>
                                                <option value="Big Bike Guide" <?php echo ($news['supplement_id'] == 'Big Bike Guide') ? 'selected' : ''; ?>> Big Bike Guide </option>
                                                <option value="bizjournal.com" <?php echo ($news['supplement_id'] == 'bizjournal.com') ? 'selected' : ''; ?>> bizjournal.com </option>
                                                <option value="Blink" <?php echo ($news['supplement_id'] == 'Blink') ? 'selected' : ''; ?>> Blink </option>
                                                <option value="Brands in the ascendance" <?php echo ($news['supplement_id'] == 'Brands in the ascendance') ? 'selected' : ''; ?>> Brands in the ascendance  </option>
                                                <option value="BS1000 Annual" <?php echo ($news['supplement_id'] == 'BS1000 Annual') ? 'selected' : ''; ?>> BS1000 Annual </option>
                                                <option value="Business Day" <?php echo ($news['supplement_id'] == 'Business Day') ? 'selected' : ''; ?>> Business Day </option>
                                                <option value="Celebrating a second life" <?php echo ($news['supplement_id'] == 'Celebrating a second life') ? 'selected' : ''; ?>> Celebrating a second life </option>
                                                <option value="Chandigarh Spokesman" <?php echo ($news['supplement_id'] == 'Chandigarh Spokesman') ? 'selected' : ''; ?>> Chandigarh Spokesman </option>
                                            </select>
                                        </div>  
                                        <!-- <div class="col-md-2">
                                            <label class="px-1 font-weight-bold" for="publication_date">Publication Date</label>
                                            <input type="date" class="form-control" name="publication_date" id="publication_date">
                                        </div> -->
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12 mt-3" >
                        <div class="border-with-text" data-heading="Journalist Information">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="px-1 font-weight-bold" name="journalist_name" for="journalist_name">Journalist Name / News Agencies</label>
                                            <select class="form-control" name="journalist_name" id="journalist_name">
                                            <option value="">Select</option>
                                            <optgroup label="News Agencies">
                                                <option value="Agencies" <?php echo ($news['journalist_id'] == 'Agencies') ? 'selected' : ''; ?>>Agencies</option>
                                                <option value="Associated Press" <?php echo ($news['journalist_id'] == 'Associated Press') ? 'selected' : ''; ?>>Associated Press</option>
                                                <option value="Bloomberg" <?php echo ($news['journalist_id'] == 'Bloomberg ') ? 'selected' : ''; ?>>Bloomberg</option>
                                                <option value="Bureau" <?php echo ($news['journalist_id'] == 'Bureau ') ? 'selected' : ''; ?>>Bureau</option>
                                                <option value="Correspondent" <?php echo ($news['journalist_id'] == 'Correspondent ') ? 'selected' : ''; ?>>Correspondent</option>
                                                <option value="PTI" <?php echo ($news['journalist_id'] == 'PTI ') ? 'selected' : ''; ?>>PTI</option>
                                                <option value="Reuters" <?php echo ($news['journalist_id'] == 'Reuters ') ? 'selected' : ''; ?>>Reuters</option>
                                                <option value="The New York Times" <?php echo ($news['journalist_id'] == 'The New York Times ') ? 'selected' : ''; ?>>The New York Times</option>
                                            </optgroup>
                                            <optgroup label="Journalist Names">
                                                <option value="Jitendra" <?php echo ($news['journalist_id'] == 'Jitendra ') ? 'selected' : ''; ?>>Jitendra</option>
                                            </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="px-1 font-weight-bold" for="Author">Author </label>
                                            <input type="text" class="form-control" placeholder="Enter Author" name="author" id="author" >
                                        </div>
                                        <div class="col-md-4">
                                            <label class="px-1 font-weight-bold" for="news_position"> News Position</label>
                                            <select class="form-control" name="NewsPosition" id="NewsPosition" >
                                                <option value="0">Select</option>
                                                <option value="Bottom" <?php echo ($news['news_position'] == 'Bottom') ? 'selected' : ''; ?>>Bottom<option>
                                            <option value="Bottom Center" <?php echo ($news['news_position'] == 'Bottom Center') ? 'selected' : ''; ?>>Bottom Center</option>
                                            <option value="Bottom Left" <?php echo ($news['news_position'] == 'Bottom Left') ? 'selected' : ''; ?>>Bottom Left</option>
                                            <option value="Bottom Right" <?php echo ($news['news_position'] == 'Bottom Right') ? 'selected' : ''; ?>>Bottom Right</option>
                                            <option value="Fullpage" <?php echo ($news['news_position'] == 'Fullpage') ? 'selected' : ''; ?>>Fullpage</option>
                                            <option value="Half Page" <?php echo ($news['news_position'] == 'Half Page') ? 'selected' : ''; ?>>Half Page</option>
                                            <option value="Internet" <?php echo ($news['news_position'] == 'Internet') ? 'selected' : ''; ?>>Internet</option>
                                            <option value="Middle" <?php echo ($news['news_position'] == 'Middle') ? 'selected' : ''; ?>>Middle</option>
                                            <option value="Middle Center" <?php echo ($news['news_position'] == 'Middle Center') ? 'selected' : ''; ?>>Middle Center</option>
                                            <option value="Middle Left" <?php echo ($news['news_position'] == 'Middle Left') ? 'selected' : ''; ?>>Middle Left</option>
                                            <option value="Middle Right" <?php echo ($news['news_position'] == 'Middle Right') ? 'selected' : ''; ?>>Middle Right</option>
                                            <option value="Not Known" <?php echo ($news['news_position'] == 'Not Known') ? 'selected' : ''; ?>>Not Known</option>
                                            <option value="Quarter Page" <?php echo ($news['news_position'] == 'Quarter Page') ? 'selected' : ''; ?>>Quarter Page</option>
                                            <option value="Top" <?php echo ($news['news_position'] == 'Top') ? 'selected' : ''; ?>>Top</option>
                                            <option value="Top Center" <?php echo ($news['news_position'] == 'Top Center') ? 'selected' : ''; ?>>Top Center</option>
                                            <option value="Top Left" <?php echo ($news['news_position'] == 'Top Left') ? 'selected' : ''; ?>>Top Left</option>
                                            <option value="Top Right" <?php echo ($news['news_position'] == 'Top Right') ? 'selected' : ''; ?>>Top Right</option>
                                            <option value="TV" <?php echo ($news['news_position'] == 'TV') ? 'selected' : ''; ?>>TV</option>
                                                </select>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="px-1 font-weight-bold" for="NewsCity"> News City</label>
                                            <select  class="form-control"  name="NewsCity" id="NewsCity">
                                                <option value="0">Select</option>
                                                <option value="Nashik" <?php echo ($news['news_city_id'] == 'Nashik') ? 'selected' : ''; ?>>Nashik</option>
                                                </select>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="px-1 font-weight-bold" for="Category"> Category </label>
                                            <select class="form-control" name="category" id="category">
                                                <option value="0">Select</option>
                                                <option value="After Market MFCSL" <?php echo ($news['category_id'] == 'After Market MFCS') ? 'selected' : ''; ?> >After Market MFCSL</option>
                                                <option value="After Market MFCWL" <?php echo ($news['category_id'] == 'After Market MFCWL') ? 'selected' : ''; ?> >After Market MFCWL</option>
                                                <option value="Agri Andreas Stihl" <?php echo ($news['category_id'] == 'Agri Andreas Stihl') ? 'selected' : ''; ?>>Agri Andreas Stihl</option>
                                                <option value="Agri Honda Siel Power Products" <?php echo ($news['category_id'] == 'Agri Honda Siel Power Products') ? 'selected' : ''; ?> >Agri Honda Siel Power Products</option>
                                                </select>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="px-1 font-weight-bold" for="HeadLine">HeadLine</label>
                                            <textarea  class="form-control" name="headline"  rows="4" cols="50"><?php echo $news['head_line'];?>
                                            </textarea>
                                        </div>  
                                        <div class="col-md-6">
                                            <label class="px-1 font-weight-bold" for="Summary">Summary</label>
                                            <textarea  class="form-control" name="Summary"  rows="4" cols="50"><?php echo $news['summary'];?>
                                            </textarea>
                                        </div>
                                    </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right px-4 py-2">
                        <!-- <button  class="btn btn-success">Additional Page</button> -->
                        <button type="submit" class="btn btn-primary">SAVE</button>
                    </div>
            </div>  
        </form>
        <?php } ?>
    </div>
</div>          
<script>
    // Get the current time
    const currentTime = new Date();
    
    // Format the current time as HH:MM:SS
    const formattedTime = currentTime.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' });

    // Set the formatted time in the input field
    // document.getElementById("current_time").value = formattedTime;
</script>
<!-- this div is for footer --->
</div>

<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    function getKeywords(id) {
        console.log("Processing editor: " + id);

        // Get the content of the editor
        var description = CKEDITOR.instances['editor' + id].getData();
        console.log('Content of editor' + id + ':', description);

        // Your keyword extraction logic goes here
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Reporter/searchKeywords')?>",
            data: { description: description },
            success: function(response) {
                console.log("Response:", response);
                try {
                    var keywords = JSON.parse(response);
                    console.log("Parsed Keywords:", keywords);

                    if (keywords.length > 0) {
                        var formattedKeywords = keywords.join(', ');
                        console.log("Matching Keywords:", formattedKeywords);

                        let keywordData = '<div class="row">';
                        keywordData += '<div class="col-md-12">';
                        keywordData += '<label>Matching Keywords </label>';
                        keywordData += '<textarea class="form-control" name="getKeys' + id + '[]" id="getKeys' + id + '" oninput="sendKeywordData(' + id + ')">' + formattedKeywords + '</textarea>';
                        keywordData += '</div>';
                        keywordData += '</div>';

                        $('#keyword_container_' + id).html(keywordData);

                        // Call sendKeywordData immediately after updating the textarea content
                        sendKeywordData(id);
                    } else {
                        console.log("No matching keywords found.");
                    }
                } catch (error) {
                    console.error("Error parsing response:", error);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    $(document).ready(function() {
        // Initialize CKEditor for each textarea with a unique ID
        <?php for ($i = 1; $i <= $id_counter; $i++) { ?>
            CKEDITOR.replace('editor<?php echo $i; ?>', {
                on: {
                    instanceReady: function(evt) {
                        getKeywords('<?php echo $i; ?>');
                    },
                    change: function(evt) {
                        getKeywords('<?php echo $i; ?>');
                    }
                }
            });
        <?php } ?>
    });

    function sendKeywordData(id) {
        try {
            var textarea = document.getElementById('getKeys' + id);
            var keywordData = textarea.value;
            console.log('Sending keyword data for id ' + id + ':', keywordData);

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('NewsUpload/getClientsFromKeywords')?>',
                data: { keywordData: keywordData },
                success: function(response) {
                    console.log('Data sent successfully:', response);

                    // Convert the response string into an array of client IDs
                    let clientIDs = response.split(',').map(id => parseInt(id.trim()));

                    let selectOptions = '';
                    // Iterate through the list of all clients and include all clients
                    <?php foreach($get_clients as $values): ?>
                        if (clientIDs.includes(<?php echo $values['client_id']; ?>)) {
                            selectOptions += '<option value="<?php echo $values['client_id']; ?>" selected><?php echo $values['client_name']; ?></option>';
                        } else {
                            selectOptions += '<option value="<?php echo $values['client_id']; ?>"><?php echo $values['client_name']; ?></option>';
                        }
                    <?php endforeach; ?>

                    // Construct the HTML for select element
                    let selectHTML = '<div class="row">';
                    selectHTML += '<div class="col-md-12">';
                    selectHTML += '<label>Matching client </label>';
                    selectHTML += '<select class="js-example-basic-multiple form-control" name="getclient' + id + '[]" id="getclient' + id + '" multiple="multiple">';
                    selectHTML += '<option disabled>Select</option>';
                    selectHTML += selectOptions;
                    selectHTML += '</select>';
                    selectHTML += '</div>';
                    selectHTML += '</div>';

                    // Append the select element to the placeholder container
                    $('#client_container_' + id).html(selectHTML);

                    // Reinitialize Select2 on the newly added select element
                    $('#getclient' + id).select2();
                },
                error: function(error) {
                    console.log('Error sending data:', error);
                }
            });
        } catch (error) {
            console.error('Error in sendKeywordData:', error);
        }
    }
</script>

<!-- this code is for author disabled functionality -->
<script>
        document.getElementById('journalist_name').addEventListener('change', function() {
            var authorInput = document.getElementById('author');
            if (this.value) {
                authorInput.disabled = true;
                authorInput.value = '';
            } else {
                authorInput.disabled = false;
            }
        });

</script> 
