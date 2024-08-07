
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
 @media (min-width: 768px) { */
        .table-container-responsive{
            overflow-x: hidden;
        } 
     } 
</style>

<div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-right p-2">
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Edition</button>
            </div>
        </div>
         
             <div class="row justify-contain-center">
                <div class="col-md-12">
                  <div class="table table-container-responsive">
                    <table class="table table-bordered table-hover">
                       <thead>
                       <tr>
                        <th>Edition Name</th>
                        <th>Edition Order</th>
                        <th>Publication</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php 
                $i = 0;
                foreach($editions as $edition) { 
                  $i++;
                  ?>
                  <tr>
                            <td><?php echo $edition['Edition']; ?></td>
                            <td><?php echo $edition['EditionOrder']; ?></td>
                            <td><?php echo $edition['MediaOutlet']; ?></td>
                            <td>
                      <?php  
                      if($edition['Status'] == 0) {
                        echo 'Inactive';
                      } else {
                        echo 'Active';
                      }
                      ?>
                    </td>
                      <td><?php echo date('d/m/Y', strtotime($edition['CreatedOn'])); ?></td>
                     
                    <td>
                    &nbsp; <i class="fa fa-edit text-primary" onclick="edit('<?php echo $edition['Edition'] ?>')"></i> &nbsp; 
                        <!-- <i class="fa fa-trash text-danger" ></i> -->
                    </td>
                </tr>
                <?php }
                ?>
                   </tbody>
                </table>
            </div>
         </div>
         </div>
        </div>
        
     
        
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Edition</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
      <form id="addEditionForm" action="<?php echo site_url('ManageEditions/add_editions'); ?>" method="post">
    <div class="form-group">
        <label class="px-1 font-weight-bold" for="publiction_name">Edition Name </label>
        <input type="text" class="form-control" placeholder="Enter Edition Name" name="Edition" required>
    </div>

    <div class="form-group">
        <label class="px-1 font-weight-bold" for="publiction_order">Edition Order </label>
        <input type="text" class="form-control" placeholder="Enter Edition Order" name="EditionOrder" required>
    </div>

    <div class="form-group">
    <label class="px-1 font-weight-bold" for="media_outlet">Publication </label>
    <select class="form-control" name="MediaOutletId" required>
        <option value="">Select</option>
        <?php foreach($get_MediaOutLet as $values){ ?>
            <option value="<?php echo $values['gidMediaOutlet']; ?>">
                <?php echo $values['MediaOutlet']; ?>
            </option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
            <label class="px-1 font-weight-bold" for="MediaOutletId">Status </label>
            <select class="form-control" name="Status" required>
                <option value="">Select</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
                <!-- Add options dynamically if needed -->
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
        <h4 class="modal-title">Edit Edition</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
      <form  action="<?php echo site_url('ManageEditions/editEditions'); ?>" method="post">
       <input type="text" name="edition_id" id="edition_id" hidden />
        <div class="form-group">
            <label class="px-1 font-weight-bold" for="publiction_name">Edition Name </label>
            <input type="text" class="form-control" placeholder="Enter Edition Name" name="Edition" id="Edition" required>
        </div>

        <div class="form-group">
            <label class="px-1 font-weight-bold" for="publiction_order">Edition Order </label>
            <input type="text" class="form-control" placeholder="Enter Edition Order" id="EditionOrder" name="EditionOrder" required>
        </div>

        <div class="form-group">
          <label class="px-1 font-weight-bold" for="media_outlet">Publication </label>
          <select class="form-control" name="MediaOutletId" id="publication">
              <option value="">Select</option>
              <?php foreach($get_MediaOutLet as $values){ ?>
                  <option value="<?php echo $values['gidMediaOutlet']; ?>">
                      <?php echo $values['MediaOutlet']; ?>
                  </option>
              <?php } ?>
          </select>
      </div>

        <div class="form-group">
            <label class="px-1 font-weight-bold" for="MediaOutletId">Status </label>
            <select class="form-control" name="Status" id="Status">
                <option value="">Select</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
                <!-- Add options dynamically if needed -->
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





</body>
</html>


<script>
    $('table').DataTable();

    function edit(Edition) {
      var all = <?php echo json_encode($editions); ?>;
      // alert(gidEdition);
      // console.log(all+' all data');

      var desiredTask = null;

			// Loop through all_questions array
			for (var i = 0; i < all.length; i++) {
				// Check if the current object's question_id matches the desired question_id
				if (all[i].Edition == Edition) {
					// If a match is found, store the object in desiredTask and break out of the loop
					desiredTask = all[i];
					break;
				}
			}

      console.log(desiredTask);
      $('#edition_id').val(desiredTask.edition_id);
      $('#Edition').val(desiredTask.Edition);
      $('#EditionOrder').val(desiredTask.EditionOrder);
      $('#publication').val(desiredTask.MediaOutletId);
      $('#Status').val(desiredTask.Status);

      $('#editModal').modal('show');
    }

</script>



</div>

            <!-- End of Main Content -->