
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
  
<div class="row pb-2">
  <div class="col-md-12 d-flex justify-content-end">
    <div class="search-box d-flex">
      <label class="pt-1 font-weight-bold" for="user_type">MediaType</label> &nbsp;
      <select class="form-control" name="media_type" id="media_type">
        <option value="">Select</option>
        <?php foreach($get_media_type as $values){?>
        <option value="<?php echo $values['gidMediaType']; ?>"> <?php echo $values['MediaType']; ?></option>
        <?php } ?>
      </select> &nbsp;
      <button class="btn btn-primary" onclick="findMedia()">Search</button>
    </div>&nbsp;
    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">New Rate</button>
  </div>
</div>
        <div class="row">
            <div class="col-md-12" >
                <div class="table-container-responsive">
                <table id="table" class="table table-bordered table-hover ">
                <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Publication Name</th>
                    <th>Edition</th>
                    <th>Supplement</th>
                    <th>Rate</th>
                    <th>New Rate</th>
                    <th>Circulation Figure</th>
                    <th>Status</th>
                    <th>Created On</th>
                    <th>Updated On</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $i = 0;
                foreach($get_add_rate as $values){ 
                    $i++;
                    ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $values['MediaOutlet'];?></td>
                    <td><?php echo $values['Edition'];?></td>
                    <td><?php echo $values['Supplement'];?></td>
                    <td><?php echo $values['Rate'];?></td>
                    <td><?php echo $values['NewRate'];?></td>
                    <td><?php echo $values['Circulation_Fig'];?></td>
                    <td><?php echo $values['Status'];?></td>
                    <td><?php echo date('d F Y', strtotime($values['CreatedOn'])); ?></td>
                    <!-- <td><?php echo $values['CreatedBy'];?></td> -->
                    <td>
                        <?php if ($values['UpdatedOn'] != '0000-00-00 00:00:00' && !empty($values['UpdatedOn'])): ?>
                            <?php echo date('d F Y', strtotime($values['UpdatedOn'])); ?>
                        <?php else: ?>
                            NA
                        <?php endif; ?>
                    </td>
                    <td>
                    &nbsp; <a data-toggle="modal" data-target="#updatePublication" onclick="updatedAddRate('<?php echo $values['gidAddRate'];?>')"><i class="fa fa-edit text-primary"></i> </a> &nbsp; 
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
        <h4 class="modal-title">Add New Rate</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <form action="<?php echo site_url('ManageAddRate/addNewRate')?>" method="post">
                <!-- <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Publication Name </label>
                    <input type="text" class="form-control" placeholder="Enter Publication Name" name="publiction_name" required>
                </div> -->
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Media Type </label>
                    <select class="form-control" name="get_media_type"  onchange="change_media(this.value)"> 
                    <option value="">Select</option>
                    <?php foreach($get_media_type as $values){?>
                    <option value="<?php echo $values['gidMediaType'];?>"> <?php echo $values['MediaType'];?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Publication  </label>
                    <select class="form-control" name="Publication" id="getPublication" onchange="change_publication(this.value)"> 
                    <option value="">Select</option>
                    </select>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Edtion </label>
                  <select class="form-control" name="Edtion" id="getEdition">
                  <option value="">Select</option>
                    
                  </select>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Supplment </label>
                  <select class="form-control" name="Supplements" >
                  <option value="">Select</option>
                    <?php foreach($get_supplements as $values){?>
                    <option value="<?php echo $values['gidSupplement'];?>"> <?php echo $values['Supplement'];?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Rate </label>
                    <input type="text" class="form-control" placeholder="Enter Rate" name="rate" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">New Rate  </label>
                    <input type="text" class="form-control" placeholder="Enter New Rate " name="new_rate" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Number of Circulation  </label>
                    <input type="text" class="form-control" placeholder="Enter Number of Circulation" name="Number_of_circulation" required>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Status </label>
                  <select class="form-control" name="Status" >
                  <option value="">Select</option>
                  <option value="0">Active</option>
                  <option value="0">InActive</option>
                  </select>
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
            <form action="<?php echo site_url('ManageAddRate/updatedAddRate')?>" method="post">
               
                <div class="form-group">
                <input type="text" name="gidAddRate_id" id="gidAddRate_id" hidden>
                    <label class="px-1 font-weight-bold" for="user_type">Media Type </label>
                  <select class="form-control" name="get_media_type" id="get_media_type" onchange="change_media(this.value)"> 
                    <option value="">Select</option>
                    <?php foreach($get_media_type as $values){?>
                    <option value="<?php echo $values['gidMediaType'];?>"> <?php echo $values['MediaType'];?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Publication  </label>
                    <select class="form-control" name="Publication" id="Publication"> 
                    <option value="">Select</option>
                   
                    </select>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Edtion </label>
                  <select class="form-control" name="Edtion" id="Edtion">
                  <option value="">Select</option>
                   
                  </select>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Supplment </label>
                  <select class="form-control" name="Supplements" id="Supplements">
                  <option value="">Select</option>
                    <?php foreach($get_supplements as $values){?>
                    <option value="<?php echo $values['gidSupplement'];?>"> <?php echo $values['Supplement'];?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Rate </label>
                    <input type="text" class="form-control" placeholder="Enter Rate" name="rate" id="rate" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">New Rate  </label>
                    <input type="text" class="form-control" placeholder="Enter New Rate" name="new_rate" id="new_rate" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Number of Circulation  </label>
                    <input type="text" class="form-control" placeholder="Enter Number of Circulation" name="Number_of_circulation" id="Number_of_circulation" required>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Status </label>
                  <select class="form-control" name="Status" id="Status">
                  <option value="">Select</option>
                  <option value="0">Active</option>
                  <option value="0">InActive</option>
                  </select>
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
  function updatedAddRate(gidAddRate) {
    var get_add_rate = <?php echo json_encode($get_add_rate); ?>;
    var desiredTask = null;

    // Loop through get_publication_data array
    for (var i = 0; i < get_add_rate.length; i++) {
        // Check if the current object's gidMediaOutlet matches the desired gidMediaOutlet
        if (get_add_rate[i].gidAddRate == gidAddRate) {
            // If a match is found, store the object in desiredTask and break out of the loop
            desiredTask = get_add_rate[i];
            break;
        }
    }

    // Update the DOM elements if desiredTask is found
    if (desiredTask !== null) {
        $('#gidAddRate_id').val(desiredTask.gidAddRate);
        $('#get_media_type').val(desiredTask.gidMediaType);
        $('#Publication').val(desiredTask.gidMediaOutlet);
        $('#Edtion').val(desiredTask.gidEdition);
        $('#Supplements').val(desiredTask.gidSupplement);
        $('#Status').val(desiredTask.Status);
        $('#rate').val(desiredTask.Rate);
        $('#new_rate').val(desiredTask.NewRate);
        $('#Number_of_circulation').val(desiredTask.Circulation_Fig);
         // Trigger change events to load related data
         change_media(desiredTask.gidMediaType);
        change_publication(desiredTask.gidMediaOutlet);
    }
}

</script>

<script>
    function change_media(media){
        $.ajax(
        {
            type: "POST",
            url: "<?php echo site_url('ManageAddRate/getPublicaton'); ?>",
            dataType: 'html',
            data:{media:media},
            success: function (data) 
            {
            $("#getPublication").html(data);
            $("#Publication").html(data);
            }
        });
    }

    function change_publication(publication){
        $.ajax(
        {
            type: "POST",
            url: "<?php echo site_url('ManageAddRate/getEdition'); ?>",
            dataType: 'html',
            data:{publication:publication},
            success: function (data) 
            {
            $("#getEdition").html(data);
            $("#Edtion").html(data);
            }
        });
    }
</script>

<script>
    // AJAX function to fetch data
    function findMedia() {
        var media_type = document.getElementById('media_type').value;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ManageAddRate/findData'); ?>",
            dataType: 'json', // expecting JSON data
            data: { media_type: media_type },
            success: function(data) {
                populateTable(data); // call the function to populate the table with fetched data
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    }

    // Function to populate the table with fetched data
    function populateTable(data) {
        var tableBody = $('table tbody');
        tableBody.empty(); // Clear the table body

        data.forEach(function(item, index) {
            var updatedOn = item.UpdatedOn != '0000-00-00 00:00:00' && item.UpdatedOn ? dateFormat(item.UpdatedOn) : 'NA';
            var createdOn = dateFormat(item.CreatedOn);

            var row = `<tr>
                <td>${index + 1}</td>
                <td>${item.MediaOutlet != null ? item.MediaOutlet : 'NA'}</td>
                <td>${item.Edition != null ? item.Edition : 'NA'}</td>
                <td>${item.Supplement != null ? item.Supplement : 'NA'}</td>
                <td>${item.Rate != null ? item.Rate : 'NA'}</td>
                <td>${item.NewRate != null ? item.NewRate : 'NA'}</td>
                <td>${item.Circulation_Fig != null ? item.Circulation_Fig : 'NA'}</td>
                <td>${item.Status != null ? item.Status : 'NA'}</td>
                <td>${createdOn}</td>
                <td>${updatedOn}</td>
                <td>
                    <a data-toggle="modal" data-target="#updatePublication" onclick="updatedAddRate('${item.gidAddRate}')">
                        <i class="fa fa-edit text-primary"></i>
                    </a>
                </td>
            </tr>`;
            tableBody.append(row);
        });

        // Initialize DataTables after populating the table
        // $('#table').DataTable();
        $('#table').DataTable({
        "paging": true, // Enable pagination
        "lengthChange": true, // Enable per-page selection
        "searching": true, // Enable search box
        "ordering": true, // Enable column sorting
        "info": true, // Enable table information display
        "autoWidth": false // Disable auto width calculation
    });
    }

    // Function to format date
    function dateFormat(dateString) {
        var date = new Date(dateString);
        var options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }
    $('#table').DataTable();
</script>

</div>

            <!-- End of Main Content -->