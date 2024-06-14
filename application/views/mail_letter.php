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
        #printButton , .send-button, #edit{
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
              <button class="send-button" href="<?php echo site_url('NewsLetter/sendMail/'.$details['client_id']);?>"> <i class="fa fa-send-o" ></i></button>
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
                                <a href="<?php echo $get_client_details[0]['trackify_link']; ?>" style="font-size:12px; color:#ffffff;">powered by trackify media</a>
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
                    <?php if (!empty($get_client_details)): ?>
                        <?php foreach ($get_client_details as $detail): ?>
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
                                        <?php echo $detail['quick_links_name']; ?> (<?php echo sizeof($detail['compititors_data']); ?>)
                                    </td>
                                    <td></td>
                                </tr>
                            <?php elseif ($detail['quick_links_position'] == '3'): ?>
                                <tr style="background-color: #DCD5D5; color: #ffffff;">
                                    <td>
                                        <?php echo $detail['quick_links_name']; ?> (<?php echo sizeof($detail['industry_data']); ?>)
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            <?php elseif ($detail['quick_links_position'] == '4'): ?>
                                <tr style="background-color: #DCD5D5; color: #ffffff;">
                                    <td>
                                        <?php echo $detail['quick_links_name']; ?> (<?php echo sizeof($detail['compititors_data']); ?>)
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            <?php elseif ($detail['quick_links_position'] == '5'): ?>
                                <tr style="background-color: #DCD5D5; color: #ffffff;">
                                    <td>
                                        <?php echo $detail['quick_links_name']; ?> (<?php echo sizeof($detail['industry_data']); ?>)
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
                    <?php
                    foreach ($get_client_details[0]['client_news'] as $key => $news) { ?>
                        <div style="display:flex; justify-content: space-between; padding:0px 10px 0px 0px;">
                            <h5>
                                <a href="<?php echo site_url('NewsLetter/DisplayNews/'.$news['news_details_id']);?>" style="color: <?php echo $get_client_details[0]['content_headline_color']; ?>;font-size: <?php echo $get_client_details[0]['content_headline_font_size']; ?>;font-family: <?php echo $get_client_details[0]['content_headline_font']; ?>">  <?php echo $news['head_line']; ?> </a>
                            </h5>
                            <h6 class="showEdit">
                                <div style="d-flex">
                                        <a onclick="hideNews('<?php echo $news['news_details_id'];?>', '<?php echo $details['client_id'];?>') " > Hide</a> | 
                                        <a style="color:red;" onclick="deleteNews('<?php echo $news['news_details_id'];?>', '<?php echo $details['client_id'];?>') ">Delete</a>
                                </div>
                            </h6>
                        </div>
                    
                         <h6 >Summary:</h6>
                            <p style="color: <?php echo $get_client_details[0]['content_news_summary_color']; ?>;font-size: <?php echo $get_client_details[0]['content_news_summary_font_size']; ?>;">
                            <?php echo $news['summary']; ?>
                            </p>
                            <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?> ,
                                Publication :<span style="color:blue;"> <?php echo $news['publication_id']; ?></span>, Journalist / Agency :<span style="color:blue;"> <?php echo $news['journalist_id']; ?></span>  , 
                                Edition : <span style="color:blue;"> <?php echo $news['edition_id']; ?> </span>,  Supplement : <span style="color:blue;"> <?php echo $news['supplement_id']; ?> </span>, No of pages:<span style="color:blue;"> <?php echo $news['page_count']; ?></span> , Circulation Figure:<span> </span>, qAVE(Rs.) :<span> </span> </p>                   
                         <hr>
                    <?php }
                    ?>
                </div>
                <div class="body-content" style="padding:10px 15px 0px 15px;">
                    <h4 style="background-color: #cfbbbb; color: #ffffff; padding:4px;"> Competition</h4>
                </div>
                <?php 
                foreach ($get_client_details[0]['compititors_data'] as $key => $compititor) { ?>
                    <div class="body-content" style="padding:10px 15px 0px 15px;">
                        <h4 style="background-color: #cfbbbb; color: #ffffff; padding:4px;"> <?php echo $compititor['Competitor_name']; ?></h4>
                        <?php
                        foreach ($compititor['news'] as $key => $news) { ?>
                            <h5 ><a href="<?php echo site_url('NewsLetter/DisplayNews/'.$news['news_details_id']);?>" style="color: <?php echo $get_client_details[0]['content_headline_color']; ?>;font-size: <?php echo $get_client_details[0]['content_headline_font_size']; ?>;font-family: <?php echo $get_client_details[0]['content_headline_font']; ?>">  <?php echo $news['head_line']; ?> </a></h5>
                             <h6 >Summary:</h6>
                                <p style="color: <?php echo $get_client_details[0]['content_news_summary_color']; ?>;font-size: <?php echo $get_client_details[0]['content_news_summary_font_size']; ?>;">
                                <?php echo $news['summary']; ?>
                                </p>
                                <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?> ,
                                    Publication :<span style="color:blue;"> <?php echo $news['publication_id']; ?></span>, Journalist / Agency :<span style="color:blue;"> <?php echo $news['journalist_id']; ?></span>  , 
                                    Edition : <span style="color:blue;"> <?php echo $news['edition_id']; ?> </span>,  Supplement : <span style="color:blue;"> <?php echo $news['supplement_id']; ?> </span>, No of pages:<span style="color:blue;"> <?php echo $news['page_count']; ?></span> , Circulation Figure:<span> </span>, qAVE(Rs.) :<span> </span> </p>                   
                         <hr>
                        <?php }
                        ?>
                    </div>
                <?php }
                ?>
                    <div class="body-content" style="padding:10px 15px 0px 15px;">
                    <h4 style="background-color: #cfbbbb; color: #ffffff; padding:4px;"> Industry</h4>
                </div>
                <?php 
                foreach ($get_client_details[0]['industry_data'] as $key => $Industry) { ?>
                    <div class="body-content" style="padding:10px 15px 0px 15px;">
                        <h4 style="background-color: #cfbbbb; color: #ffffff; padding:4px;"> <?php echo $Industry['Industry_name']; ?></h4>

                        <?php
                        foreach ($compititor['news'] as $key => $news) { ?>
                            <h5 ><a href="<?php echo site_url('NewsLetter/DisplayNews/'.$news['news_details_id']);?>" style="color: <?php echo $get_client_details[0]['content_headline_color']; ?>;font-size: <?php echo $get_client_details[0]['content_headline_font_size']; ?>;font-family: <?php echo $get_client_details[0]['content_headline_font']; ?>">  <?php echo $news['head_line']; ?> </a></h5>
                             <h6 >Summary:</h6>
                                <p style="color: <?php echo $get_client_details[0]['content_news_summary_color']; ?>;font-size: <?php echo $get_client_details[0]['content_news_summary_font_size']; ?>;">
                                <?php echo $news['summary']; ?>
                                </p>
                                <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?> ,
                                    Publication :<span style="color:blue;"> <?php echo $news['publication_id']; ?></span>, Journalist / Agency :<span style="color:blue;"> <?php echo $news['journalist_id']; ?></span>  , 
                                    Edition : <span style="color:blue;"> <?php echo $news['edition_id']; ?> </span>,  Supplement : <span style="color:blue;"> <?php echo $news['supplement_id']; ?> </span>, No of pages:<span style="color:blue;"> <?php echo $news['page_count']; ?></span> , Circulation Figure:<span> </span>, qAVE(Rs.) :<span> </span> </p>                   
                         <hr>
                        <?php }
                        ?>
                    </div>
                <?php }
                ?>

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


<script>
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