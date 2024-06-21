<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
   
.table-wrapper {
    overflow-x: auto;
}

table {
    border-collapse: collapse;
    width: 100%;
}

td {
    padding: 5px;
    width: 33%;
}

th {
    text-align: center;
    padding: 5px;
}

.table-wrapper > table,
.table-wrapper > table td,
.table-wrapper > table th {
    border: 2px solid #ffffff;
}
.header_contert {
            display: flex;
            justify-content: space-between;
        }

        @media (max-width: 725px) {
            .header_contert {
                display: block;
                text-align: center;
            }
        }
        p{
            margin-top:0px !important;
            margin-bottom:0px !important;
        }
        h5 , h6{
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }
        #printButton , .send-button, #edit, #getEmails{
            background-color: #0080FF ;
            color: #ffffff;
            border-color: #0080FF ;
            border-radius: 5px;
        }
        .fa-send-o {
            font-size:16px;
            /* color:#ffffff; */
        }
        .showEdit {
            display: none;
        }

</style>
<div class="container">
        <div class="row">
            <div class="col-md-12 text-right mb-2">
            <button id="printButton" > <i class="fa fa-download"></i></button> &nbsp;
            <button id="edit"> <i class="fa fa-edit"></i></button> &nbsp;
            <button data-toggle="modal" data-target="#getEmail" id="getEmails" onclick="getEmail('<?php echo $details['client_id'];?>')" > <i class="fa fa-send"></i></button>
              <!-- <a class="send-button btn" href="<?php echo site_url('NewsLetter/sendMail/'.$details['client_id']);?>"> <i class="fa fa-send-o" ></i></a> -->
            </div>
        </div>
        <div class="card" id="content" style="background-color: #F9F9F9;">
                <div class="header" style="background-color: <?php echo $get_client_details[0]['header_background_color']; ?>; padding:5px 10px;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left">   
                            <?php 
                            if ($get_client_details[0]['logo_position'] == 'Left') { ?>
                                <img src="<?php echo $get_client_details[0]['header_logo_url']; ?>" alt="logo" style="width:100px;"> <br>
                            <?php }

                            if ($get_client_details[0]['trackify_link_status'] == 1) { ?>
                                <a href="<?php echo $get_client_details[0]['trackify_link']; ?>" style="font-size:12px; color:#000000;">powered by trackify media</a>
                            <?php }
                            ?>
                            </td>
                            <td align="center">
                            <?php 
                            if ($get_client_details[0]['logo_position'] == 'Center') { ?>
                                <img src="<?php echo $get_client_details[0]['header_logo_url']; ?>" alt="logo" style="width:100px;"> <br>
                            <?php }
                            ?>
                                 <h5 ><a style="font-size:<?php echo $get_client_details[0]['header_title_font_size'] ?>px; color:<?php echo $get_client_details[0]['header_title_font_color'] ?>;"> <?php echo $get_client_details[0]['header_title_name']; ?> </a><br>
                                <span style="display:block; font-size: 12px;"><?php echo date('l, M d, Y'); ?><br>
                                <!-- <span style="font-size:12px;" >  0 News / <a href=""> view consolidated  </span> -->
                                </span>
                            </h5>
                            </td>
                            <td align="right"> 
                                <?php 
                                if ($get_client_details[0]['logo_position'] == 'Right') { ?>
                                    <img src="<?php echo $get_client_details[0]['header_logo_url']; ?>" alt="logo" style="width:100px;"> <br>
                                <?php }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>    
                <div class="col-md-12 mt-3 table-wrapper" >
                <table>
                    <tr style="background-color: #6D6B6B; color: #ffffff;">
                        <th>Quick Links</th>
                        <th>Access Other Services</th>
                    </tr>
                    <?php if (!empty($get_client_details[0]['get_quick_links'])): ?>
                        <?php foreach ($get_client_details[0]['get_quick_links'] as $detail): ?>
                            <?php if ($detail['quick_links_position'] == '1'): ?>
                                <tr style="background-color: #DCD5D5; color: #ffffff;">
                                    <td>
                                        <p><?php echo $detail['quick_links_name']; ?></p>
                                    </td>
                                    <td><a href="">Login</a></td>
                                </tr>
                            <?php elseif ($detail['quick_links_position'] == '2'): ?>
                                <tr style="background-color: #DCD5D5; color: #ffffff;">
                                    <td>
                                        <?php echo $detail['quick_links_name']; ?> (<?php echo sizeof($get_client_details[0]['compititors_data']); ?>)
                                    </td>
                                    <td></td>
                                </tr>
                            <?php elseif ($detail['quick_links_position'] == '3'): ?>
                                <tr style="background-color: #DCD5D5; color: #ffffff;">
                                    <td>
                                        <?php echo $detail['quick_links_name']; ?> (<?php echo sizeof($get_client_details[0]['industry_data']); ?>)
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            <?php elseif ($detail['quick_links_position'] == '4'): ?>
                                <tr style="background-color: #DCD5D5; color: #ffffff;">
                                    <td>
                                        <?php echo $detail['quick_links_name']; ?> (<?php echo sizeof($get_client_details[0]['compititors_data']); ?>)
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            <?php elseif ($detail['quick_links_position'] == '5'): ?>
                                <tr style="background-color: #DCD5D5; color: #ffffff;">
                                    <td>
                                        <?php echo $detail['quick_links_name']; ?> (<?php echo sizeof($get_client_details[0]['industry_data']); ?>)
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            <?php elseif ($detail['quick_links_position'] == '6'): ?>
                                <tr style="background-color: #DCD5D5; color: #ffffff;">
                                    <td>
                                        <?php echo $detail['quick_links_name']; ?> (<?php echo sizeof($detail['compititors_data']); ?>)
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <tr style="background-color: #DCD5D5; color: #ffffff;">
                        <td></td>
                        <td><a href="">Customerservice@trackifyMedia.info</a></td>
                    </tr>
                </table>
                </div>
                <div class="body-content" style="padding:10px 15px 0px 15px;">
                    <h4 style="background-color: #cfbbbb; color: #ffffff; padding:4px;"> <?php echo $details['client_name']; ?></h4>
                    <?php foreach ($get_client_details[0]['client_news'] as $key => $news) { ?>
                        <div id="clientnewsContent-<?php echo $news['news_details_id']; ?>" style="display: block;">
                            <div style="display:flex; justify-content: space-between; padding:0px 10px 0px 0px;">
                                <h5>
                                    <a href="<?php echo site_url('NewsLetter/DisplayNews/'.$news['news_details_id']);?>" style="color: <?php echo $get_client_details[0]['content_headline_color']; ?>;font-size: <?php echo $get_client_details[0]['content_headline_font_size']; ?>;font-family: <?php echo $get_client_details[0]['content_headline_font']; ?>">  <?php echo $news['head_line']; ?> </a>
                                </h5>
                                <h6 class="showEdit">
                                    <div style="d-flex">
                                        <a onclick="toggleNewsContent('<?php echo $news['news_details_id']; ?>')"> Edit News</a>|
                                        <a onclick="hideNews('<?php echo $news['news_details_id'];?>', '<?php echo $details['client_id'];?>')"> Hide</a> | 
                                        <a style="color:red;" onclick="deleteNews('<?php echo $news['news_details_id'];?>', '<?php echo $details['client_id'];?>')">Delete</a> 
                                    </div>
                                </h6>
                            </div>
                            <h6>Summary:</h6>
                            <p style="color: <?php echo $get_client_details[0]['content_news_summary_color']; ?>;font-size: <?php echo $get_client_details[0]['content_news_summary_font_size']; ?>;">
                                <?php echo $news['summary']; ?>
                            </p>
                            <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?> ,
                                Publication :<span style="color:blue;"> <?php echo $news['MediaOutlet']; ?></span>, Journalist / Agency :<span style="color:blue;"> <?php echo $news['Journalist']; ?></span>  , 
                                Edition : <span style="color:blue;"> <?php echo $news['Edition']; ?> </span>,  Supplement : <span style="color:blue;"> <?php echo $news['Supplement']; ?> </span>, No of pages:<span style="color:blue;"> <?php echo $news['page_count']; ?></span> , Circulation Figure:<span> </span>, qAVE(Rs.) :<span> </span> 
                            </p>
                            <hr>
                        </div>

                        <div id="clientnewsContentEdit-<?php echo $news['news_details_id']; ?>" style="display: none;">
                            <div style="display:flex; justify-content: space-between; padding:0px 10px 0px 0px;">
                                <div class="headline" style="width: 500px;">
                                    <h6>Headline:</h6>
                                    <textarea name="" id="update_headline_<?php echo $news['news_details_id']; ?>" class="form-control"><?php echo $news['head_line']; ?></textarea>
                                </div>
                                
                                <h6 class="showEdit2">
                                    <div style="d-flex">
                                        <a class="btn border" onclick="updateNewsContent('<?php echo $news['news_details_id'];?>', '<?php echo $details['client_id'];?>')"> Update News</a> 
                                    </div>
                                </h6>
                            </div>
                        
                            <h6>Summary:</h6>
                            <textarea name="" id="update_summary_<?php echo $news['news_details_id']; ?>" class="form-control"><?php echo $news['summary']; ?></textarea>
                            <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?> ,
                                Publication :<span style="color:blue;"> <?php echo $news['MediaOutlet']; ?></span>, Journalist / Agency :<span style="color:blue;"> <?php echo $news['Journalist']; ?></span>  , 
                                Edition : <span style="color:blue;"> <?php echo $news['Edition']; ?> </span>,  Supplement : <span style="color:blue;"> <?php echo $news['Supplement']; ?> </span>, No of pages:<span style="color:blue;"> <?php echo $news['page_count']; ?></span> , Circulation Figure:<span> </span>, qAVE(Rs.) :<span> </span> 
                            </p>
                            <hr>
                        </div>
                    <?php } ?>
                </div>

             <!-- This is for competitors -->
            <div class="body-content" style="padding:10px 15px 0px 15px;">
                <h4 style="background-color: #cfbbbb; color: #ffffff; padding:4px;"> Competition</h4>
            </div>

            <?php foreach ($get_client_details[0]['compititors_data'] as $key => $compititor) { ?>
                <div class="body-content" style="padding:10px 15px 0px 15px;">
                    <h4 style="background-color: #cfbbbb; color: #ffffff; padding:4px;"> <?php echo $compititor['Competitor_name']; ?></h4>
                    <?php foreach ($compititor['news'] as $key => $news) { ?>
                        <div id="competitornewsContent-<?php echo $news['news_details_id'] . '-' . $compititor['competitor_id']; ?>" style="display: block;">
                            <div style="display:flex; justify-content: space-between; padding:0px 10px 0px 0px;">
                                <h5>
                                    <a href="<?php echo site_url('NewsLetter/DisplayNews/'.$news['news_details_id']);?>" style="color: <?php echo $get_client_details[0]['content_headline_color']; ?>;font-size: <?php echo $get_client_details[0]['content_headline_font_size']; ?>;font-family: <?php echo $get_client_details[0]['content_headline_font']; ?>">  
                                        <?php echo $news['head_line']; ?> 
                                    </a>
                                </h5>
                                <h6 class="showEdit">
                                    <div style="d-flex">
                                        <a onclick="toggleNewsContent2('<?php echo $news['news_details_id']; ?>', '<?php echo $compititor['competitor_id']; ?>')"> Edit News</a> |
                                        <a onclick="hideNews('<?php echo $news['news_details_id'];?>', '<?php echo $details['client_id'];?>')"> Hide</a> | 
                                        <a style="color:red;" onclick="deleteNews('<?php echo $news['news_details_id'];?>', '<?php echo $details['client_id'];?>')">Delete</a> 
                                    </div>
                                </h6>
                            </div> 
                            <h6>Summary:</h6>
                            <p style="color: <?php echo $get_client_details[0]['content_news_summary_color']; ?>;font-size: <?php echo $get_client_details[0]['content_news_summary_font_size']; ?>;">
                                <?php echo $news['summary']; ?>
                            </p>
                            <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?> ,
                                Publication :<span style="color:blue;"> <?php echo $news['MediaOutlet']; ?></span>, Journalist / Agency :<span style="color:blue;"> <?php echo $news['Journalist']; ?></span>  , 
                                Edition : <span style="color:blue;"> <?php echo $news['Edition']; ?> </span>,  Supplement : <span style="color:blue;"> <?php echo $news['Supplement']; ?> </span>, No of pages:<span style="color:blue;"> <?php echo $news['page_count']; ?></span> , Circulation Figure:<span> </span>, qAVE(Rs.) :<span> </span> 
                            </p>                 
                            <hr>
                        </div>  
                        
                        <div id="competitornewsContentEdit-<?php echo $news['news_details_id'] . '-' . $compititor['competitor_id']; ?>" style="display: none;">
                            <div style="display:flex; justify-content: space-between; padding:0px 10px 0px 0px;">
                                <div class="headline" style="width: 500px;">
                                    <h6>Headline:</h6>
                                    <textarea name="" id="com_update_headline_<?php echo $news['news_details_id']; ?>" class="form-control"><?php echo $news['head_line']; ?></textarea>
                                </div>
                                
                                <h6 class="showEdit2">
                                    <div style="d-flex">
                                        <a class="btn border" onclick="updateNewsContent2('<?php echo $news['news_details_id'];?>', '<?php echo $details['client_id'];?>')"> Update News</a> 
                                    </div>
                                </h6>
                            </div>
                        
                            <h6>Summary:</h6>
                            <textarea name="" id="com_update_summary_<?php echo $news['news_details_id']; ?>" class="form-control"><?php echo $news['summary']; ?></textarea>
                            <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?> ,
                                Publication :<span style="color:blue;"> <?php echo $news['MediaOutlet']; ?></span>, Journalist / Agency :<span style="color:blue;"> <?php echo $news['Journalist']; ?></span>  , 
                                Edition : <span style="color:blue;"> <?php echo $news['Edition']; ?> </span>,  Supplement : <span style="color:blue;"> <?php echo $news['Supplement']; ?> </span>, No of pages:<span style="color:blue;"> <?php echo $news['page_count']; ?></span> , Circulation Figure:<span> </span>, qAVE(Rs.) :<span> </span> 
                            </p>
                            <hr>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>


<!-- This is for Industry -->
<div class="body-content" style="padding:10px 15px 0px 15px;">
    <h4 style="background-color: #cfbbbb; color: #ffffff; padding:4px;"> Industry</h4>
</div>

<?php foreach ($get_client_details[0]['industry_data'] as $key => $Industry) { ?>
    <div class="body-content" style="padding:10px 15px 0px 15px;">
        <h4 style="background-color: #cfbbbb; color: #ffffff; padding:4px;"> <?php echo $Industry['Industry_name']; ?></h4>
        <?php foreach ($Industry['news'] as $key => $news) { ?>
            <div id="IndustrynewsContent-<?php echo $news['news_details_id'] . '-' . $Industry['Industry_id']; ?>" style="display: block;">
                <div style="display:flex; justify-content: space-between; padding:0px 10px 0px 0px;">
                    <h5>
                        <a href="<?php echo site_url('NewsLetter/DisplayNews/'.$news['news_details_id']);?>" style="color: <?php echo $get_client_details[0]['content_headline_color']; ?>;font-size: <?php echo $get_client_details[0]['content_headline_font_size']; ?>;font-family: <?php echo $get_client_details[0]['content_headline_font']; ?>">  
                            <?php echo $news['head_line']; ?> 
                        </a>
                    </h5>
                    <h6 class="showEdit">
                        <div style="d-flex">
                            <a onclick="toggleNewsContent3('<?php echo $news['news_details_id']; ?>', '<?php echo $Industry['Industry_id']; ?>')"> Edit News</a> |
                            <a onclick="hideNews('<?php echo $news['news_details_id'];?>', '<?php echo $details['client_id'];?>')"> Hide</a> | 
                            <a style="color:red;" onclick="deleteNews('<?php echo $news['news_details_id'];?>', '<?php echo $details['client_id'];?>')">Delete</a> 
                        </div>
                    </h6>
                </div> 
                <h6>Summary:</h6>
                <p style="color: <?php echo $get_client_details[0]['content_news_summary_color']; ?>;font-size: <?php echo $get_client_details[0]['content_news_summary_font_size']; ?>;">
                    <?php echo $news['summary']; ?>
                </p>
                <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?> ,
                                Publication :<span style="color:blue;"> <?php echo $news['MediaOutlet']; ?></span>, Journalist / Agency :<span style="color:blue;"> <?php echo $news['Journalist']; ?></span>  , 
                                Edition : <span style="color:blue;"> <?php echo $news['Edition']; ?> </span>,  Supplement : <span style="color:blue;"> <?php echo $news['Supplement']; ?> </span>, No of pages:<span style="color:blue;"> <?php echo $news['page_count']; ?></span> , Circulation Figure:<span> </span>, qAVE(Rs.) :<span> </span> 
                            </p>               
                <hr>
            </div>  
            
            <div id="IndustrynewsContentEdit-<?php echo $news['news_details_id'] . '-' . $Industry['Industry_id']; ?>" style="display: none;">
                <div style="display:flex; justify-content: space-between; padding:0px 10px 0px 0px;">
                    <div class="headline" style="width: 500px;">
                        <h6>Headline:</h6>
                        <textarea name="" id="industry_update_headline_<?php echo $news['news_details_id']; ?>" class="form-control"><?php echo $news['head_line']; ?></textarea>
                    </div>
                    
                    <h6 class="showEdit2">
                        <div style="d-flex">
                            <a class="btn border" onclick="updateNewsContent3('<?php echo $news['news_details_id'];?>', '<?php echo $details['client_id'];?>')"> Update News</a> 
                        </div>
                    </h6>
                </div>
            
                <h6>Summary:</h6>
                <textarea name="" id="industry_update_summary_<?php echo $news['news_details_id']; ?>" class="form-control"><?php echo $news['summary']; ?></textarea>
                <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?> ,
                                Publication :<span style="color:blue;"> <?php echo $news['MediaOutlet']; ?></span>, Journalist / Agency :<span style="color:blue;"> <?php echo $news['Journalist']; ?></span>  , 
                                Edition : <span style="color:blue;"> <?php echo $news['Edition']; ?> </span>,  Supplement : <span style="color:blue;"> <?php echo $news['Supplement']; ?> </span>, No of pages:<span style="color:blue;"> <?php echo $news['page_count']; ?></span> , Circulation Figure:<span> </span>, qAVE(Rs.) :<span> </span> 
                            </p>
                <hr>
            </div>
        <?php } ?>
    </div>
<?php } ?>

                <div class="col-md-12 news-footer" style="background-color: <?php echo $get_client_details[0]['footer_background_color']; ?>;">
                    <div class="d-flex justify-content-between" >
                            <div class="logo" style="text-align:left; ">
                                <?php 
                                if ($get_client_details[0]['footer_logo_position'] == 'Left') { ?>
                                    <img src="<?php echo $get_client_details[0]['footer_logo_url']; ?>" alt="logo" style="width:100px;  padding:5px;"> <br>
                                <?php }
                                ?>
                            </div>
                        <div class="footer" style="text-align:center; ">
                        <?php 
                        if ($get_client_details[0]['footer_logo_position'] == 'Center') { ?>
                            <img src="<?php echo $get_client_details[0]['footer_logo_url']; ?>" alt="logo" style="width:100px;  padding:5px;"> <br>
                        <?php }
                        ?>
                        </div>
                        <div class="footer" style="text-align:end;">
                        <?php 
                        if ($get_client_details[0]['footer_logo_position'] == 'Right') { ?>
                            <img src="<?php echo $get_client_details[0]['footer_logo_url']; ?>" alt="logo" style="width:100px;  padding:5px;"> <br>
                        <?php }
                        ?>
                        </div>
                    </div>
                    <p style="font-size:<?php echo $get_client_details[0]['footer_title_font_size'] ?>px; color:<?php echo $get_client_details[0]['footer_title_font_color'] ?>;text-align: center"><?php echo $get_client_details[0]['footer_title_name']; ?></p>
                    <p><span style="color:red; font-weight:bold;">This is an auto generated email – please do not reply to this email id</span></p>
                </div>
        </div>
    </div>
</div>


<div class="modal" id="getEmail">
  <div class="modal-dialog ">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Emails</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <form action="<?php echo site_url('NewsLetter/sendMail')?>" method="post">
          <div class="form-group">
            <!-- Dynamically filled checkboxes will be added here -->
          </div>
          <div class="text-right pt-2">
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

function getEmail(client_id) {
    console.log("client_id :", client_id);
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('NewsLetter/getEmail'); ?>",
        dataType: 'json', // Expecting JSON response from the server
        data: {
            client_id: client_id
        },
        success: function(response) {
    console.log("Response:", response);

    // Clear previous email checkboxes
    $('#getEmail .modal-body .form-group').empty();
    var i = 0;

    // Append hidden fields for client_id and client_ids outside the loop
    $('#getEmail .modal-body .form-group').append(
        '<input type="hidden" name="client_id" value="' + response.c_id + '">' + // Hidden field for client_id
        '<input type="hidden" name="client_ids" value="' + response.client_id + '" >' // Hidden field for client_ids as JSON string
    );

    // Handle the response data
    if (response && response.emails && response.emails.length > 0) {
        response.emails.forEach(function(email) {
            console.log("Email:", email.client_email);
            i++;
            console.log("i value:", i);

            // Append checkbox for each email
            $('#getEmail .modal-body .form-group').append(
                '<input type="hidden" name="index" value="' + i + '">' +
                '<div class="form-check">' +
                    '<label class="form-check-label justify-content-between">' +
                        '<input type="checkbox" name="clientMails' + i + '[]" class="form-check-input" value="' + email.client_email + '">' + email.client_email +
                    '</label>' +
                '</div>'
            );
        });
    } else {
        console.log("No emails found for this client.");
        $('#getEmail .modal-body .form-group').append('<p>No emails found for this client.</p>');
    }

    // Show the modal
    $('#getEmail').modal('show');
}
       
    });
       
}


    function deleteNews( news_details_id, client_id){
        console.log("news id :", news_details_id);
        console.log("client_id :", client_id);
        
        $.ajax({
        type: "POST",
        url: "<?php echo site_url('NewsLetter/delteNews'); ?>",
        dataType: 'html',
        data: {
            news_details_id: news_details_id,
            client_id: client_id
        },
        success: function(response) {
                    location.reload();
            },
          
        });
    }

    function hideNews(news_details_id, client_id){

        console.log("news id :", news_details_id);
        console.log("client_id :", client_id);
        
        $.ajax({
        type: "POST",
        url: "<?php echo site_url('NewsLetter/hideNews'); ?>",
        dataType: 'html',
        data: {
            news_details_id: news_details_id,
            client_id: client_id
        },
        success: function(response) {
                    location.reload();
            },
          
        });
    }


