
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
</style>
</style>
<div class="container">
    <div class="card">
        <?php
        // Print the entire structure for debugging
        // echo '<pre>';
        // print_r($news_details);
        // echo '</pre>';
        if (isset($news_details) && !empty($news_details)) {
            ?>
            <div class="row p-2">
                <div class="col-md-12 pt-1 ">
                    <h5 style="color:blue;"><?php echo $news_details['head_line']; ?></h5>
                    <p><?php echo $news_details['summary']; ?></p>
                    <hr>
                </div>
            </div>
            <?php
                if (isset($news_details['news_article']) && is_array($news_details['news_article'])) {
                    foreach ($news_details['news_article'] as $index => $article) {
                        $lightboxId = "img" . $index; 
                        $imageUrl = base_url('Uploads/'.$article['artical_images_name']); // Get the image URL
                        ?>
                        <div class="row p-2">
                            <div class="col-md-3">
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
                            </div>
                            <div class="col-md-9 pt-1">
                                <h6><?php echo $article['news_artical']; ?></h6>
                                <p>Page No:  <span style="color:blue;"><?php echo $article['page_no']; ?></span> </p>
                            </div>
                        </div>
                        <hr>
                        <?php
                    }
                }
                ?>
                
            <div class="row p-2">
                <div class="col-md-12 px-5">
                    <p>Publication: <span style="color:blue;"><?php echo $news_details['MediaOutlet']; ?></span> , Journalist: <span style="color:blue;"><?php echo $news_details['Journalist']; ?></span> , 
                    Edition: <span style="color:blue;"><?php echo $news_details['Edition']; ?></span>, Supplement: <span style="color:blue;"><?php echo $news_details['Supplement']; ?></span> , Agencies: <span style="color:blue;"><?php echo $news_details['Journalist']; ?></span> , Date: <span style="color:blue;"><?php echo $news_details['create_at']; ?></span></p>
                </div>
            </div>
        <?php 
        }
        ?>
    </div>
</div>

<script>
        lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>