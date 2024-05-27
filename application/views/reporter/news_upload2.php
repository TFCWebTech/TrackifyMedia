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
        <form action="<?php echo base_url('NewsUpload/addArtical')?>" method="post"> 
        <!-- <form action=""> -->
            <div class="row">
                    <div class="col-md-12 ">
                        <div class="text-center">
                            <h5 class="font-weight-bold text-uppercase text-color">Upload News</h5>
                        </div>  
                        <hr>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="border-with-text" data-heading="Article Editing">
                            <div class="row">
                                <div class="col-md-4 my-2">
                                    <!-- <label class=" font-weight-bold" for="Height">Upload Image </label>
                                    <input type="file" class="form-control" placeholder="Enter Height" name="image_upload" id="image_upload"> -->
                                    <div class="form-group files">
                                        <label>Upload Your File </label>
                                        <input type="file" class="form-control" multiple="" name="image_upload[]" id="image_upload">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row" id="news_arr">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 py-2 mt-3" >
                        <div class="border-with-text" data-heading="Media Information">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="px-1 font-weight-bold" for="media_type">Media Type: </label>
                                            <select class="form-control" name="media_type" required>
                                                <option value="">Select</option>
                                                <option value="Magazine">Magazine</option>
                                                <option value="NewsPaper">NewsPaper</option>
                                                <option value="Online">Online</option>
                                                <option value="RSS">RSS</option>
                                                <option value="TV">TV</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="publication">Publication</label>
                                            <select class="form-control" name="publication" >
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
                                            <label class="px-1 font-weight-bold" for="edition">Edition</label>
                                            <select class="form-control" name="edition" >
                                                <option value="">Select</option>
                                                <option value="National">National</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type">Supplement</label>
                                            <select  class="form-control"  name="SupplementId" id="SupplementId1" accesskey="s">
                                                <option value="1">Select</option>
                                                <option value="bf59dde41ba391ab8a79958743e31742b1bbe144">  </option>
                                                <option value="ae06c283bf57559341e3ae3446b25ea93517c979"> A Celebration Of Life </option>
                                                <option value="9b3c9ca46debe5adfa631eef2591d88765dabf15"> Aadab Hyderabad </option>
                                                <option value="7671b50f6b5450fd5976d9f46c0a8c90ba30b03a"> ahmedabad </option>
                                                <option value="82a9be3ae1ebe39f2513c568f4f26ca4d209b6dc"> Alappuzha </option>
                                                <option value="d4b08de76ef09ce3caf6d1d894e2c588ec90d28a"> Amritsar </option>
                                                <option value="e46297efaff2b296760d5f2e4f458d1e6fbf9bbc"> Anantha </option>
                                                <option value="f85812cfbd0c0ab6c771b1b192a833a0fce95e21"> Asset Allocation </option>
                                                <option value="c6bcb345d41e1bfd75eda38de8ef052e6f8578c2"> auto drive  </option>
                                                <option value="dc2db2122bec191076b0e7c08ea7f7654d3ed7bd"> AUTOCAR SPORT </option>
                                                <option value="1b6049ac9b32c6d74245a97931c4148927f42b6a"> Automotive Retail </option>
                                                <option value="53a023c8c579c6cb274a4d745e616f89d6ea289a"> AVENUES </option>
                                                <option value="b7a49604f8e1ae99fd6ce44b390333cd799f70af"> Baja Saeindia </option>
                                                <option value="fb373d3e1bbf08a89f70dea77cd5985a2a2e954f"> bangaloreplus </option>
                                                <option value="8dca55cc518511b7e9d1e7203c2309bb380ae064"> Bankers Trust </option>
                                                <option value="e667de999a64ed27e0f4d1452a1893c1a0ad5e22"> Banking annual </option>
                                                <option value="6d0467fc419c8784f199fba9ef018a9f45eb2836"> Banking Technology </option>
                                                <option value="c4dd3aa7d12fe6df4e11d5efdd1b98c7d5580b8f"> Banking Technology Award 2015 </option>
                                                <option value="217bb2d2d6f9ddd531c9ca9cb48d2272797e5c37"> BENGAL Towards Economic Resurgence  </option>
                                                <option value="e2510c95612adf7cbfb715bedcaecf725afbae85"> Bhubaneswar </option>
                                                <option value="f7fbf8c9937385299ce0987075ed51de941ec19d"> Big Bike Guide </option>
                                                <option value="9afcf5acd1e605ebeca6c77da1a72f05b6c7ea01"> bizjournal.com </option>
                                                <option value="37d0ab324fe24a77082dc234abf538813d3f6b03"> Blink </option>
                                                <option value="017b336264da3fb6cfd48e1e16357de33ccbbb0b"> Brands in the ascendance  </option>
                                                <option value="31a8438b7f4ba9726050b61256d779ef4a5fe4a1"> BS1000 Annual </option>
                                                <option value="82612f42a4decb4e917051df72c9f3bf8954ddeb"> Business Day </option>
                                                <option value="82c39c82ba3c48fc9710529feff0fe03b3b277d0"> Celebrating a second life </option>
                                                <option value="e0c634c81cf755d611f6d9ec04dd682f05aaebd9"> Chandigarh Spokesman </option>
                                            </select>
                                        </div>
                                         <div class="col-md-2">
                                            <label class="px-1 font-weight-bold" for="media_type">Publication Date</label>
                                            <input type="date" class="form-control" name="publication_date" id="publication_date">
                                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12 mt-3" >
                        <div class="border-with-text" data-heading="Journalist Information">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" name="journalist_name" for="journalist_name">Journalist Name:</label>
                                            <select class="form-control" name="journalist_name" >
                                                <option value="0">Select</option>
                                                <option value="Magazine">Magazine</option>
                                                <option value="NewsPaper">NewsPaper</option>
                                                <option value="Online">Online</option>
                                                <option value="RSS">RSS</option>
                                                <option value="TV">TV</option>
                                            </select>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <label class="px-1 font-weight-bold" for="journalist_email">Journalist Email:</label>
                                            <input type="email" class="form-control" placeholder="Enter Journalist Email"  name="journalist_email">
                                        </div> -->
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="publication_date">Author </label>
                                            <input type="text" class="form-control" placeholder="Enter Author" name="Author" id="Author">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="Page No">Page No </label>
                                            <input type="text" class="form-control" placeholder="Enter Page No" name="Page No" >
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type"> Agency</label>
                                            <select name="NewsCityID"  class="form-control"  id="Agency" >
                                                <option value="1">Select</option>
                                                </select>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type"> News Position</label>
                                            <select name="NewsCityID"  class="form-control"  id="NewsPosition" >
                                                <option value="1">Select</option>
                                                </select>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type"> News City</label>
                                            <select name="NewsCityID"  class="form-control"  id="NewsCity" >
                                                <option value="1">Select</option>
                                                </select>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="px-1 font-weight-bold" for="media_type"> Category </label>
                                            <select name="NewsCityID"  class="form-control"  id="Category" >
                                                <option value="1">Select</option>
                                                </select>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="px-1 font-weight-bold" for="HeadLine">HeadLine</label>
                                            <textarea id="w3review" class="form-control" name="headline" rows="4" cols="50">
                                            </textarea>
                                        </div>  
                                        <div class="col-md-6">
                                            <label class="px-1 font-weight-bold" for="media_type">Summary</label>
                                            <textarea id="w3review" class="form-control" name="Summary" rows="4" cols="50">
                                            </textarea>
                                        </div>
                                    </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right px-4 py-2">
                        <!-- <button  class="btn btn-success">Additional Page</button> -->
                        <button type="submit" class="btn btn-primary">Upload News</button>
                    </div>
            </div>

        </form>

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

 <script type="text/javascript">
   CKEDITOR.replace( 'editor1' );
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    $('#image_upload').on('change', function() {
        const files = this.files; // Get all selected files
        const formData = new FormData();

        // Append each file to FormData object
        for (let i = 0; i < files.length; i++) {
            formData.append('image_upload[]', files[i]); // Use [] to indicate array
        }

        // Get CSRF token from meta tag
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Send AJAX request to store the images
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
                if (response.success) {
                    var imageUris = response.image_uris;
                    console.log("Image URIs:", imageUris);
                    //imageToText(imageUris);
                    let i = 1;
                    imageUris.forEach(function(image) {
                        // Call imageToText function for each image URI
                            imageToText(image, i);
                            i++;
                        });
                } else {
                    console.error("Error:", response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });
});

