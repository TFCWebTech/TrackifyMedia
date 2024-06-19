
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
.hidden {
    display: none;
  }
  .table-container-responsive{
            overflow-x: auto;
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
    input.setAttribute('name', 'Keywords[]');
    input.setAttribute('required', 'required');

    formGroup.appendChild(label);
    formGroup.appendChild(input);

    var parentDiv = document.getElementById('additionalKeywords');
    parentDiv.appendChild(formGroup);
}
</script>



<script>
function addKeywordInput2() {
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
    input.setAttribute('name', 'CompetetorKeywords[]');
    input.setAttribute('required', 'required');

    formGroup.appendChild(label);
    formGroup.appendChild(input);

    var parentDiv = document.getElementById('additionalKeywords2');
    parentDiv.appendChild(formGroup);
}
</script>
<div class="container">
        <div class="row">
            <div class="col-md-12 text-right p-2">
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Client</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <div class=" table-container-responsive">
            <table class="table table-bordered table-hover">
            <!-- <table class="table table-bordered table-hover dt-responsive"> -->
                <thead >
                <tr>
                    <th>Client Name</th>
                    <th>Keywords</th>
                    <th>Status</th>
                    <th>Add User Email</th>
                    <th>Add Competitor</th>
                    <!-- <th>Created At</th> -->
                    <th> Email Template</th>
                    <!-- <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($get_clients as $values){ ?>
                <tr>
                    <td><?php echo $values['client_name'];?></td>
                    <td><?php echo $values['client_keywords'];?></td>
                    <?php if($values['cilent_status'] == '1'){ ?>
                        <td> <i class="text-primary font-weight-bold "> Active</i></td>
                    <?php }elseif($values['cilent_status'] == '0'){ ?>
                        <td> <i class="text-danger font-weight-bold "> InActive</i></td>
                    <?php }else {?>
                        <td>NA</td>
                    <?php }?>
                    <td class="text-center"><a class="btn btn-primary" data-toggle="modal" data-target="#addEmail"  onclick="addEmail('<?php echo $values['client_id'];?>','<?php echo $values['client_name'];?>')" > ADD</a></td>
                    <td class="text-center"><a class="btn btn-primary" data-toggle="modal" data-target="#addCompitetor"  onclick="addCompetotor(<?php echo $values['client_id'];?>)" > ADD</a></td>
                    <!-- <td><?php echo date('d/ F /Y', strtotime($values['create_at'])); ?></td> -->
                    <td class="text-center"><a class="btn btn-primary" href="<?php echo site_url('EmailTemplate/CreateTemplate/'.$values['client_id']);?>"> ADD</a></td>
                    <!-- <td>
                        &nbsp; <i class="fa fa-edit text-primary" onclick="editUserType('')" data-toggle="modal" data-target="#editModal" title="Edit"></i>&nbsp; 
                        <i class="fa fa-trash text-danger" onclick="deleteUserType('')" data-toggle="modal" data-target="#deleteModal" title="Delete"></i>&nbsp;
                        </td> -->
                </tr>
                <?php } ?>
                </tbody>
            
            </table>
            </div>
            </div>
        </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Client</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
            <form onsubmit="return validateForm()" action="<?php echo site_url('ManageClient/addClient')?>" method="post">
             <div class="row">
                <div class="col-md-12">
                    <label class="px-1 font-weight-bold" for="user_type">Client Name </label>
                    <input type="text" class="form-control" placeholder="Enter Client Name" name="client_name" required>
                </div>
                <div class="col-md-12">
                    <label class="px-1 font-weight-bold" for="user_type">Password</label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="client_password" id="password" required>
                </div>
                <div class="col-md-12">
                    <label class="px-1 font-weight-bold" for="user_type">Re-Type Password</label>
                    <input type="password" class="form-control" placeholder="Enter Re-Type Password" name="re_password" id="re_password" required>
                </div>
                <div class="col-md-12">
                    <label class="px-1 font-weight-bold" for="is_active">Status</label>
                    <select name="is_active" class="form-control">
                        <option >Select</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="px-1 font-weight-bold" for="Sector">Sector</label>
                    <select name="Sector" class="form-control">
                        <option >Select</option>
                    </select>
                </div>
                <div class="col-md-12">
                <label class="px-1 font-weight-bold" for="tier_type">Client  </label>
                        <select class="form-control" name="client_select" id="client_select">
                        <option value="">Select</option>
                            <option value="1">Client</option>
                            <option value="0" selected="">Category</option>
                            <option value="2">Group</option>
                            <option value="3">SOV</option>
                            <option value="4">QSOV</option>
                        </select>
                </div>
                </div>
                <div class="row" id="hiddenContent">
                    <div class="col-md-12" >
                        <div class="form-group" >
                            <label class="px-1 font-weight-bold" for="tier_type">Expiry Date  </label>
                            <input type="date" class="form-control" placeholder="Enter Expiry Date" name="e_date" required>
                        </div>
                    </div>
           
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="px-1 font-weight-bold" for="tier_type">Version  </label>
                            <select class="form-control" name="version" id="">
                            <option value="ProPR">ProPR</option>
                            <option value="NewsTrac">NewsTrac</option>                            
                            <option value="Taj-Mahal">Taj-Mahal</option>	
                            <option value="Mini Rooster">Mini Rooster</option>
                            <option value="TV">TV</option>						
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="px-1 font-weight-bold" for="tier_type">Website URL</label>
                            <input type="text" class="form-control" placeholder="Enter Website URL" name="website_url" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="px-1 font-weight-bold" for="tier_type">Send Blank Mail  </label>
                            <select class="form-control" name="blank_mail" id="">
                            <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="3">No</option>
                                <option value="4">QSOV</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12" id="additionalKeywords">
                    <label class="px-1 font-weight-bold" for="user_type">Add Keywords</label>
                    <input type="text" class="form-control" placeholder="Enter Keywords" name="Keywords[]" required>
                </div>
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

