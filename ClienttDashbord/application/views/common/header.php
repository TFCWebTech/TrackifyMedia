<?php 
    $this->load->library('session');
    if(!$this->session->userdata('client_id')){
        redirect('Login');
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News Report System</title>
   
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
     
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

    <script>
        // This function sets the default date to today
            function setDefaultDate() {
            const today = new Date(); // Get the current date
            const year = today.getFullYear(); // Extract the year
            const month = ('0' + (today.getMonth() + 1)).slice(-2); // Extract the month and pad to 2 digits
            const day = ('0' + today.getDate()).slice(-2); // Extract the day and pad to 2 digits
            const formattedDate = `${year}-${month}-${day}`; // Create the formatted date string
            const dateInput = document.getElementById('publication_date'); // Find the date input element by ID
            dateInput.value = formattedDate; // Set the default value
        }
    </script>
    <style>
           label{
        font-size:1rem !important;
    }
    .form-control {
    font-size: .8rem !important;
    }
    /* Custom border with text */
    .border-with-text {
            position: relative;
            padding: 20px;
            border: 2px solid #5a5c6926; /* Blue border */
            border-radius: 10px;
        }

        .border-with-text::before {
            content: attr(data-heading);
            position: absolute;
            top: -12px; /* Adjusts the position of the text */
            left: 20px; /* Adjusts the left position */
            background: white;
            padding: 0 10px; /* Padding for the background */
            font-weight: bold;
            color: #224abecc; /* Matches the border color */
        }
        .text-color{
            color:#224abecc;
        }
        label {
            margin-bottom: 0rem !important;
            margin-top: 0rem !important;
        }
        .btn{
            padding: .175rem .55rem !important;
            font-weight: 600 !important;
            text-transform: uppercase;
        }
        table.dataTable thead th, table.dataTable thead td{
            border-bottom :1px solid #5a5c6926  !important;
        }
        table.dataTable.no-footer{
            border-bottom :1px solid #5a5c6926  !important;
        }
        .dataTables_wrapper .dataTables_info , .dataTables_wrapper .dataTables_paginate .paginate_button{
   
    font-size: 0.8rem !important;
}
.modal-title{
    font-size: 1.2rem !important;
    text-transform: uppercase !important;
}
.btn {
 
    font-size: .8rem !important;
}
.cursor {
    cursor: pointer;
}
#toast-container .toast-error {
    background-color: red !important;
    color: #fff !important;
}
#toast-container .toast-success {
    background-color: blue !important;
    color: #fff !important;
}
    </style>
</head>

<body id="page-top" onload="setDefaultDate()">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                </div>
                <div class="sidebar-brand-text mx-3">User Dashboard</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item <?php print ($this->uri->segment(1)=='Home')?'active':''; ?>">
                    <a class="nav-link" href="<?php echo site_url('Home/allGraphs');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="nav-item <?php print ($this->uri->segment(2)=='CompareCharts')?'active':''; ?>">
                    <a class="nav-link" href="<?php echo site_url('Home/CompareCharts');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Pro Compare</span></a>
                </li>
             <!-- Divider -->
             <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
           
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php
                                     if($this->session->userdata('client_id')){ 
                                        ?>
                                        <div>
                                         Welcome, <?php echo $this->session->userdata('client_name'); ?>
                                        </div>
                                    <?php } else{
                                        ?>
                                        <div>
                                            Please log in.
                                        </div>
                                        <?php } ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo base_url('assets/img/undraw_profile.svg'); ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                               
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

