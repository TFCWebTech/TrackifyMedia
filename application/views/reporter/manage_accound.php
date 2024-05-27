
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <?php foreach($user_data as $values){?>
                    <div class="p-1">
                        <div class="row">
                            <div class="col-md-6">
                                 <div class="card p-5">
                                    <div >
                                        <h1 class="h5 text-gray text-uppercase font-weight-bold">Update Information</h1>
                                    </div>
                                    <hr>
                                    <form action ="<?php echo site_url('Reporter/editInfo');?>" Method="POST" class="user">
                                            <input type="text" name="userId" class="form-control "
                                                placeholder="Enter User Id" value="<?php echo $values['user_id'];?>" hidden>
                                        <div class="form-group">
                                        <label for="" class="font-weight-bold"> Name</label>
                                            <input type="text" name="user_name" class="form-control "
                                                placeholder="Enter User Id" value="<?php echo $values['user_name'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="font-weight-bold"> Email</label>
                                            <input type="text" name="user_mail" class="form-control "
                                                placeholder="Enter Your Email" value="<?php echo $values['user_email'];?>" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary ">
                                                UPDATE 
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-5">
                                    <div >
                                        <h1 class="h5 text-gray text-uppercase font-weight-bold">Update Password</h1>
                                    </div>
                                    <hr>
                                    <form action="<?php echo site_url('Reporter/editReporterPassword');?>" method="POST" onsubmit="return validatePassword()">
                                        <input type="text" name="user_id" class="form-control"
                                            placeholder="Enter User Id" value="<?php echo $values['user_id'];?>" hidden>
                                        <div class="form-group">
                                            <label for="password" class="font-weight-bold">Password</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation" class="font-weight-bold">Confirm Password</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                                placeholder="Enter Confirm Password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                UPDATE
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <?php } ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

   
            <script>
    function validatePassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("password_confirmation").value;

        if (password === "") {
            alert("Password cannot be empty.");
            return false;
        }

        if (confirmPassword === "") {
            alert("Please confirm your password.");
            return false;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }

        return true;
    }
</script>