</script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to the print button
            document.getElementById('printButton').addEventListener('click', function() {
                window.print();
            });

            if (typeof jQuery !== 'undefined') {
                $(document).ready(function() {
                    $('#edit').on('click', function() {
                        $('.showEdit').toggle();
                    });
                });
            } else {
                console.error('jQuery is not loaded.');
            }
        });
    </script>

<script>
function toggleNewsContent(newsDetailsId) {
    var content = document.getElementById('clientnewsContent-' + newsDetailsId);
    var contentEdit = document.getElementById('clientnewsContentEdit-' + newsDetailsId);
    
    if (content.style.display === "none") {
        content.style.display = "block";
        contentEdit.style.display = "none";
    } else {
        content.style.display = "none";
        contentEdit.style.display = "block";
    }
}

function toggleNewsContent2(newsDetailsId, competitorId) {
    var content = document.getElementById('competitornewsContent-' + newsDetailsId + '-' + competitorId);
    var contentEdit = document.getElementById('competitornewsContentEdit-' + newsDetailsId + '-' + competitorId);
    
    if (content.style.display === "none") {
        content.style.display = "block";
        contentEdit.style.display = "none";
    } else {
        content.style.display = "none";
        contentEdit.style.display = "block";
    }
}


function toggleNewsContent3(newsDetailsId, industryId) {
    var content = document.getElementById('IndustrynewsContent-' + newsDetailsId + '-' + industryId);
    var contentEdit = document.getElementById('IndustrynewsContentEdit-' + newsDetailsId + '-' + industryId);
    
    if (content.style.display === "none") {
        content.style.display = "block";
        contentEdit.style.display = "none";
    } else {
        content.style.display = "none";
        contentEdit.style.display = "block";
    }
}

