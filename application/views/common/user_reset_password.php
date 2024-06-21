
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Custom fonts for this template-->
    <link href="<?php print base_url('assets/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
     
    <!-- Custom styles for this template-->
    <link href="<?php print base_url('assets/css/sb-admin-2.min.css');?>" rel="stylesheet">
   <style>
#toast-container .toast-error {
    background-color: red !important;
    color: #fff !important;
}
#toast-container .toast-success {
    background-color: #4e73df !important;
    color: #fff !important;
}
   </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 mt-5" >

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <?php 
                        // if($check_token){
                            if($token){
                        ?>
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" >
                                <img src="<?php echo base_url('assets/img/images/Reset password-rafiki.png')?>" style="margin-top:10px; width:100%;" alt="">
                            </div>
                            <div class="col-lg-6" style="margin-top:50px;">
                                <div class="p-5">
                                    <div class="text-center">
                                    <img src="<?php echo base_url('assets/img/images/logo.png')?>" style="width:100%;" alt="">
                                        <h4>Reset Password</h4>
                                    </div>
                                    <form class="user" method="post" action="<?php echo site_url('ManageClient/newPassword'); ?>" onSubmit="return checkPassword()">
                                      
                                        <div class="form-group mt-3">
                                        <input type="password" id="password1" name="password1" class="form-control input-shadow" placeholder="New Password" required>
                                        </div>
                                        <div class="form-group">
                                        <input type="password" id="password2" name="password2" class="form-control input-shadow" placeholder="Confirm Password" required>
                                        </div>
                                        <input type="text" id="token" name="token" value="<?php echo $token ?>" hidden>
                                         <input type="text" id="customer_id" name="client_id" value="<?php echo $client_id ?>" hidden>
                                         <button type="submit" class="btn btn-primary btn-block" style="background-color:#4e73df;">Submit</button>
                                      
                                    </form>
                                  
                                    
                            </div>
                        </div>
                        <?php
                        } else { 
                            ?>
                            <h5 class="text-center m-5">This link is expired</h5>
                        <?php
                        }?>
                    </div>
                </div>

            </div>

        </div>

    </div>

   
    
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Custom scripts for all pages-->    
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">


<?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php }else if($this->session->flashdata('warning')){  ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
<?php }else if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
<?php } ?>


</script>
</body>

</html>


