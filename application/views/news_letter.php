<div class="card p-4">
<form action="<?php echo base_url('NewsLetter/sendMailToMultipleClient');?>" method="post">

    <div class="row">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn text-primary font-weight-bold"> Process </button>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>News Send Detail</th>
                <th>Today Pending News</th>
                <th>Today Send News</th>
                <th><input type="checkbox" id="checkAll" value="checkAll"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($get_clients as $clients): ?>
                <tr>
                    <td><?php echo $clients['client_name']; ?>&nbsp; <a href="<?php echo site_url('NewsLetter/newsMail/'. $clients['client_id']); ?>"> <i class="fa fa-eye text-primary "></i></a> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><input type="checkbox" class="checkBox" name="client_id[]" value="<?php echo $clients['client_id'];?>"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>

</div>

</div>
<script>
    document.getElementById("checkAll").addEventListener("click", function() {
        var checkBoxes = document.getElementsByClassName("checkBox");
        for (var i = 0; i < checkBoxes.length; i++) {
            checkBoxes[i].checked = this.checked;
        }
    });
</script>