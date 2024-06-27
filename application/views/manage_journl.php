
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
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-right p-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Journalist </button>
            </div>
        </div>
        <!-- <div class="card p-3 my-2"  id="headlineSearchSection" > -->
        <!-- <div class="row">
        <div class="col-md-12 card p-3">
                <div class="border-with-text" data-heading="Filter Options">
                    <div class="row">
                        <div class="col-md-5">
                            <label class="px-1 font-weight-bold" for="media_type">Media Type</label>
                            <select class="form-control" name="" id="">
                            <option value="">Select</option>
                            <option value="">Magazine</option>
                            <option value="">NewsPaper</option>
                            <option value="">Online</option>
                            <option value="">RSS</option>
                            <option value="">TV</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="px-1 font-weight-bold" for="media_type">Media Outlet</label>
                            <select class="form-control" name="" id="">
                            <option value="">Select</option>
                    
                            </select>
                        </div>
                 
                        <div class="col-md-2 mt-4 pt-2">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
             </div>
        </div> -->
    <!-- </div> -->

        
<div class="container-fluid mt-2">
        <div class="card p-3">
            <div class="table-container-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Journalist Name</th>
                            <th>Journalist Mailid</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                         $i = 0;
                        foreach($journalist as $journalists){
                           $i++; 
                           ?>
                        <tr>
                            <td><?php echo $journalists['Journalist']; ?></td>
                            <td><?php echo $journalists['JEmailId']; ?></td>
                            <td> <?php  
                          if($journalists['Status'] == 0) {
                            echo 'Inactive';
                          } else {
                            echo 'Active';
                          }
                          ?>
                          </td>
                          
                          <td><?php echo date('d/m/Y', strtotime($journalists['CreatedOn'])); ?></td>
                          <td>
                           &nbsp; <i class="fa fa-edit text-primary" data-toggle="modal" data-target="#editModal" onclick="edit('<?php echo $journalists['journalist_id']; ?>')"></i> &nbsp; 
                            <!-- <i class="fa fa-trash text-danger" ></i> -->
                          </td>

                          
                        </tr>
                        <?php }; ?>

                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Journalist</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <form action="<?php echo site_url('ManageJournl/addjournalist'); ?>" method="post">

            <div class="form-group">
                    <label class="px-1 font-weight-bold" for="tier_type">Media Type  </label>
                    <select class="form-control" name="media_type" id="">
                    <option value="">Select</option>
                    <option value="">Magazine</option>
                    <option value="">NewsPaper</option>
                    <option value="">Online</option>
                    <option value="">RSS</option>
                    <option value="">TV</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="tier_type">Media Outlet  </label>
                    <select class="form-control" name="media_outlet" >
                        <option value="">Select</option>
                                    <?php foreach($get_MediaOutLet as $values){?>
                                    <option value="<?php echo $values['gidMediaOutlet'];?>"> <?php echo $values['MediaOutlet'];?></option>
                                    <?php }?>
                        </select>
                    </select>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Journalist Name </label>
                    <input type="text" class="form-control" placeholder="Enter Journalist Name" name="name" id="" required>
                </div>
           
              
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Journalist Email </label>
                    <input type="email" class="form-control" placeholder="Enter Journalist Email" name="email" id="" required>
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
<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">edit Journalist</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
    <form action="<?php echo site_url('ManageJournl/editJournalist'); ?>" method="post">

    <div class="form-group">
        <input type="text" name="gidJournalist" id="gidJournalist" hidden>
        <label class="px-1 font-weight-bold" for="media_type">Media Type</label>
        <select class="form-control" name="media_type" id="media_type">
            <option value="">Select</option>
            <option value="Magazine">Magazine</option>
            <option value="NewsPaper">NewsPaper</option>
            <option value="Online">Online</option>
            <option value="RSS">RSS</option>
            <option value="TV">TV</option>
        </select>
    </div>
    <div class="form-group">
        <label class="px-1 font-weight-bold" for="media_outlet">Media Outlet</label>
        <select class="form-control" name="media_outlet" id="media_outlet">
        <option value="">Select</option>
                    <?php foreach($get_MediaOutLet as $values){?>
                    <option value="<?php echo $values['gidMediaOutlet'];?>"> <?php echo $values['MediaOutlet'];?></option>
                    <?php }?>
        </select>
    </div>
    <div class="form-group">
        <label class="px-1 font-weight-bold" for="Journalist">Journalist Name</label>
        <input type="text" class="form-control" placeholder="Enter Journalist Name" name="Journalist" id="Journalist" required>
    </div>
    <div class="form-group">
        <label class="px-1 font-weight-bold" for="JEmailId">Journalist Email</label>
        <input type="email" class="form-control" placeholder="Enter Journalist Email" name="JEmailId" id="JEmailId" required>
    </div>
    <div class="form-group">
        <label class="px-1 font-weight-bold" for="Status">Status</label>
        <select class="form-control" name="Status" id="Status" required>
            <option value="">Select Status</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
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
    $('table').DataTable();

    function edit(journalist_id) {
        console.log('journalist_id:', journalist_id);

        var all = <?php echo json_encode($journalist); ?>;
        console.log('all:', all);

        var desiredTask = null;

        if (Array.isArray(all)) {
            // Loop through all array
            for (var i = 0; i < all.length; i++) {
                // Check if the current object's journalist_id matches the desired journalist_id
                if (all[i].journalist_id == journalist_id) {
                    // If a match is found, store the object in desiredTask and break out of the loop
                    desiredTask = all[i];
                    break;
                }
            }
        } else if (typeof all === 'object') {
            // If all is not an array, treat it as an object
            if (all.journalist_id == journalist_id) {
                desiredTask = all;
            }
        }

        if (desiredTask) {
            $('#gidJournalist').val(desiredTask.journalist_id);
            $('#media_outlet').val(desiredTask.gigMediaOutlet);
            $('#Journalist').val(desiredTask.Journalist);
            $('#JEmailId').val(desiredTask.JEmailId);
            $('#Status').val(desiredTask.Status);
        } else {
            console.error('No match found for journalist_id:', journalist_id);
        }

        // $('#editModal').modal('show');
    }
</script>


</div>

            <!-- End of Main Content -->