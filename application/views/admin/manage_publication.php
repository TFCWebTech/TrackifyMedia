
<!-- Include the necessary CSS and JS libraries for DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<style>
table.dataTable th,
table.dataTable td {
  white-space: nowrap;
}
.dataTables_wrapper .dataTables_filter input, .dataTables_wrapper .dataTables_length select{
padding: 2px !important;
margin-bottom: 5px !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button{
    padding: .2em .3em !important;
}
.form-group {
    margin-bottom: 0rem !important;
}
.modal-body{
    padding: 0rem .5rem .5rem .5rem  !important;
}
/* @media (min-width: 768px) { */
        .table-container-responsive{
            overflow-x: auto;
        }
    /* } */
</style>
<div class="container">
        <div class="row">
            <div class="col-md-12 text-right p-2">
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Publication</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" >
                <div class="table-container-responsive">
                <table class="table table-bordered table-hover ">
                <thead >
                <tr>
                    <th>Publication Name</th>
                    <th>MediaType</th>
                    <th>Publication Type</th>
                    <th>Tier Type</th>
                    <th>Publication Language</th>
                    <th>Master head</th>
                    <th>Priority</th>
                    <th>Newspaper Short Name</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                foreach($get_publication_data as $values){ ?>
                <tr>
                    <td><?php echo $values['MediaOutlet'];?></td>
                    <td><?php echo $values['MediaType'];?></td>
                    <td><?php echo $values['PublicationType'];?></td>
                    <td><?php echo $values['gidTier'];?></td>
                    <td><?php echo $values['Language'];?></td>
                    <td><?php echo $values['Masthead'];?></td>
                    <td><?php echo $values['Priority'];?></td>
                    <td><?php echo $values['ShortName'];?></td>
                    <td><?php echo $values['Status'];?></td>
                    <td><?php echo $values['CreatedOn'];?></td>
                    <td><?php echo $values['CreatedBy'];?></td>
                    <td>
                    &nbsp; <a data-toggle="modal" data-target="#updatePublication" onclick="updatedPublication('<?php echo $values['gidMediaOutlet'];?>')"><i class="fa fa-edit text-primary"></i> </a> &nbsp; 
                        <!-- <i class="fa fa-trash text-danger" ></i> -->  
                    </td>
                </tr>
                    <?php } ?>

                </tbody>
            
            </table>
            </div>
        </div>
</div></div>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Publication</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <form action="<?php echo site_url('ManagePublication/addPublication')?>" method="post">
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Publication Name </label>
                    <input type="text" class="form-control" placeholder="Enter Publication Name" name="publiction_name" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Media Type </label>
                  <select class="form-control" name="get_media_type" id=""> 
                    <option value="">Select</option>
                    <?php foreach($get_media_type as $values){?>
                    <option value="<?php echo $values['gidMediaType'];?>"> <?php echo $values['MediaType'];?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Publication Type </label>
                    <select class="form-control" name="publication_type" id=""> 
                    <option value="">Select</option>
                    <?php foreach($get_publication_type as $values){?>
                    <option value="<?php echo $values['gidPublicationType'];?>"> <?php echo $values['PublicationType'];?></option>
                    <?php }?>
                    </select>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Tier Type </label>
                  <select class="form-control" name="tier_type" id="">
                    <option value="">Select</option>
              
                  </select>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Publication Language </label>
                  <select class="form-control" name="publication_language" id="">
                    <option value="">Select</option>
              
                  </select>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Master Head </label>
                    <input type="text" class="form-control" placeholder="Enter Master Head" name="master_head" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Priority  </label>
                    <input type="text" class="form-control" placeholder="Enter Priority " name="priority" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Newspaper Short Name </label>
                    <input type="text" class="form-control" placeholder="Enter Newspaper Short Name" name="short_name" required>
                </div>
                <div class="text-right pt-2">
                 <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
      </div>

    </div>
  </div>
</div>


<!-- The Modal -->
<div class="modal" id="updatePublication">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Publication</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <form action="<?php echo site_url('ManagePublication/updatedPublication')?>" method="post">
                <div class="form-group">
                    <input type="text" name="gidMediaOutlet_id" id="gidMediaOutlet_id" hidden>
                    <label class="px-1 font-weight-bold" for="user_type">Publication Name </label>
                    <input type="text" class="form-control" placeholder="Enter Publication Name" id="publiction_name" name="publiction_name" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Media Type </label>
                  <select class="form-control" name="get_media_type" id="get_media_type"> 
                    <option value="">Select</option>
                    <?php foreach($get_media_type as $values){?>
                    <option value="<?php echo $values['gidMediaType'];?>"> <?php echo $values['MediaType'];?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Publication Type </label>
                    <select class="form-control" name="publication_type" id="publication_type"> 
                    <option value="">Select</option>
                    <?php foreach($get_publication_type as $values){?>
                    <option value="<?php echo $values['gidPublicationType'];?>"> <?php echo $values['PublicationType'];?></option>
                    <?php }?>
                    </select>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Tier Type </label>
                  <select class="form-control" name="tier_type" id="tier_type">
                    <option value="">Select</option>
              
                  </select>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Publication Language </label>
                  <select class="form-control" name="publication_language" id="publication_language">
                    <option value="">Select</option>
              
                  </select>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Master Head </label>
                    <input type="text" class="form-control" placeholder="Enter Master Head" name="master_head" id="master_head" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Priority  </label>
                    <input type="text" class="form-control" placeholder="Enter Priority " name="priority" id="priority" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Newspaper Short Name </label>
                    <input type="text" class="form-control" placeholder="Enter Newspaper Short Name" name="short_name" id="short_name" required>
                </div>
                <div class="text-right pt-2">
                 <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
      </div>

    </div>
  </div>
</div>


<script>
  function updatedPublication(gidMediaOutlet) {
    var get_publication_data = <?php echo json_encode($get_publication_data); ?>;
    var desiredTask = null;

    // Loop through get_publication_data array
    for (var i = 0; i < get_publication_data.length; i++) {
        // Check if the current object's gidMediaOutlet matches the desired gidMediaOutlet
        if (get_publication_data[i].gidMediaOutlet == gidMediaOutlet) {
            // If a match is found, store the object in desiredTask and break out of the loop
            desiredTask = get_publication_data[i];
            break;
        }
    }

    // Update the DOM elements if desiredTask is found
    if (desiredTask !== null) {
        $('#gidMediaOutlet_id').val(desiredTask.gidMediaOutlet);
        $('#publiction_name').val(desiredTask.MediaOutlet);
        $('#get_media_type').val(desiredTask.gidMediaType);
        $('#publication_type').val(desiredTask.gidPublicationType);
        $('#tier_type').val(desiredTask.gidTier);
        $('#publication_language').val(desiredTask.Language);
        $('#master_head').val(desiredTask.Masthead);
        $('#priority').val(desiredTask.Priority);
        $('#short_name').val(desiredTask.ShortName);
    }
}

</script>


<script>
    $('table').DataTable();
</script>
</div>

            <!-- End of Main Content -->