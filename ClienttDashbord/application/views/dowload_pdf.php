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
</style>
</head>
<div class="containers">
            <div class="card" style="background-color: #F9F9F9;">
                <!-- <div class="header" style="background-color: <?php echo $get_client_details[0]['header_background_color']; ?>; margin-top:10px; "> -->
                    <table width="100%" cellpadding="0" cellspacing="0" style="width:100%; background-color: <?php echo $get_client_details[0]['header_background_color']; ?>; margin-top:10px; ">
                        <tr>
                            <td align="left" style="padding-top:50px; margin-right:5px;">   
                            <?php 
                            if ($get_client_details[0]['logo_position'] == 'Left') { ?>
                                <img src="<?php echo $get_client_details[0]['header_logo_url']; ?>" alt="logo" style="width:80px; padding-top:10px;"> <br>
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
                <!-- </div>     -->
                <table style="border-collapse: collapse; width: 100%; border: 1px solid black;">
    <tr style="background-color: #6D6B6B; color: #ffffff;">
        <th style="border: 1px solid black; padding: 8px;">Quick Links</th>
        <th style="border: 1px solid black; padding: 8px;">Access Other Services</th>
    </tr>
    <?php if (!empty($get_client_details)): ?>
        <?php foreach ($get_client_details as $detail): ?>
            <?php if (!empty($detail['quick_links'])): ?>
                <?php foreach ($detail['quick_links'] as $link): ?>
                    <?php if ($link['quick_links_position'] == '1'): ?>
                        <tr style="background-color: #DCD5D5; color: #000000; border: 1px solid black;">
                            <td style="border: 1px solid black; padding: 2px;">
                                <?php echo $link['quick_links_name']; ?>
                            </td>
                            <td style="border: 1px solid black; padding: 2px;"><a href="<?php echo site_url('ClienttDashbord/');?>">Login</a></td>
                        </tr>
                    <?php elseif ($link['quick_links_position'] == '2'): ?>
                        <tr style="background-color: #DCD5D5; color: #000000; border: 1px solid black;">
                            <td style="border: 1px solid black; padding: 8px;">
                                <?php echo $link['quick_links_name']; ?> (<?php echo sizeof($detail['compititors_data']); ?>)
                            </td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                        </tr>
                    <?php elseif ($link['quick_links_position'] == '3'): ?>
                        <tr style="background-color: #DCD5D5; color: #000000; border: 1px solid black;">
                            <td style="border: 1px solid black; padding: 8px;">
                                <?php echo $link['quick_links_name']; ?> (<?php echo sizeof($detail['industry_data']); ?>)
                            </td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                        </tr>
                    <?php elseif ($link['quick_links_position'] == '4'): ?>
                        <tr style="background-color: #DCD5D5; color: #000000; border: 1px solid black;">
                            <td style="border: 1px solid black; padding: 8px;">
                                <?php echo $link['quick_links_name']; ?> (<?php echo sizeof($detail['compititors_data']); ?>)
                            </td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                        </tr>
                    <?php elseif ($link['quick_links_position'] == '5'): ?>
                        <tr style="background-color: #DCD5D5; color: #000000; border: 1px solid black;">
                            <td style="border: 1px solid black; padding: 8px;">
                                <?php echo $link['quick_links_name']; ?> (<?php echo sizeof($detail['industry_data']); ?>)
                            </td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                        </tr>
                    <?php elseif ($link['quick_links_position'] == '6'): ?>
                        <tr style="background-color: #DCD5D5; color: #000000; border: 1px solid black;">
                            <td style="border: 1px solid black; padding: 8px;">
                                <?php echo $link['quick_links_name']; ?> (<?php echo sizeof($detail['compititors_data']); ?>)
                            </td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <tr style="background-color: #DCD5D5; color: #000000; border: 1px solid black;">
        <td style="border: 1px solid black; padding: 8px;"></td>
        <td style="border: 1px solid black; padding: 8px;"><a href="mailto:Customerservice@trackify.info">Customerservice@trackify.info</a></td>
    </tr>
</table>
                    <h4 style="background-color: #F1DAD5; color: #ffffff; padding:4px;">
                    <?php echo isset($get_client_details[0]['client_name']) ? $get_client_details[0]['client_name'] : 'Client Name'; ?>
                    </h4>
                    <?php
                    if (!empty($get_client_details)) {
                        foreach ($get_client_details as $detail) {
                            if (!empty($detail['client_news'])) {
                                foreach ($detail['client_news'] as $news) {
                                    ?>
                                    <h5>
                                        <a href="<?php echo site_url('ClienttDashbord/Home/DisplayNews/' . $news['news_details_id']); ?>"
                                        style="color: <?php echo $detail['content_headline_color']; ?>;
                                                font-size: <?php echo $detail['content_headline_font_size']; ?>px;
                                                font-family: <?php echo $detail['content_headline_font']; ?>">
                                                <?php echo $news['head_line']; ?>
                                        </a>
                                    </h5>
                                    <p>Summary: </p>
                                    <span style="color: <?php echo $detail['content_news_summary_color']; ?>;
                                            font-size: 12px;">
                                            <?php echo $news['summary']; ?> 
                                        </span>
                                    <!-- </p> -->
                                    <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?>,
                                        Publication: <span style="color:blue;"><?php echo $news['MediaOutlet']; ?></span>,
                                        Journalist / Agency: <span style="color:blue;"><?php echo $news['Journalist']; ?></span>,
                                        Edition: <span style="color:blue;"><?php echo $news['Edition']; ?></span>,
                                        Supplement: <span style="color:blue;"><?php echo $news['Supplement']; ?></span>,
                                        No of pages: <span style="color:blue;"><?php echo $news['page_count']; ?></span>,
                                        Circulation Figure: <span></span>,
                                        qAVE(Rs.): <span></span>
                                    </p>
                                    <hr>
                                <?php }
                            } else {
                                echo '<p>No client news available.</p>';
                            }
                        }
                    }
                    ?>

            <h4 style="background-color: #F1DAD5; color: #ffffff; padding:4px;">Competition</h4>
            <?php 
            if (!empty($get_client_details[0]['compititors_data'])) {
                foreach ($get_client_details[0]['compititors_data'] as $competitor) { ?>
                    <div class="body-content" style="padding:2px 2px 0px 2px;">
                        <h4 style="background-color: #6D6B6B; color: #ffffff; padding:4px;">
                            <?php echo $competitor['Competitor_name']; ?>
                        </h4>
                        <?php
                        if (!empty($competitor['news'])) {
                            foreach ($competitor['news'] as $news) { 
                                ?>
                                <h5>
                                    <a href="<?php echo site_url('ClienttDashbord/Home/DisplayNews/' . $news['news_details_id']); ?>"
                                    style="color: <?php echo $get_client_details[0]['content_headline_color']; ?>;
                                            font-size: <?php echo $get_client_details[0]['content_headline_font_size']; ?>;
                                            font-family: <?php echo $get_client_details[0]['content_headline_font']; ?>">
                                        <?php echo $news['head_line']; ?>
                                    </a>
                                </h5>
                                <p>Summary:</p>
                                <span style="color: <?php echo $get_client_details[0]['content_news_summary_color']; ?>;
                                        font-size:  12px;">
                                    <?php echo $news['summary']; ?> </span>
                                <!-- </p> -->
                                <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?>,
                                    Publication: <span style="color:blue;"><?php echo $news['MediaOutlet']; ?></span>,
                                    Journalist / Agency: <span style="color:blue;"><?php echo $news['Journalist']; ?></span>,
                                    Edition: <span style="color:blue;"><?php echo $news['Edition']; ?></span>,
                                    Supplement: <span style="color:blue;"><?php echo $news['Supplement']; ?></span>,
                                    No of pages: <span style="color:blue;"><?php echo $news['page_count']; ?></span>,
                                    Circulation Figure: <span></span>,
                                    qAVE(Rs.): <span></span>
                                </p>
                                <hr>
                            <?php }
                        }
                        ?>
                    </div>
                <?php }
            }
            ?>
                <h4 style="background-color: #F1DAD5; color: #ffffff; padding:4px;">Industry</h4>
                <?php 
                if (!empty($get_client_details[0]['industry_data'])) {
                    foreach ($get_client_details[0]['industry_data'] as $industry) { ?>
                        <div class="body-content" style="padding:1px 1px 0px 1px;">
                            <h4 style="background-color: #6D6B6B; color: #ffffff; padding:4px;">
                                <?php echo $industry['Industry_name']; ?>
                            </h4>
                            <?php
                            if (!empty($industry['news'])) {
                                foreach ($industry['news'] as $news) { ?>
                                    <h5>
                                        <a href="<?php echo site_url('ClienttDashbord/Home/DisplayNews/' . $news['news_details_id']); ?>"
                                        style="color: <?php echo $get_client_details[0]['content_headline_color']; ?>;
                                                font-size: <?php echo $get_client_details[0]['content_headline_font_size']; ?>px;
                                                font-family: <?php echo $get_client_details[0]['content_headline_font']; ?>">
                                            <?php echo $news['head_line']; ?>
                                        </a>
                                    </h5>
                                    <h6>Summary:</h6>
                                    <p style="color: <?php echo $get_client_details[0]['content_news_summary_color']; ?>;
                                            font-size: <?php echo $get_client_details[0]['content_news_summary_font_size']; ?>px;">
                                        <?php echo $news['summary']; ?>
                                    </p>
                                    <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?>,
                                        Publication: <span style="color:blue;"><?php echo $news['MediaOutlet']; ?></span>,
                                        Journalist / Agency: <span style="color:blue;"><?php echo $news['Journalist']; ?></span>,
                                        Edition: <span style="color:blue;"><?php echo $news['Edition']; ?></span>,
                                        Supplement: <span style="color:blue;"><?php echo $news['Supplement']; ?></span>,
                                        No of pages: <span style="color:blue;"><?php echo $news['page_count']; ?></span>,
                                        Circulation Figure: <span></span>,
                                        qAVE(Rs.): <span></span>
                                    </p>
                                    <hr>
                                <?php }
                            }
                            ?>
                        </div>
                    <?php }
                }
                ?>
                <table style="background-color: <?php echo $get_client_details[0]['footer_background_color']; ?>; margin-top:10px;">
                    <tr>
                        <td>
                            <?php 
                                if ($get_client_details[0]['footer_logo_position'] == 'Left') { ?>
                                    <img src="<?php echo $get_client_details[0]['footer_logo_url']; ?>" alt="logo" style="width:100px;  padding:5px;"> <br>
                                <?php }
                                ?>
                        </td>
                        <td>
                            <?php 
                            if ($get_client_details[0]['footer_logo_position'] == 'Center') { ?>
                                <img src="<?php echo $get_client_details[0]['footer_logo_url']; ?>" alt="logo" style="width:100px;  padding:5px;"> <br>
                            <?php }
                            ?>
                        </td>
                        <td >
                            <?php 
                            if ($get_client_details[0]['footer_logo_position'] == 'Right') { ?>
                                <img src="<?php echo $get_client_details[0]['footer_logo_url']; ?>" alt="logo" style="width:100px;  padding:5px;"> <br>
                            <?php }
                            ?>
                        </td>
                    </tr>
                </table>
                <p><span style="color:red; font-weight:bold;">This is an auto generated email – please do not reply to this email id</span></p>
        </div>
    </div>
</div>