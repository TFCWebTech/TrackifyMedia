<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    border: 1px solid #c3c3c3;
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
</style>
</head>
<?php 
// echo "<pre>" ;
// print_r($news_details);
// echo "</pre>";
?>

<div class="container" >
    <div class="card" style="padding:10px;">
        <div class="row">
                <div class="header">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"> <img src="<?php echo base_url('assets/img/logo.png');?>" alt="logo" style="width:100px;"> <br>
                           
                            <a href="">powered by trackify media</a></td>
                            <td align="center">
                                <a href=""> <h5 >demo<br>
                                <span style="display:block;">Saturday, May 25, 2024 <br>
                                <span style="font-size:12px;">  0 News / <a href=""> view consolidated</a></span>
                                </span>
                            </h5>
                            </td>
                            <td align="right"> 
                                <!-- <img src="<?php echo base_url('assets/img/logo.png');?>" alt="logo" style="width:100px;"> -->
                            </td>
                        </tr>
                    </table>
                </div>    
            
                <div class="body-content" >
                <h2 style="padding-left: 5px;"><a href>  Demo headline</h2>
                                    <div class="col-md-12 mt-3">
                                            <p >
                                                demo artical
                                            </p>
                                    </div>
                </div>
            <div class="col-md-12" >
                <div class="d-flex justify-content-between" >
                        <div class="logo" style="text-align:left; ">
                                <img src="<?php echo base_url('assets/img/logo.png');?>" alt="logo" style="width:100px;  padding:5px;"> <br>
                            
                        </div>
                    <div class="footer" style="text-align:center; ">
                   
                    </div>
                    <div class="footer" style="text-align:end;">
                    
                    </div>
                </div>
                <p >This is an auto generated email – please do not reply to this email id</p>
            </div>
        </div>
    </div>
</div>

</div>