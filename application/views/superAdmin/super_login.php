<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
     
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

    <style>
        .alert {
    
    border-radius: 0rem !important;
}
.col-lg-6{
   
    padding-right: 0rem !important;
     padding-left: 0rem !important; 

}
#display-error{
    display: none;
}
#toast-container .toast-error {
    background-color: red !important;
    color: #fff !important;
}
#toast-container .toast-success {
    background-color: #ffffff !important;
    color: #4e73df !important;
}
@media (max-width:725px){
    #mo_display_none{
        display: none;
    }
}

    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container"> 

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"> -->
                            <div class="col-lg-6 border-right" id="mo_display_none">
                                <img src="<?php echo base_url('assets/img/images/Mobile login-pana.png'); ?>" style="width:100%;" alt="">
                            </div>
                            <div class="col-lg-6 mt-4">
                              
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action ="<?php echo site_url('SuperAdmin/adminLogin')?>" Method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" name="userId" class="form-control form-control-user"
                                                placeholder="Enter Admin Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="user_password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Enter Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" type="button" class="btn btn-primary" data-toggle="modal" data-target="#forgotModal">Forgot Password?</a>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="modal" id="forgotModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Forget Password</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="{{route('user.forgotPassword')}}">
                     @csrf
                        <div class="mb-1 mt-0">
                            <p class="pb-1">Please enter your email address. You will receive a link to create a new password via email.</p>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="send_email" onchange="checkEmail()" required >
                            <p class="text-danger" id="display-error">This email does not exist.</p>
                        </div>
                        <div class="float-right pt-1">
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
    function checkEmail() {
        var searchEmail = $('#email').val();

        $.ajax({
            type: 'POST',
             url: "{{route('check.userMail')}} ",
             dataType: "html",
            data: {
                searchEmail: searchEmail,
                _token: '{{ csrf_token() }}', // Include CSRF token
            },
            success: function(data) {
                if (data === 'false') {
                    $('#display-error').show();
                    $('#email').val('');

                    setTimeout(function() {
                        $('#display-error').hide();
                    }, 5000);
                }
            }
        });
    }
    </script>
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

</body>

</html>