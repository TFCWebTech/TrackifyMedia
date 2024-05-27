<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .modal-footer{
        justify-content: flex-start !important; 
        display: block !important;
    }
.pointer{
cursor:pointer;
}
select.form-control[multiple], select.form-control[size] {
    height: 114px !important;
}
.select2-container{
	width:100% !important;
}
.select2 {
	width:100% !important;
}	
</style>

<div class="container">
    <!-- <div class="d-flex justify-content-end">
            <div class="d-flex text-right p-1 ">
                        <input type="date" class="form-control m-1" placeholder="Enter Headline">
                        <button class="btn btn-primary m-1">Search</button>
            </div>
        </div> -->
         <?php if (!empty($getAllNews)): ?>
          <div class="row">
          <?php foreach ($getAllNews as $news): ?>
                  <div class="col-md-6">
                      <div class="card shadow mb-4">
                          <div class="card-header py-3">
                              <h6 class="m-0 font-weight-bold text-primary"><?php echo $news['head_line']; ?></h6>
                          </div>
                          <div class="card-body">
                              <?php if (!empty($news['news_article_data'])):
                                  foreach ($news['news_article_data'] as $article): ?>
                                      <p id="dynamicContent">
                                          <?php
                                          // Get the news article content
                                          $news_article = $article['news_artical'];
                                          // Remove HTML tags from the content
                                          $plain_text = strip_tags($news_article);
                                          // Decode HTML entities
                                          $decoded_text = html_entity_decode($plain_text, ENT_QUOTES | ENT_HTML5);
                                          // Split the content into an array of words
                                          $words = explode(' ', $decoded_text);
                                          // Get the first 20 words
                                          $first_20_words = array_slice($words, 0, 20);
                                          // Join the first 20 words back into a string
                                          $shortened_content = implode(' ', $first_20_words);
                                          // Display the shortened content with an ellipsis
                                          echo htmlspecialchars($shortened_content) . '...';
                                          ?>
                                      </p>
                                      <br>
                                      <p><?php echo $news['keywords']; ?>&nbsp;<a class="text-primary" data-toggle="modal" data-target="#addKeywords" onclick="addKeywords('<?php echo $news['news_details_id']; ?>')"><u><i class="fa fa-plus-circle"></i></u></a></p>
                                      <?php if ($this->session->userdata('user_type') == 'Admin'): ?>
                                          <p><span class="text-primary">Clients Finds: </span>&nbsp;
                                          <?php echo $news['client_names']; ?> <i class="fa fa-eye cursor" data-toggle="modal" data-target="#tatamoters"></i> &nbsp;
                                              <a class="text-primary" data-toggle="modal" data-target="#addClients" onclick="addClients('<?php echo $article['news_details_id']; ?>')"><u>edit clients</u></a>
                                          </p>
                                      <?php endif; ?>
                                      <div class="d-flex justify-content-end ">
                                          <?php if ($this->session->userdata('user_type') == 'Admin'): ?>
                                              <div class="m-1">
                                                  <button class="btn btn-success" href="<?php echo site_url('EmailTemplate/'.$news['news_details_id']);?>">Preview Mail</button>
                                              </div>
                                          <?php endif; ?>
                                          <div class="m-1">
                                              <a class="btn " href="<?php echo site_url('ManageNews/EditNews/'.$news['news_details_id']);?>"><i class="fa fa-edit" style="font-size:24px"></i></a>
                                          </div>
                                      </div>
                                  <?php endforeach;
                              endif; ?>
                          </div>
                      </div>
                  </div>
              <?php endforeach; ?>

          </div>
      <?php else: ?>
          <div class="text-center">
              <h4>No Record Found!</h4>
          </div>
      <?php endif; ?>
</div>

<!-- The Modal -->
<div class="modal" id="tatamoters">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:#f5f9ff;">

      <!-- Modal Header -->
      <div class="modal-header ">
        <!-- <h4 class="modal-title text-light">TATA Moters</h4> -->
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <h4 class="text-primary">Show Email Tempalte</h4>
      </div>
    </div>
  </div>
</div>
<!-- The Modal -->
<div class="modal" id="addKeywords">
  <div class="modal-dialog ">
    <div class="modal-content" >
      <!-- Modal Header -->
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-light">Edit Keywords</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
      <form action="<?php echo site_url('NewsUpload/addKeywords');?>" method="post">
        <div class="row">
          <div class="col-md-12">
            <input type="text" id="remove_news_details_id" name="news_details_id" hidden>
            <label class="pl-1 font-weight-normal" for="Sub">Add / Edit Keywords</label>
            <textarea name="newKeywords" class="form-control" id="newKeywords" rows="7" ></textarea>
          </div>
          <div class="col-md-12 text-right mt-2">
            <button type="submit" class="btn btn-primary">UPDATE</button>
          </div>
        </div>
      </form>
      </div>
        
    </div>
  </div>
</div>  

<div class="modal" id="addClients">
  <div class="modal-dialog ">
    <div class="modal-content" >

      <!-- Modal Header -->
      <div class="modal-header bg-primary">
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <form action="<?php echo site_url('NewsUpload/addClients');?>" method="post">
          <div class="row">
            <div class="col-md-12">
              <input type="text" id="news_details_id" name="news_details_id" hidden>
              <label class=" font-weight-normal" for="Sub">Clients</label>
              <select class="js-example-basic-multiple form-control" name="client_name[]" id="client_name" multiple="multiple">
                <option disabled>Select</option>
                <?php foreach($get_clients as $values) { ?>
                    <option value="<?php echo $values['client_id']; ?>"> <?php echo $values['client_name']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12 text-right mt-2">
              <button class="btn btn-primary">SAVE</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>

function addClients(news_details_id) {
            var news_artical = <?php echo json_encode($getAllNews); ?>;
            console.log(news_details_id);
            var desiredNewsArtical = null;
            
            for (var i = 0; i < news_artical.length; i++) {
                if (news_artical[i].news_details_id == news_details_id) {
                    desiredNewsArtical = news_artical[i];
                    break;
                }
            }
            $('#news_details_id').val(desiredNewsArtical.news_details_id);
            if (desiredNewsArtical) {
                var clientIdsString = desiredNewsArtical.client_id; // This is a string like "1, 3"
                var clientIds = clientIdsString.split(',').map(id => id.trim());

                // Clear previous selections
                $("#client_name").val(null).trigger("change");

                // Set new selections
                $("#client_name").val(clientIds).trigger("change");
            } else {
                console.error("No matching news article found for ID:", news_details_id);
            }
        }

   
        function addKeywords(news_details_id){
          console.log(news_details_id);
          var news_artical = <?php echo json_encode($getAllNews); ?>;
          console.log(news_artical);
            var desiredNewsArtical = null;
            for (var i = 0; i < news_artical.length; i++) {
                if (news_artical[i].news_details_id == news_details_id) {
                    desiredNewsArtical = news_artical[i];
                    break;
                }
            }
            console.log(desiredNewsArtical);
          $('#remove_news_details_id').val(desiredNewsArtical.news_details_id);
          $('#newKeywords').val(desiredNewsArtical.keywords);
        }

</script>

</div>

            <!-- End of Main Content -->    