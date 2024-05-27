
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
</style>
<div class="container">
        <div class="row">
            <div class="col-md-12 text-right p-2">
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add SubEditor</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <table class="table table-bordered table-hover dt-responsive">
                <thead >
                <tr>
                    <th>SubEditor Name</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Aarti</td>
                    <td>Active</td>
                    <td>26/05/2012</td>
                    <td>
                                &nbsp; <i class="fa fa-edit text-primary" onclick="editUserType('')" data-toggle="modal" data-target="#editModal" title="Edit"></i>&nbsp; 
                                <i class="fa fa-trash text-danger" onclick="deleteUserType('')" data-toggle="modal" data-target="#deleteModal" title="Delete"></i>
                            </td>
                </tr>

                </tbody>
            
            </table>
            </div>
        </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add SubEditor</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <form action="" method="post">
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">SubEditor Name </label>
                    <input type="text" class="form-control" placeholder="Enter SubEditor Name" name="SubEditor" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Password </label>
                    <input type="password" class="form-control" placeholder="Enter Password " name="Password" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Re-Type Password </label>
                    <input type="password" class="form-control" placeholder="Enter Re-Type Password" name="re_password" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Status</label>
                    <select name="is_active" class="form-control">
                        <option >Select</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
                <div class="text-right pt-2">
                 <button type="submit" class="btn btn-primary">ADD</button>
                </div>
        </form>
      </div>

      

    </div>
  </div>
</div>


<script>
    $('table').DataTable();
</script>
</div>

            <!-- End of Main Content -->    