
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
.cursor{
    cursor: pointer;
}
</style>
<script>
function validateForm() {
    var password = document.getElementById("password").value;
    var rePassword = document.getElementById("re_password").value;
    if (password !== rePassword) {
        alert("Passwords do not match.");
        return false;
    }
    return true;
}
</script>
<script>
function addKeywordInput() {
    var formGroup = document.createElement('div');
    formGroup.classList.add('form-group');

    var label = document.createElement('label');
    label.classList.add('px-1', 'font-weight-bold');
    label.setAttribute('for', 'user_type');
    label.textContent = 'Add Keywords';

    var input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.classList.add('form-control');
    input.setAttribute('placeholder', 'Enter Keywords');
    input.setAttribute('name', 'Keywords');
    input.setAttribute('required', 'required');

    formGroup.appendChild(label);
    formGroup.appendChild(input);

    var parentDiv = document.getElementById('additionalKeywords');
    parentDiv.appendChild(formGroup);
}
</script>
<div class="container">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h5 mb-0 text-gray-800 ">Manage Client</h1>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Client</button>
                    </div>
        <div class="row">
            <div class="col-md-12">
            <table class="table table-bordered table-hover dt-responsive">
                <thead >
                <tr>
                    <th>Client Name</th>
                    <th>Keywords</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th> Email Template</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Tech Mahindra</td>
                    <td>blockchain , Digital Supply Chain</td>
                    <td>Active</td>
                    <td>26/05/2012</td>
                    <td class="text-center"><a class="btn btn-primary" href="<?php echo site_url('EmailTemplate');?>"> ADD</a></td>
                    <td>
                                &nbsp; <i class="fa fa-edit text-primary" onclick="editUserType('')" data-toggle="modal" data-target="#editModal" title="Edit"></i>&nbsp; 
                                <i class="fa fa-trash text-danger" onclick="deleteUserType('')" data-toggle="modal" data-target="#deleteModal" title="Delete"></i>&nbsp;
                                <!-- <i class="fa fa-trash text-danger" onclick="deleteUserType('')" data-toggle="modal" data-target="#deleteModal" title="Delete"></i> -->
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
        <h4 class="modal-title">Add Client</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <form onsubmit="return validateForm()" action="<?php echo site_url('ManageClient/addClient')?>" method="post">
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Client Name </label>
                    <input type="text" class="form-control" placeholder="Enter Client Name" name="client_name" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Password</label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="client_password" id="password" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Re-Type Password</label>
                    <input type="password" class="form-control" placeholder="Enter Re-Type Password" name="re_password" id="re_password" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="is_active">Status</label>
                    <select name="is_active" class="form-control">
                        <option >Select</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
                <div class="form-group" id="additionalKeywords">
                    <label class="px-1 font-weight-bold" for="user_type">Add Keywords</label>
                    <input type="text" class="form-control" placeholder="Enter Keywords" name="Keywords[]" required>
                </div>
                <div class="text-right pt-2">
                    <p onclick="addKeywordInput()"><i class="text-primary cursor"><u> Add More Keywords</u> </i></p>
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