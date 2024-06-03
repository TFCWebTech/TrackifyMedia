<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    .container{
        border: 1px solid #c3c3c3;
    }
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
    border: 1px solid #c3c3c3;
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
</style>
</head>
<?php 
// echo "<pre>" ;
// print_r($news_details);
// echo "</pre>";
?>
<?php if (!empty($news_details)) { ?>
    <?php foreach ($news_details as $news) { ?>
        <?php $client_templates = $news['client_templates'][0]; // Assuming there's only one template per news ?>

<div class="container" >
    <div class="card" style="padding:10px;">
        <div class="row">
                <div class="header" style="background-color:#<?php echo $client_templates['header_background_color'];?> ;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"> <img src="<?php echo base_url('assets/img/logo.png');?>" alt="logo" style="width:100px;"> <br>
                            <?php 
                            if($client_templates['trackify_link_status'] == 0 ){?>
                            <a href="" style="font-size:#<?php echo $client_templates['menu_font_size'];?> ;">powered by trackify media</a></td>
                            <?php } ?>
                            <td align="center">
                                <a href=""> <h5 style="color: #<?php echo $client_templates['menu_font_color']; ?>; font-size:<?php echo $client_templates['menu_font_size'];?>px ;"><?php echo $data?></a> <br>
                                <span style="color: #<?php echo $client_templates['menu_font_color']; ?>; display:block;">Saturday, May 25, 2024 <br>
                                <span style="font-size:12px;">  0 News / <a href=""> view consolidated</a></span>
                                </span>
                            </h5>
                            </td>
                            <td align="right"> 
                                <!-- <img src="<?php echo base_url('assets/img/logo.png');?>" alt="logo" style="width:100px;"> -->
                            </td>
                        </tr>
                    </table>
                </div>    
            
                <div class="body-content" style="background-color:#<?php echo $client_templates['menu_font_color']; ?>;">
                <h2 style="padding-left: 5px;"><a href>  <?php echo $news['head_line'];?></a></h2>
                    <?php if (!empty($news['news_article_data'])) { ?>
                        <?php foreach ($news['news_article_data'] as $articleGroup) { ?>
                            <?php if (!empty($articleGroup['articles'])) { ?>
                                <?php foreach ($articleGroup['articles'] as $articleData) { ?>
                                    <div class="col-md-12 mt-3">
                                            <p style="color:#<?php echo $client_templates['content_news_summary_color'];?>; font-size: <?php echo $client_templates['content_news_summary_font_size'];?>px; ">
                                                <?php echo $articleData['news_artical'];?>
                                            </p>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="col-md-12 mt-3">
                                    <p>No article data available.</p>
                                   
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="col-md-12 mt-3">
                            <p>No article data available.</p>
                           
                        </div>
                    <?php } ?>
                </div>
                    
            
            <div class="col-md-12" style="background-color:#<?php echo $client_templates['footer_background_color'];?> ;">
                <div class="d-flex justify-content-between" >
                        <div class="logo" style="text-align:left; ">
                            <?php 
                             if($client_templates['footer_logo_position'] == 'Left'){
                                ?>
                                <img src="<?php echo base_url('assets/img/logo.png');?>" alt="logo" style="width:100px;  padding:5px;"> <br>
                                <?php 
                             }
                             ?>
                        </div>
                    <div class="footer" style="text-align:center; ">
                    <?php 
                             if($client_templates['footer_logo_position'] == 'Center'){
                                ?>
                                <img src="<?php echo base_url('assets/img/logo.png');?>" alt="logo" style="width:100px;  padding:5px;"> <br>
                                <?php 
                             }
                             ?>
                    </div>
                    <div class="footer" style="text-align:end;">
                    <?php 
                             if($client_templates['footer_logo_position'] == 'Right'){
                                ?>
                                <img src="<?php echo base_url('assets/img/logo.png');?>" alt="logo" style="width:100px;  padding:5px;"> <br>
                                <?php 
                             }
                             ?>
                    </div>
                </div>
                <p style="font-size:<?php echo $client_templates['footer_title_font_size'];?>px;">This is an auto generated email – please do not reply to this email id</p>
            </div>
        </div>
    </div>
</div>

</div>
<?php } ?>
            <?php } else { ?>
                <p>No news available.</p>
            <?php } ?>