function updateNewsContent(news_details_id, client_id) {
    var headline = document.getElementById('update_headline_' + news_details_id).value;
    var summary = document.getElementById('update_summary_' + news_details_id).value;

    // Debugging: Output the retrieved values to console
    console.log("Headline:", headline);
    console.log("Summary:", summary);
    var get_client_details = <?php echo json_encode($get_client_details); ?>;
    console.log("get_client_details data", get_client_details);

    // Loop through the get_client_details to find the client with the given client_id
    var clientNews = null;
    for (var i = 0; i < get_client_details.length; i++) {
        if (get_client_details[i].client_id == client_id) {
            clientNews = get_client_details[i].client_news;
            break;
        }
    }

    if (clientNews) {
        // Loop through the clientNews to find the news with the given news_details_id
        for (var j = 0; j < clientNews.length; j++) {
            if (clientNews[j].news_details_id == news_details_id) {
                // Extract the specific data you need
                var media_type_id = clientNews[j].media_type_id;
                var publication_id = clientNews[j].publication_id;
                var edition_id = clientNews[j].edition_id;
                var supplement_id = clientNews[j].supplement_id;
                var journalist_id = clientNews[j].journalist_id;
                var agencies_id = clientNews[j].agencies_id;
                var author = clientNews[j].author;
                var news_position = clientNews[j].news_position;
                var news_city_id = clientNews[j].news_city_id;
                var category_id = clientNews[j].category_id;
                var is_send = clientNews[j].is_send;
                var keywords = clientNews[j].keywords;
                var page_count = clientNews[j].page_count;

                console.log("News media_type_id:", media_type_id);
                console.log("News publication_id:", publication_id);

                // Send the extracted data through AJAX
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('NewsLetter/newsupdate'); ?>",
                    dataType: 'html',
                    data: {
                        news_details_id: news_details_id,
                        client_id: client_id,
                        headline: headline,
                        summary: summary,
                        media_type_id: media_type_id,
                        publication_id: publication_id,
                        edition_id: edition_id,
                        supplement_id: supplement_id,
                        journalist_id: journalist_id,
                        agencies_id: agencies_id,
                        author: author,
                        news_position: news_position,
                        news_city_id: news_city_id,
                        category_id: category_id,
                        is_send: is_send,
                        keywords: keywords,
                        page_count: page_count
                    },
                    success: function(response) {
                        // Handle success response
                        console.log("Update successful", response);
                        location.reload(); // Reload the page to see the changes
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error("Update failed", status, error);
                    }
                });

                break;
            }
        }
    }
}



