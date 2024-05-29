<style>
        .upload-container {
            text-align: center;
        }

        .custom-file-upload {
            display: inline-block;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
        }

        .custom-file-upload img.upload-icon {
            /* width: 50px;
            height: 50px; */
            display: block;
            margin: 0 auto 10px;
        }

        #file-upload {
            display: none;
        }

        .preview {
            display: none;
            margin-top: 20px;
        }
    </style>
    <head>
    <meta name="csrf-token-name" content="<?php echo $csrf_token_name; ?>">
    <meta name="csrf-token-value" content="<?php echo $csrf_token_value; ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    
 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
   
</div>
<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Clients</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">400</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Reporters</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">500</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Admins
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50</div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow p-3 upload-container">
            <label for="file-upload" class="custom-file-upload">
                <img src="<?php echo base_url('assets/img/images/upload.png');?>" alt="Upload Icon" class="upload-icon" width="100%">
                <span>Upload Image</span>
            </label>
            <input type="file" multiple name="image_upload[]" id="file-upload" accept="image/*"/>
        </div>
        <div class="preview">
            <img id="previewImage" src="" alt="Image Preview" style="max-width: 100%; height: auto;"  onclick="addMoreFields()">
        </div>
    </div>
   <!--   <div class="form-group files">
                <label>Upload Your Image</label>
                <input type="file" class="form-control" multiple="" name="image_upload[]" id="image_upload" accept="image/*">
            </div> -->
    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow p-3">
            <img src="<?php echo base_url('assets/img/images/copy_paste.png');?>" alt="" width="100%" height="325px">
        </div>
    </div>
</div>

</div>

</div>
<!-- /.container-fluid -->
<script>
 $(document).ready(function() {
        let counter = 0; // Initialize the counter variable

        $('#file-upload').on('change', function() {
            const files = this.files; // Get all selected files
            const formData = new FormData();

            // Append each file to FormData object
            for (let i = 0; i < files.length; i++) {
                formData.append('image_upload[]', files[i]); // Use [] to indicate array
            }

            // Get CSRF token from meta tags
            const csrfTokenName = $('meta[name="csrf-token-name"]').attr('content');
            const csrfTokenValue = $('meta[name="csrf-token-value"]').attr('content');

            // Send AJAX request to store the images
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Reporter/saveArticalImage')?>",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    [csrfTokenName]: csrfTokenValue // Include CSRF token in headers
                },
                success: function(response) {
                    if (response.success) {
                        console.log("AJAX Success: Storing image data in localStorage");
                        // Store image data in local storage
                        localStorage.setItem('imageData', JSON.stringify(response.image_data));
                        
                        // Verify that the data was stored
                        const storedData = localStorage.getItem('imageData');
                        console.log("Stored Data in localStorage:", storedData);

                        // Redirect to news_upload page
                        window.location.href = "<?php echo site_url('NewsUpload/newsUpload') ?>";
                    } else {
                        console.error("Error:", response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });
    });
</script>
    </script>