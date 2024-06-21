

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
            <div class="col-md-12 text-right p-2">
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Supplement</button>
            </div>
        </div>
        <!-- <?php print_r($all); ?> -->
        <div class="row">
            <div class="col-md-12" >
                <div class="table-container-responsive">
                <table class="table table-bordered table-hover ">
                <thead >
                <tr>
                  <th>Sr.no</th>
                    <th>Supplement Name</th>
                    <th>Publication </th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $i = 0;
                foreach($all as $value) { 
                  $i++;
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value['Supplement']; ?></td>
                    <td></td>
                    <td>
                      <?php  
                      if($value['Status'] == 0) {
                        echo 'Inactive';
                      } else {
                        echo 'Active';
                      }
                      ?>
                    </td>
                    <td><?php echo date('d/m/Y', strtotime($value['CreatedOn'])); ?></td>
                    <td>
                    &nbsp; <i class="fa fa-edit text-primary" onclick="edit('<?php echo $value['supplement_id'] ?>')"></i> &nbsp; 
                        <!-- <i class="fa fa-trash text-danger" ></i> -->
                    </td>
                </tr>
                <?php }
                ?>

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
        <h4 class="modal-title">Add Supplement</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <form action="<?php echo site_url('ManageSupplement/addSupliment'); ?>" method="post">
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Supplement Name </label>
                    <input type="text" class="form-control" placeholder="Enter Edition Name" name="Supplement" required>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Publication  </label>
                  <select class="form-control" name="" id="">
                    <option value="">Select</option>
                  </select>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">  </label>
                  <select class="form-control" name="" id="">
                    <option value="">Select</option>
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

<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Supplement</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <form action="<?php echo site_url('ManageSupplement/editSupliment'); ?>" method="post">

                <input type="text" name="supplement_id" id="supplement_id" hidden />
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Supplement Name </label>
                    <input type="text" class="form-control" placeholder="Enter Edition Name" name="Supplement" id="Supplement" required>
                </div>
                <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">Status  </label>
                  <select class="form-control" name="Status" id="Status" required>
                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                    
                  </select>
                </div>
                <!-- <div class="form-group">
                <label class="px-1 font-weight-bold" for="tier_type">  </label>
                  <select class="form-control" name="" id="">
                    <option value="">Select</option>
                  </select>
                </div> -->
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

    function edit(supplement_id) {
      var all = <?php echo json_encode($all); ?>;

      var desiredTask = null;

			// Loop through all_questions array
			for (var i = 0; i < all.length; i++) {
				// Check if the current object's question_id matches the desired question_id
				if (all[i].supplement_id == supplement_id) {
					// If a match is found, store the object in desiredTask and break out of the loop
					desiredTask = all[i];
					break;
				}
			}

      $('#Supplement').val(desiredTask.Supplement);
      $('#supplement_id').val(desiredTask.supplement_id);
      $('#Status').val(desiredTask.Status);

      $('#editModal').modal('show');
    }
</script>
</div>

            <!-- End of Main Content -->