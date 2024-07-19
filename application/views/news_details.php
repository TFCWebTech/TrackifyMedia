<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<style>
.lightbox {
    display: none;
    position: fixed;
    z-index: 999;
    width: 100%;
    height: 100%;
    text-align: center;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.8);
}

.lightbox img {
    max-width: 90%;
    max-height: 80%;
    margin-top: 2%;
}

.lightbox:target {
    /* Show the lightbox */
    display: block;
}
.close {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 3em;
    color: #fff;
    text-decoration: none;
}

.thumbnail {
    max-width: 180px;
}

.thumbnail-wrapper {
    display: flex;
    align-items: left;
    justify-content: center;
}
body {
    background-color: #fbffdd;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
        /* CSS to temporarily hide elements */
        /* .no-pdf {
            display: none;
        } */
        /* .show_in_pdf {
            display: none;
        } */
#generatePDF {
            background-color: #0080FF ;
            color: #ffffff;
            border-color: #0080FF ;
            border-radius: 5px;
        }
        #wrapper #content-wrapper #content-2 {
    flex: 1 0 auto !important;
}
       
</style>
  <!-- Include Font Awesome for icons -->
    <!-- Include Bootstrap CSS -->
<div class="container">
    <div class="row no-pdf">
        <div class="col-md-12 text-right mb-2">
            <button id="generatePDF"> <i class="fa fa-download"></i></button>
        </div>
    </div>
    <div class="card no-pdf">
    <?php
        if (isset($news_details) && !empty($news_details)) {
        ?>
            <div class="row p-2">
                <div class="col-md-12 pt-1"> 
                    <h5 style="color:blue;"><a href="<?php echo $news_details['website_url']; ?>"><?php echo $news_details['head_line']; ?> </a></h5>
                    <label for="">Summery</label> <br>
                    <p><?php echo $news_details['summary']; ?></p>
                    <p>Publication: <span style="color:blue;"><?php echo $news_details['MediaOutlet']; ?></span> , Journalist / Agency :<span style="color:blue;"> <?php if($news_details['Journalist'] != ''){ echo $news_details['Journalist']; }else{ echo $news_details['Agency']; } ?></span> , 
                        Edition: <span style="color:blue;"><?php echo $news_details['Edition']; ?></span>, Supplement: <span style="color:blue;"><?php echo $news_details['Supplement']; ?></span>
                        <?php
                        // Check if there is a news article and get the page number
                        if (isset($news_details['news_article']) && is_array($news_details['news_article']) && !empty($news_details['news_article'])) {
                            $firstArticle = $news_details['news_article'][0]; // Get the first article
                            echo ', Page No: <span style="color:blue;">' . $firstArticle['page_no'] . '</span>';
                        }
                        ?> , Circulation Figure:<span> </span>, qAVE(Rs.) :<span> </span> Date: <span style="color:blue;"><?php echo $news_details['create_at']; ?></span></p>
                    <hr>
                </div>
            </div>
            <?php
                if (isset($news_details['news_article']) && is_array($news_details['news_article'])) {
                    foreach ($news_details['news_article'] as $index => $article) {
                        $lightboxId = "img" . $index; 
                        $imageUrl = base_url('Uploads/'.$article['artical_images_name']); // Get the image URL
                        ?>
                        <div class="row p-2 ">
                            <div class="col-md-3">
                                <?php if (!empty($article['artical_images_name'])) { ?>
                                    <div class="download-icon text-right px-4">
                                        <a href="<?php echo $imageUrl; ?>" download>
                                            <i class="fa fa-download text-primary" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="thumbnail-wrapper">
                                        <a href="#<?php echo $lightboxId; ?>" aria-label="Click to enlarge image">
                                            <img src="<?php echo $imageUrl; ?>" class="thumbnail" alt="thumbnail Image">
                                        </a>
                                    </div>
                                    <div id="<?php echo $lightboxId; ?>" class="lightbox">
                                        <a href="#" class="close">&times;</a>
                                        <img src="<?php echo $imageUrl; ?>" alt="Popup Image">
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-9 pt-1">
                                <h6><?php echo $article['news_artical']; ?></h6>
                                </p>
                            </div>
                        </div>  

                        <hr>
                        <?php
                    }
                }
                ?>
        <?php 
        }
        ?>

    <div class="card" id="content-2" style="display:none;">
        <?php
        if (isset($news_details) && !empty($news_details)) {
            ?>
            <div class="row p-2">
                <div class="col-md-12 pt-1"> 
                    <h5 style="color:blue;"><a href="<?php echo $news_details['website_url']; ?>"><?php echo $news_details['head_line']; ?> </a></h5>
                    <label for="">Summery</label> <br>
                    <p><?php echo $news_details['summary']; ?></p>
                    <p>Publication: <span style="color:blue;"><?php echo $news_details['MediaOutlet']; ?></span> , Journalist / Agency :<span style="color:blue;"> <?php if($news_details['Journalist'] != ''){ echo $news_details['Journalist']; }else{ echo $news_details['Agency']; } ?></span> , 
                        Edition: <span style="color:blue;"><?php echo $news_details['Edition']; ?></span>, Supplement: <span style="color:blue;"><?php echo $news_details['Supplement']; ?></span>
                        <?php
                        // Check if there is a news article and get the page number
                        if (isset($news_details['news_article']) && is_array($news_details['news_article']) && !empty($news_details['news_article'])) {
                            $firstArticle = $news_details['news_article'][0]; // Get the first article
                            echo ', Page No: <span style="color:blue;">' . $firstArticle['page_no'] . '</span>';
                        }
                        ?> , Circulation Figure:<span> </span>, qAVE(Rs.) :<span> </span> Date: <span style="color:blue;"><?php echo $news_details['create_at']; ?></span></p>
                    <hr>
                </div>
                 <?php
                    if (isset($news_details['news_article']) && is_array($news_details['news_article'])) {
                    foreach ($news_details['news_article'] as $index => $article) {
                        $lightboxId = "img" . $index; 
                        $imageUrl = base_url('Uploads/'.$article['artical_images_name']); // Get the image URL
                        ?>
                       
                            <div class="col-md-12 pt-1">
                                <h6><?php echo $article['news_artical']; ?></h6>
                                
                            </div>

                        <hr>
                    <?php
                    }
                 }
                ?>
            </div>
        <?php 
        }
        ?>
    </div>
    
</div>
</div>
    <!-- Include html2pdf.js -->
<script>
        lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>
   
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script>
    document.getElementById('generatePDF').addEventListener('click', function() {
        var element = document.getElementById('content-2');
        var show_in_pdf = document.querySelectorAll('#show_in_pdf');

        element.style.display = 'block';
        // Hide header and footer and show PDF-specific content
        document.querySelectorAll('.no-pdf').forEach(function(el) {
            el.style.display = 'none';
        });
        show_in_pdf.forEach(function(el) {
            el.style.display = 'block';
        });

        var opt = {
            margin: [0, 0, 0, 0],
            filename: 'document.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
            pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
        };

        html2pdf().from(element).set(opt).save().then(function() {
            // Restore header and footer and hide PDF-specific content
            document.querySelectorAll('.no-pdf').forEach(function(el) {
                el.style.display = 'block';
            });
            element.style.display = 'none';
            show_in_pdf.forEach(function(el) {
                el.style.display = 'none';
            });
        });
    });
    </script>