<div class="card p-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>News Send Detail</th>
                <th>Today Pending News</th>
                <th>Today Send News</th>
                <th><input type="checkbox" id="checkAll" name="checkAll" value="checkAll"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($get_clients as $clients): ?>
                <tr>
                    <td><?php echo $clients['client_name']; ?>&nbsp;<i class="fa fa-eye text-primary"></i> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><input type="checkbox" class="checkBox" name="option1" value="option1"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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