<div class="modal" id="addCompitetor">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Compiter</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <form onsubmit="return validateForm()" action="<?php echo site_url('ManageClient/addCompetitor')?>" method="post">
                <div class="form-group">
                    <input type="text" id="client_id" name="client_id" hidden> 
                    <label class="px-1 font-weight-bold" for="user_type">Competitor Name </label>
                    <input type="text" class="form-control" placeholder="Enter Competitor Name" name="Competitor_name" required>
                </div>
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="is_active">Status</label>
                    <select name="is_active" class="form-control">
                        <option >Select</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
                <div class="form-group" id="additionalKeywords2">
                    <label class="px-1 font-weight-bold" for="user_type">Add Keywords</label>
                    <input type="text" class="form-control" placeholder="Enter Keywords" name="CompetetorKeywords[]" required>
                </div>
                <div class="text-right pt-2">
                    <p onclick="addKeywordInput2()"><i class="text-primary cursor"><u> Add More Keywords</u> </i></p>
                 <button type="submit" class="btn btn-primary">ADD</button>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="addEmail">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add User Email <span id="client_name_1"></span> </h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
            <form action="<?php echo site_url('ManageClient/addUsersEmail')?>" method="post">
                <div class="form-group" >
                    <input type="text" id="client_id_1" name="client_id_1" hidden> 
                    <label class="px-1 font-weight-bold" for="user_mails">Add Email</label>
                    <input type="text" class="form-control" placeholder="Enter Email" name="client_email" required>
                </div>
                    <div class="form-group mt-2">
                        <label class="px-1 font-weight-bold" for="report_Service">Report Service </label>
                    <div class="d-flex justify-content-start px-2">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="report_service_1" name="report_service" value="1" checked>
                            <label class="form-check-label" for="report_service_1">YES</label>
                        </div> &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="report_service_2" name="report_service" value="0">
                            <label class="form-check-label" for="report_service_2">NO</label>
                        </div>
                    </div>
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

document.addEventListener("DOMContentLoaded", function() {
var clientSelect = document.getElementById("client_select");
var hiddenContent = document.getElementById("hiddenContent");

// Initially hide the content
hiddenContent.classList.add("hidden");

// Add event listener for select change
clientSelect.addEventListener("change", function() {
    if (clientSelect.value === "0") { // Category selected
        hiddenContent.classList.add("hidden");
    } else { // Any other option selected
        hiddenContent.classList.remove("hidden");
    }
});
});
</script>

<script>
    function addCompetotor(client){
        $('#client_id').val(client);
    }
    function addEmail(client , client_name){
        $('#client_id_1').val(client);
        $('#client_name_1').val(client_name);
    }
</script>

</div>

            <!-- End of Main Content -->    