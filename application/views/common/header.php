<?php 
    $this->load->library('session');
    if(!$this->session->userdata('user_id')){
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
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <?php
                    if($this->session->userdata('user_id')){ 
                        ?>
                        <div>
                            <?php if($this->session->userdata('user_type') == 'Admin'){?>
                                    <div class="sidebar-brand-text mx-3">Admin</div>
                                <?php }elseif($this->session->userdata('user_type') == 'Reporter') { ?>
                                    <div class="sidebar-brand-text mx-3">Reporter</div>
                            <?php }else{ 
                                 ?>
                                 <div>
                                     NA
                                 </div>
                                 <?php
                            } 
                        }?>
                        </div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <?php
             if($this->session->userdata('user_type') == 'Reporter'){?>
            <li class="nav-item <?php print ($this->uri->segment(1)=='NewsUpload')?'active':''; ?>">
                <a class="nav-link" href="<?php echo site_url('NewsUpload');?>">
                    <i class="fas fa-upload"></i>
                    <span>News Upload</span></a>
            </li>
            <?php
            } ?>
            <li class="nav-item <?php print ($this->uri->segment(1)=='ManageNews')?'active':''; ?>">
                <a class="nav-link" href="<?php echo site_url('ManageNews');?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Manage News</span></a>
            </li>
            <?php
             if($this->session->userdata('user_type') == 'Reporter'){?>
            <li class="nav-item <?php print ($this->uri->segment(1)=='EditReporter')?'active':''; ?>">
                <a class="nav-link" href="<?php echo site_url('Reporter/EditReporter');?>">
                    <i class="fas fa-user-edit"></i>
                    <span>Manage Account</span></a>
            </li>
            <?php
            } ?>
            <?php
             if($this->session->userdata('user_type') == 'Admin'){?>
              <li class="nav-item <?php print ($this->uri->segment(2)=='newsLetter')?'active':''; ?>">
                <a class="nav-link" href="<?php echo site_url('newsLetter');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Manage NewsLetter</span></a>
            </li>
            <li class="nav-item <?php print ($this->uri->segment(2)=='ReporterInfo')?'active':''; ?>">
                <a class="nav-link" href="<?php echo site_url('ManageReporter/ReporterInfo');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Manage Reporter</span></a>
            </li>
            <li class="nav-item <?php print ($this->uri->segment(2)=='ClientInfo')?'active':''; ?>">
                <a class="nav-link" href="<?php echo site_url('ManageClient/ClientInfo');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Manage Client</span></a>
            </li>
           
            <li class="nav-item <?php print ($this->uri->segment(2)=='ManageIndustry')?'active':''; ?>">
                <a class="nav-link" href="<?php echo site_url('ManageIndustry');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Manage ManageIndustry</span></a>
            </li>
            
            <?php
            } ?>
           <!--  <li class="nav-item <?php print ($this->uri->segment(1)=='Process')?'active':''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Process</span>
                </a>
                <div id="collapseTwo" class="collapse <?php print ($this->uri->segment(1)=='Process')?'show':''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">  
                        <a class="collapse-item <?php print ($this->uri->segment(2)=='Reporter')?'active':''; ?>"  href="<?php echo site_url('Reporter');?>" >Reporter-upload </a>
                        <a class="collapse-item <?php print ($this->uri->segment(2)=='SubEditor')?'active':''; ?>"  href="<?php echo site_url('SubEditor');?>">Sub-Editor </a>
                        <a class="collapse-item <?php print ($this->uri->segment(2)=='CheckEdition')?'active':''; ?>"  href="<?php echo site_url('CheckEdition');?>">Check Edition </a>
                        <a class="collapse-item <?php print ($this->uri->segment(2)=='NewsLetterPreview')?'active':''; ?>"  href="<?php echo site_url('NewsLetterPreview');?>">News Letter Preview</a>
                        <a class="collapse-item <?php print ($this->uri->segment(2)=='OldReporter')?'active':''; ?>"  href="<?php echo site_url('Reporter/OldReporter');?>">Reporter-Old Upload</a>
                    </div>
                </div>
            </li> -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
                    aria-expanded="true" aria-controls="collapseUtilities2">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Category</span>
                </a>
                <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo site_url('Catogories');?>">All Category</a>
                        <a class="collapse-item" href="<?php echo site_url('Sector');?>">Sector</a>
                        <a class="collapse-item" href="<?php echo site_url('Product');?>">Product </a>
                        <a class="collapse-item" href="<?php echo site_url('NewsCity');?>">New City</a> 
                        <a class="collapse-item" href="<?php echo site_url('HardCopy');?>">Hard Copy</a>
                        
                    </div>
                </div>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3"
                    aria-expanded="true" aria-controls="collapseUtilities3">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Master</span>
                </a>
                <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo site_url('Publication');?>">Publication</a> 
                        <a class="collapse-item" href="<?php echo site_url('Edition');?>">Edition</a>
                        <a class="collapse-item" href="<?php echo site_url('Supplement');?>">Supplement</a> 
                        <a class="collapse-item" href="<?php echo site_url('Journalist');?>">Journalist</a>
                        <a class="collapse-item" href="<?php echo site_url('Edition');?>">Change News Date</a>
                        <a class="collapse-item" href="<?php echo site_url('MarketWatch');?>">Market Watch </a>
                        <a class="collapse-item" href="<?php echo site_url('Edition');?>">Run Keywords</a>
                        <a class="collapse-item" href="<?php echo site_url('Edition');?>">Track Mail Clicks </a>
                        
                    </div>
                </div>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4"
                    aria-expanded="true" aria-controls="collapseUtilities4">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Interal Users</span>
                </a>
                <div id="collapseUtilities4" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo site_url('UserType')?>">User Type</a>
                        <a class="collapse-item" href="<?php echo site_url('AllUser')?>">All Users </a> 
                        <a class="collapse-item" href="<?php echo site_url('sovprocess')?>">SOV Process</a>
                        
                    </div>
                </div>
            </li> -->
           
             <!-- Divider -->
             <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <!-- Sidebar Message -->
            <!-- <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="{{ asset('asset/img/undraw_rocket.svg'); }}" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->

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
                                     if($this->session->userdata('user_id')){ 
                                        ?>
                                        <div>
                                         Welcome, <?php echo $this->session->userdata('user_name'); ?>
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
                                <!-- <a class="dropdown-item" href="<?php echo base_url('UserProfile')?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a> -->                              
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

