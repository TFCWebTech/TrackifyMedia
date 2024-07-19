<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx-style/0.8.13/xlsx-style.min.js"></script>

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
/* @media (min-width: 768px) { */
        .table-container-responsive{
            overflow-x: auto;
        }
    /* } */
</style>
<div class="container" >
    <div class="row">
        <div class="col-md-12">
            <h6 class="text-primary font-weight-bold p-2">
                Reports
            </h6>
        </div>
    </div>
        <!-- <div class="card p-3 my-2"  id="headlineSearchSection" > -->
            <form>
                <div class="row">
                    <div class="col-md-12 card p-3">
                        <div class="row ">
                            <div class="col-md-6 d-flex">
                                    <label class="px-1 font-weight-bold mt-1" for="publication_type">Select Client</label>
                                    <select class="form-control" name="select_client" id="select_client" style="width:200px;">
                                    <option disbled>Select</option>
                                            <?php foreach($clients as $values){?>
                                            <option value="<?php echo $values['client_id'];?>"> <?php echo $values['client_name'];?></option>
                                            <?php }?>
                                    </select>
                            </div>
                            <div class="col-md-6 text-right d-flex">
                                <label class="px-2 font-weight-bold mt-1" >Date </label>
                                <input type="date" name="from_date" id="from_date" class="form-control px-2 mx-1"> 
                                <input type="date" name="to_date" id="to_date" class="form-control px-2 mx-1"> 
                            </div>
                        </div>
                        <div class="border-with-text mt-3" data-heading="Filter Options">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="px-1 font-weight-bold" for="publication_type">Publication Type</label>
                                    <select class="form-control" name="publication_type" id="publication_type">
                                    <option value="" disbled>Select</option>
                                            <?php foreach($publication_type as $values){?>
                                            <option value="<?php echo $values['gidPublicationType'];?>"> <?php echo $values['PublicationType'];?></option>
                                            <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="px-1 font-weight-bold" for="Cities">Cities</label>
                                    <select class="form-control" name="Cities" id="Cities">
                                    <option value="" disbled>Select</option>
                                            <?php foreach($news_city as $values){?>
                                            <option value="<?php echo $values['gidNewscity'];?>"> <?php echo $values['CityName'];?></option>
                                            <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="px-1 font-weight-bold" for="eDossier "> Download PDF </label> <br>
                                    <a onclick="downloadPDF()" class="btn border">Print</a>  
                                </div>
                                <div class="col-md-2">
                                    <label class="px-1 font-weight-bold" for="eDossier "> Download Excel </label> <br>
                                    <a onclick="downloadWord()" class="btn border">Excel</a>
                                </div>
                                <!-- <div class="col-md-2 mt-3 pt-2">
                                    <button class="btn btn-primary">Search</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

<style>
   
   .table-wrapper {
       overflow-x: auto;
   }
   
   table {
       border-collapse: collapse;
       width: 100%;
   }
   
   td {
       padding: 5px;
       width: 33%;
   }
   
   th {
       text-align: center;
       padding: 5px;
   }
   
   .table-wrapper > table,
   .table-wrapper > table td,
   .table-wrapper > table th {
       border: 2px solid #ffffff;
   }
   .header_contert {
               display: flex;
               justify-content: space-between;
           }
   
           @media (max-width: 725px) {
               .header_contert {
                   display: block;
                   text-align: center;
               }
           }
           p{
               margin-top:0px !important;
               margin-bottom:0px !important;
           }
           h5 , h6{
               margin-top: 0px !important;
               margin-bottom: 0px !important;
           }
   </style>

   <div class="container" id="printData" style="display:none;">
        <div class="row">
            <div class="col-md-12 text-right mb-2">
                <a href="<?php echo site_url('NewsLetter/sendMail/'.$details['client_id']);?>"> <i class="fa fa-send-o" style="font-size:36px;color:red"></i></a>
            </div>
        </div>
        <div class="card" style="background-color: #F9F9F9;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="width:100%; background-color: ; margin-top:10px; ">
                        <tr>
                            <td align="left" style="padding-top:50px; margin-right:5px;">   
                            <img src="https://pressbro.com/News/assets/img/mediaLogo.png" alt="logo" style="width:100px;"> <br>
                            </td>
                            <td align="center">
                                <?php 
                                    echo $details['client_name'];
                                ?>
                            </td>
                            <td align="right"> 
                               
                            </td>
                        </tr>
                    </table>
                <hr>
                    <h4 style="background-color: #F1DAD5; color: #ffffff; padding:4px;">
                    </h4>
                    <?php
                    if (!empty($get_client_details)) {
                        foreach ($get_client_details as $detail) {
                            if (!empty($detail['client_news'])) {
                                foreach ($detail['client_news'] as $news) {
                                    ?>
                                    <h5>
                                        <a href="<?php echo site_url('ClienttDashbord/Home/DisplayNews/' . $news['news_details_id']); ?>"
                                        >
                                                <?php echo $news['head_line']; ?>
                                        </a>
                                    </h5>
                                    <p>Summary: </p>
                                    <span >
                                            <?php echo $news['summary']; ?> 
                                        </span>
                                    <!-- </p> -->
                                    <p>Date: <?php echo date('d-m-Y', strtotime($news['create_at'])); ?>,
                                        Publication: <span style="color:blue;"><?php echo $news['MediaOutlet']; ?></span>,
                                        Journalist / Agency: <span style="color:blue;"><?php echo $news['Journalist']; ?></span>,
                                        Edition: <span style="color:blue;"><?php echo $news['Edition']; ?></span>,
                                        Supplement: <span style="color:blue;"><?php echo $news['Supplement']; ?></span>,
                                        No of pages: <span style="color:blue;"><?php echo $news['page_count']; ?></span>,
                                        Circulation Figure: <span></span>,
                                        qAVE(Rs.): <span></span>
                                    </p>
                                    <hr>
                                <?php }
                            } else {
                                echo '<p>No client news available.</p>';
                            }
                        }
                    }
                    ?>
</div>
    </div>
    </div>
<script>

function downloadWord() {
    var select_client = document.getElementById('select_client').value;
    var from_date = document.getElementById('from_date').value;
    var to_date = document.getElementById('to_date').value;
    var publication_type = document.getElementById('publication_type').value;
    var Cities = document.getElementById('Cities').value;
    console.log('select_client :', select_client); // Debugging line
    console.log('From Date:', from_date); // Debugging line
    console.log('To Date:', to_date); // Debugging line
    console.log('Publication Type:', publication_type); // Debugging line
    console.log('Cities:', Cities); // Debugging line

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Report/exportWord'); ?>",
        dataType: 'json', // Expecting JSON response
        data: {
            select_client: select_client,
            from_date: from_date,
            to_date: to_date,
            publication_type: publication_type,
            Cities: Cities,
        },
        success: function(response) {
    console.log("Update successful", response);

    var clientName = response.client_name;
    var fromDate = response.from_date;
    var toDate = response.to_date;
    var data = response.data;

    // Prepare the data for the worksheet
    var worksheetData = [
        [{v: "Client Name: " + clientName, s: {alignment: {horizontal: "center", vertical: "center"}}}],
        [{v: "Date Range: " + fromDate + " to " + toDate, s: {alignment: {horizontal: "center", vertical: "center"}}}],
        [],
        ["News Date", "Headline", "Edition", "Supplement", "Page No", "Height", "Width", "Total AVE" ]
    ];

    // Prepare the cell styles
    var headerStyle = {font: {bold: true}, alignment: {horizontal: "center", vertical: "center"}};
    var centerStyle = {alignment: {horizontal: "center", vertical: "center"}};

    // Add data rows
    data.forEach(function(row) {
        var createDate = new Date(row.create_at);
        var formattedDate = createDate.toLocaleDateString('en-GB', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });

        if (row.news_articles && row.news_articles.length > 0) {
            row.news_articles.forEach(function(article) {
                worksheetData.push([
                    {v: row.create_at ? formattedDate : "NA"},
                    {v: row.head_line || "NA", s: headerStyle, l: {Target: row.website_url || '#'}},
                    {v: row.Edition || "NA"},
                    {v: row.Supplement || "NA"},
                    {v: article.page_no || "NA"},
                    {v: article.image_height || "NA"},
                    {v: article.image_width || "NA"},
                    {v: row.total_ave || "NA"}
                ]);
            });
        } else {
            worksheetData.push([
                {v: row.create_at ? formattedDate : "NA"},
                {v: row.head_line || "NA", s: headerStyle, l: {Target: row.website_url || '#'}},
                {v: row.Edition || "NA"},
                {v: row.Supplement || "NA"},
                {v: "NA"},
                {v: "NA"},
                {v: "NA"},
                {v: row.total_ave || "NA"},
            ]);
        }
    });

    // Create a new workbook and worksheet
    var wb = XLSX.utils.book_new();
    var ws = XLSX.utils.aoa_to_sheet(worksheetData);

    // Apply styles to the worksheet
    for (var i = 0; i < worksheetData.length; i++) {
        var row = worksheetData[i];
        for (var j = 0; j < row.length; j++) {
            if (row[j].s) {
                ws[XLSX.utils.encode_cell({r: i, c: j})].s = row[j].s;
            }
        }
    }

    // Center the client name and date range cells
    ws['A1'].s = centerStyle;
    ws['A2'].s = centerStyle;

    // Add the worksheet to the workbook
    XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

    // Generate Excel file and trigger download
    XLSX.writeFile(wb, "data.xlsx");
},
error: function(xhr, status, error) {
    console.error("Error:", error);
}
});
}
</script>