// function imageToText(imageUris, index) {
    // Get the container where you want to append the textareas
//     console.log(imageUris);
//     // Iterate over the image URIs
//     var textareaId = 'editor_' + index; // Unique ID for textarea
//     var editorId = 'editor_instance_' + index;   // Unique ID for CKEditor instance

//     // Create a new textarea element
//     let data = '<div class="col-md-6"><div class="row">';
//     data += '<div class="col-md-12 getceditorCon">';
//     data += '<textarea class="form-control" name="editor'+index+'" id="getNews"></textarea>';
//     data += '</div>';
//     data += '<div class="col-md-12">';
//     data += '<label>Matching Keywords </label>';
//     data += '<textarea class="form-control" name="getKeys'+index+'" id="getKeyword"></textarea>';
//     data += '</div>';
//     data += '<div class="col-md-6">';
//     data += '<label>Matching Keywords </label>';
//     data += '<input type="number" name="page_no'+index+'" class="form-control" placeholder="page no">';
//     data += '</div></div></div>';

//     // Append the textarea to the container
//     $('#news_arr').append(data);

//     // Initialize CKEditor for the new textarea
//     var img = CKEDITOR.replace( 'editor'+index );
//     img.setData(imageUris);
    
// }
function imageToText(imageUris, index) {
    $.ajax({
        url: 'https://vision.googleapis.com/v1/images:annotate?key=AIzaSyBYb7FLN__svPKZUbaOeoV4kxZrNoxehLw', 
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            "requests": [
                {
                    "image": {
                        "source": {
                            "imageUri": imageUris
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
            // Check if response is not empty and contains responses array
            if (response && response.responses && response.responses.length > 0) {
                // Check if textAnnotations array exists and is not empty
                if (response.responses[0].textAnnotations && response.responses[0].textAnnotations.length > 0) {
                    var description = response.responses[0].textAnnotations[0].description;
                    console.log(description);

                        var textareaId = 'editor_' + index; // Unique ID for textarea
                        var editorId = 'editor_instance_' + index;   // Unique ID for CKEditor instance

                        // Create a new textarea element
                        let data = '<div class="col-md-6"><div class="row">';
                        data += '<div class="col-md-12 ">';
                        data += '<textarea class="form-control" name="editor'+index+'" id="getNews"></textarea>';
                        data += '</div></div></div>';
                       

                        // Append the textarea to the container
                        $('#news_arr').append(data);

                        // Initialize CKEditor for the new textarea
                        var img = CKEDITOR.replace( 'editor'+index );
                        img.setData(description);

                    // var editor = CKEDITOR.instances['getNews']; // Replace 'getNews' with the ID of your CKEditor instance
                    // if (editor) {
                    //     editor.setData(description);
                        $.ajax({
                        type: 'POST',
                        url: "<?php echo site_url('Reporter/searchKeywords')?>",
                        data: { description: description }, // Send the description
                            success: function(response) {
                            console.log("Response:", response); // Log the response object to the console
                            try {
                                var keywords = JSON.parse(response);
                                console.log("Parsed Keywords:", keywords);
                                // Check if any matching keywords were returned
                                if (keywords.length > 0) {
                                    var formattedKeywords = keywords.join(', ');
            
                                    // Update the UI with the matching keywords
                                    console.log("Matching Keywords:", formattedKeywords);
                                    // var textarea = document.getElementById("getKeyword");
                                    // textarea.value = formattedKeywords;
                                    data += '<div class="col-md-6"><div class="row">';
                                    data += '<div class="col-md-12">';
                                    data += '<label>Matching Keywords </label>';
                   data += '<textarea class="form-control" name="getKeys'+index+'" id="getKeys'+index+'">'+formattedKeywords+'</textarea>';
                                    data += '</div>';
                                    data += '<div class="col-md-6">';
                                    data += '<label>Page Number </label>';
                                    data += '<input type="number" name="page_no'+index+'" class="form-control" placeholder="page no">';
                                    data += '</div></div></div>';
                                    $('#news_arr').append(data);
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
                    // } else {
                    //     console.error('CKEditor instance not found.');
                    // }
                } else {
                    console.error('No text annotations found in the response.');
                }
            } else {
                console.error('Invalid response format or no responses received.');
            }
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error(error);
        }
    });
}
</script>
