
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
    <div class="d-flex justify-content-end">
            <div class="d-flex text-right p-1 ">
                        <input type="date" class="form-control m-1" placeholder="Enter Headline">
                        <button class="btn btn-primary m-1">Search</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <table class="table table-bordered table-hover dt-responsive">
                <thead >
                <tr>
                    <th>Head line</th>
                    <th>News</th>
                    <th>Reporter Name</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
    <td>Air India </td>
    <td id="dynamicContent">NEW DELHI: Tata Group-owned Air India Express has sacked around 30 of its employees </td>
    <td>Aarti</td>
    <td>26/05/2012</td>
    <td>
        &nbsp;<a  href="<?php echo site_url('ManageNews/viewNews');?>"> <i class="fa fa-eye text-primary" data-toggle="modal"title="Edit"></i> </a> &nbsp;
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
        <h4 class="modal-title">Add Reporter</h4>
        <!-- Correct close button for Bootstrap 4 -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
            <form action="<?php echo site_url('ManageReporter/addReporter')?>" method="post">
                <div class="form-group">
                    <label class="px-1 font-weight-bold" for="user_type">Reporter Name </label>
                    <input type="text" class="form-control" placeholder="Enter Reporter Name" name="reporter_name" required>
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
<script>
// Get the text node within the td element
const td = document.getElementById("dynamicContent");
const textNode = td.childNodes[0];

// Split the content into an array of words
const words = textNode.textContent.trim().split(" ");

// Join the first seven words with a space
const truncatedText = words.slice(0, 7).join(" ");

// Add ellipsis
const newText = truncatedText + "...";

// Update the content of the text node
textNode.textContent = newText;
</script>

</div>

            <!-- End of Main Content -->    