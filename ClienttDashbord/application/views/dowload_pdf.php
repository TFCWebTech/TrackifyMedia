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
<div class="containers" style="background-color: #F9F9F9;">
    <div class="card">
        <table width="100%" cellpadding="0" cellspacing="0" style="width:100%; background-color: ; margin-top:10px;">
            <tr>
                <td align="left" style="padding-top:50px; margin-right:5px;">   
                    <img src="https://pressbro.com/News/assets/img/mediaLogo.png" alt="logo" style="width:60px;"><br>
                </td>
                <td align="center" style="margin-top:5px;">
                    <?php echo $details['client_name']; ?>
                </td>
                <td align="right"></td>
            </tr>
        </table>
        <hr>
        <h4 style="background-color: #F1DAD5; color: #ffffff; padding:4px;"></h4>
        <?php
        if (!empty($get_client_details)) {
            foreach ($get_client_details as $news) {
                ?>
                <h3 >
                    <a href="<?php echo $news['website_url']; ?>">
                        <?php echo $news['head_line']; ?>
                    </a>
                </h3>
                <p>
                    Date: <span style="color:blue;"><?php echo date('d-m-Y', strtotime($news['create_at'])); ?></span>,
                    Publication: <span style="color:blue;"><?php echo $news['MediaOutlet']; ?></span>,
                    Journalist / Agency: <span style="color:blue;"><?php echo $news['Journalist']; ?></span>,
                    Edition: <span style="color:blue;"><?php echo $news['Edition']; ?></span>,
                    Supplement: <span style="color:blue;"><?php echo $news['Supplement']; ?></span>,
                    No of pages: <span style="color:blue;"><?php echo $news['page_count']; ?></span>,
                    Circulation Figure: <span></span>,
                    qAVE(Rs.): <span></span>
                </p>
                <p>Summary:</p>
                <span>
                    <?php 
                    if (!empty($news['News_artical'])) {
                        foreach ($news['News_artical'] as $article) {
                            echo '<p>' . $article['news_artical'] . '</p>';
                        }
                    }
                    ?> 
                </span>
                <hr>
                <?php
            }
        } else {
            ?>
            <p>No record found</p>
            <?php
        }
        ?>
    </div>
</div>