function updateNewsContent2(news_details_id, client_id) {
    var headline = document.getElementById('com_update_headline_' + news_details_id).value;
    var summary = document.getElementById('com_update_summary_' + news_details_id).value;

    // Debugging: Output the retrieved values to console
    console.log("Headline:", headline);
    console.log("Summary:", summary);
    var get_client_details = <?php echo json_encode($get_client_details); ?>;
    console.log("get_client_details data", get_client_details);

    // Loop through the get_client_details to find the client with the given client_id
    var clientNews = null;
    for (var i = 0; i < get_client_details.length; i++) {
        if (get_client_details[i].client_id == client_id) {
            clientNews = get_client_details[i].client_news;
            break;
        }
    }

    if (clientNews) {
        // Loop through the clientNews to find the news with the given news_details_id
        for (var j = 0; j < clientNews.length; j++) {
            if (clientNews[j].news_details_id == news_details_id) {
                // Extract the specific data you need
                var media_type_id = clientNews[j].media_type_id;
                var publication_id = clientNews[j].publication_id;
                var edition_id = clientNews[j].edition_id;
                var supplement_id = clientNews[j].supplement_id;
                var journalist_id = clientNews[j].journalist_id;
                var agencies_id = clientNews[j].agencies_id;
                var author = clientNews[j].author;
                var news_position = clientNews[j].news_position;
                var news_city_id = clientNews[j].news_city_id;
                var category_id = clientNews[j].category_id;
                var is_send = clientNews[j].is_send;
                var keywords = clientNews[j].keywords;
                var page_count = clientNews[j].page_count;

                console.log("News media_type_id:", media_type_id);
                console.log("News publication_id:", publication_id);

                // Send the extracted data through AJAX
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('NewsLetter/newsupdate'); ?>",
                    dataType: 'html',
                    data: {
                        news_details_id: news_details_id,
                        client_id: client_id,
                        headline: headline,
                        summary: summary,
                        media_type_id: media_type_id,
                        publication_id: publication_id,
                        edition_id: edition_id,
                        supplement_id: supplement_id,
                        journalist_id: journalist_id,
                        agencies_id: agencies_id,
                        author: author,
                        news_position: news_position,
                        news_city_id: news_city_id,
                        category_id: category_id,
                        is_send: is_send,
                        keywords: keywords,
                        page_count: page_count
                    },
                    success: function(response) {
                        // Handle success response
                        console.log("Update successful", response);
                        location.reload(); // Reload the page to see the changes
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error("Update failed", status, error);
                    }
                });

                break;
            }
        }
    }
}