<script>
    $('table').DataTable();
</script>

<script>
    function downloadPDF() {
    var select_client = document.getElementById('select_client').value;
    var from_date = document.getElementById('from_date').value;
    var to_date = document.getElementById('to_date').value;
    var publication_type = document.getElementById('publication_type').value;
    var Cities = document.getElementById('Cities').value;
    console.log('select client:', select_client);
    console.log('From Date:', from_date); // Debugging line
    console.log('To Date:', to_date); // Debugging line
    console.log('Publication Type:', publication_type); // Debugging line
    console.log('Cities:', Cities); // Debugging line

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Report/downloadPDF'); ?>",
        dataType: 'json', // Expecting JSON response
        data: {
            select_client: select_client,
            from_date: from_date,
            to_date: to_date,
            publication_type: publication_type,
            Cities: Cities,
        },
        success: function(response) {
            // Log the response to see what's coming back
            console.log(response);

            // Check if the response indicates success and contains a valid PDF URL
            if (response.success && response.pdf_url) {
                // Use JavaScript to initiate the download
                var link = document.createElement('a');
                link.href = response.pdf_url;
                link.download = 'downloaded_pdf.pdf'; // Optional: Specify the filename for download
                link.click();
                window.open(response.pdf_url, '_blank'); 
            } else {
                // Handle error or no valid PDF URL case
                alert('Failed to generate PDF or PDF URL is invalid.');
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error:', status, error);
            alert('AJAX Error: Failed to fetch PDF data.');
        }
    });
}
</script>

<!-- <script>
function downloadPDF() {
    // Get the content of the div
    var divToPrint = document.getElementById('printData');
    
    // Create a new window
    var newWin = window.open('', 'Print-Window');
    
    // Write the content to the new window
    newWin.document.open();
    newWin.document.write('<html><head><title>Print</title>');
    newWin.document.write('<style>/* Include any necessary CSS here */</style>');
    newWin.document.write('</head><body onload="window.print()">');
    newWin.document.write(divToPrint.innerHTML);
    newWin.document.write('</body></html>');
    newWin.document.close();
    
    // Set a timeout to close the new window after printing
    setTimeout(function() { newWin.close(); }, 10);
}
</script> -->