function updateNewsContent3(news_details_id, client_id) {
    var headline = document.getElementById('industry_update_headline_' + news_details_id).value;
    var summary = document.getElementById('industry_update_summary_' + news_details_id).value;

    // Debugging: Output the retrieved values to console
    console.log("Headline:", headline);
    console.log("Summary:", summary);
    var get_client_details = <?php echo json_encode($get_client_details); ?>;
    console.log("get_client_details data", get_client_details);

    // Loop through the get_client_details to find the client with the given client_id
    var clientNews = null;
    for (var i = 0; i < get_client_details.length; i++) {
        if (get_client_details[i].client_id == client_id) {
            clientNews = get_client_details[i].client_news;
            break;
        }
    }

    if (clientNews) {
        // Loop through the clientNews to find the news with the given news_details_id
        for (var j = 0; j < clientNews.length; j++) {
            if (clientNews[j].news_details_id == news_details_id) {
                // Extract the specific data you need
                var media_type_id = clientNews[j].media_type_id;
                var publication_id = clientNews[j].publication_id;
                var edition_id = clientNews[j].edition_id;
                var supplement_id = clientNews[j].supplement_id;
                var journalist_id = clientNews[j].journalist_id;
                var agencies_id = clientNews[j].agencies_id;
                var author = clientNews[j].author;
                var news_position = clientNews[j].news_position;
                var news_city_id = clientNews[j].news_city_id;
                var category_id = clientNews[j].category_id;
                var is_send = clientNews[j].is_send;
                var keywords = clientNews[j].keywords;
                var page_count = clientNews[j].page_count;

                console.log("News media_type_id:", media_type_id);
                console.log("News publication_id:", publication_id);

                // Send the extracted data through AJAX
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('NewsLetter/newsupdate'); ?>",
                    dataType: 'html',
                    data: {
                        news_details_id: news_details_id,
                        client_id: client_id,
                        headline: headline,
                        summary: summary,
                        media_type_id: media_type_id,
                        publication_id: publication_id,
                        edition_id: edition_id,
                        supplement_id: supplement_id,
                        journalist_id: journalist_id,
                        agencies_id: agencies_id,
                        author: author,
                        news_position: news_position,
                        news_city_id: news_city_id,
                        category_id: category_id,
                        is_send: is_send,
                        keywords: keywords,
                        page_count: page_count
                    },
                    success: function(response) {
                        // Handle success response
                        console.log("Update successful", response);
                        location.reload(); // Reload the page to see the changes
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error("Update failed", status, error);
                    }
                });

                break;
            }
        }
    }
}
</script>