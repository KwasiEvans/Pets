<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../images/foods/logo.png" rel="shortcut icon">
    <title>ADMIN | Petshop Online Website</title>
    
    <!-- core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">  
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
</head><!--/head-->
<body>
     <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                     <a href="index.php"><h4 class="wow fadeInDown" style="margin-top:20px; color:#FFF;"><i class="fa fa-coffee"></i> Ordering Of Product</h4></a>
                </div>
    
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown"><a class="dropdown-toggle wow fadeInDown" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-th"></span> Product <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="addcnp.php"> Add Product </a></li>
                              <li><a href="update_cnp.php"> Update Product </a></li>
                            </ul>
                        </li>
                        <li id="reservation" class=" active wow fadeInDown"><a href="index.php"><span class="glyphicon glyphicon-calendar"></span> Orders</a></li>
                        <li id="admin" class="wow fadeInDown"><a href="adminacc.php"><span class="glyphicon glyphicon-user"></span> Admin Account</a></li>
                        <li id="logout" class="wow fadeInDown"><a id="logoutbtn" href='<?php echo "logout_process.php?logout=1"?>'><span class="glyphicon glyphicon-share"></span> Logout</a></li>                  
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
<br>

<div class="container">
   <form id="formFilter" name="formFilter" action="admin_reservefilter.php" method="POST" class="pull-left col-md-7 hidden-print">
        
        <div class="form-horizontal wow fadeInDown">            
                <label for="filter" class="control-label">  <i class="glyphicon glyphicon-filter"></i> VIEW RECORDS</label>
            <div class="col-md-6">  
                 
                <select name="filter" id="filter" class="form-control">
                    <option value="New">New</option>
                   
                    <option value="cancel">Cancel</option>
                    <option value="completed">Completed</option>
                </select>
               
            </div>
        </div>
    </form>

    <a href="" onClick="window.print();return false" class="btn btn-info pull-right hidden-print wow fadeInDown"><img src="images/ico/printer.ico" style="max-width: 24px; max-height: 24px;"> Print</a>
    <a href="index.php" class="btn btn-default pull-right hidden-print wow fadeInDown" style="margin-right:10px;"><img src="images/ico/refresh.png" style="max-width: 24px; max-height: 24px;"> Refresh</a>
    <div class="col-md-12" style="border: solid #D9D9D9 1px; padding: 10px; padding-top: 5px; box-shadow: #9F9F9F 2px 3px 5px; margin-top: 10px;">
   		<p class="wow fadeInDown"><em>Order List</em></p>
        <table class="table table-hover table-condensed wow fadeInDown">
            <thead style="background-color:#282828; color:#fff;">
                <tr>
                    <th class="hidden-print" style="text-align:center;"> <span class="glyphicon glyphicon-exclamation-sign"></span> Status</th>
                    <th width="120px" style="text-align:center;"><span class="glyphicon glyphicon-user"></span> From </th>
                    <th style="text-align:center;"><span class="glyphicon glyphicon-gift"></span>  Product </th>
                    <th style="text-align:center;"><span class="glyphicon glyphicon-tags"></span>  Address </th>
                    <th style="text-align:center;"><span class="glyphicon glyphicon-phone"></span>  Contact </th>
                    <th style="text-align:center;"><span class="glyphicon glyphicon-time"></span> Time </th>
                    
                </tr>
            </thead>
            <tbody id="tablebody">
               <?php include('includes/dbconn.php');



			   $stat = 'new';
			   $total = 0;
			   $sql = ("SELECT tblcnp.*,tblorders.* 
			   								FROM tblorders LEFT JOIN 
											tblcnp ON tblorders.cnpoid = tblcnp.id WHERE tblorders.ostatus = 'New' order by tblorders.id LIMIT 0,30 ") or die (mysqli_error());

        $result=mysqli_query($con, $sql);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){
						$total = $row['prize'] * $row['oqty'];?>
               <tr class="success" style="cursor:pointer;">
           		 <td style="text-align:center;"><a href="#viewModal<?php echo $row['id']?>" data-toggle="modal" data-target="#viewModal<?php echo $row['id']?>" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> View</a></td>
                <td style="text-align:center;"><?php echo $row['cname'];?></td>
                <td style="text-align:center;"><?php echo $row['name'];?></td>
                <td style="text-align:center;"><?php echo $row['address'];?></td>
                <td style="text-align:center;"><?php echo $row['contact'];?></td>
                <td style="text-align:center;"><?php echo $row['timestamp'];?></td>
               
               
               </tr>
               ?>
               <!-- Modal -->
<div class="modal fade" id="viewModal<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-exclamation-sign"></i> ORDER INFORMATION</h4>
      </div>
      <form method="post" action="">
      <div class="modal-body" id="div1">
      <input type="hidden" name="fdid" value="<?php echo $row['id']?>">
    
        <dl class="dl-horizontal wow fadeInDown" style="text-align:left">
        	
            <dt>Cake Ordered:</dt>
             <dd><?php echo $row['name'].' ';?><img src="<?php echo $row['image']?>" width="90px;" class="img-responsive img-rounded"></dd>
            <dt>Description:</dt> <dd><?php echo $row['description'];?></dd>
            <dt>Price:</dt> <dd><?php echo 'Shs. '.$row['prize'];?></dd>
            <dt>Quantity:</dt> <dd><?php echo $row['oqty'];?></dd>
            <dt>Total:</dt> <dd><?php echo 'Shs. '.number_format($total,2,'.',',');?></dd>
            <hr style="border-top: 1px dashed #8c8b8b;
	border-bottom: 1px dashed #fff;">
    		<h4 ><b>CUSTOMER DETAILS</b></h4>
            <dt>Ordered by:</dt> <dd><?php echo $row['cname'].' ';?></dd>
            <dt>Ordered Type:</dt> <dd><?php echo $row['otype'].' ';?></dd>
            <dt>Date Pick-up:</dt> <dd><?php echo $row['datepickup'].' ';?></dd>
            <dt>Date Order:</dt> <dd><?php echo $row['timestamp'];?></dd>
            <dt>Address:</dt> <dd><?php echo $row['address'];?></dd>
            <dt>Contact:</dt> <dd><?php echo $row['contact'];?></dd>
            
            <dt>Status:</dt> <dd><?php echo $row['ostatus'];?></dd>
        </dl>
  
      </div>
      <em style="font-size:12px;color:red; margin-left:20px;">Note: Updated Order status here</em>
      <div class="modal-footer"> 
        <a href="index.php" class="btn btn-default wow fadeInDown">Close</a>
        <button type="button" onClick="printContent('div1');" class="btn btn-info wow fadeInDown"><i class="glyphicon glyphicon-print"></i> Download Receipt</button>
        <button type="submit" class="btn btn-danger wow fadeInDown" name="cancel"><i class="glyphicon glyphicon-ban-circle"></i> Cancel</button>
        <button type="submit" class="btn btn-success wow fadeInDown" name="deliver"><i class="glyphicon glyphicon-send"></i> Delivered</button>
      </div>
      </form>
    </div>
  </div>
</div>
               <?php }}?>
            </tbody>
        </table>
       
    </div>
</div>
 
 <!-------------------------------------------------------OPEN MODAL MESSAGE---------------------------------------------------------------->
       <?php include('includes/dbconn.php');
	   if(isset($_POST['deliver'])){
		   $id = $_POST['fdid'];
		   $sql =("UPDATE tblorders set ostatus = 'Completed' WHERE id = '$id'") or die (mysqli_error());
		   
        $result=mysqli_query($con, $sql);
       if($result==true){
			   header("location:index.php");}
		   
		   }
		 else if(isset($_POST['cancel'])){
			 $id = $_POST['fdid'];
			 $sql = ("UPDATE tblorders set ostatus = 'Cancel' WHERE id = '$id'") or die (mysqli_error());
			 $result=mysqli_query($con, $sql);
       if($result== true){
				 header("location:index.php");}
			 }
		   ?>
       
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!--*************************************************** FOOTERS **********************************************-->
  
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <center>&copy; 2019 <a target="_blank" href="#" title="#">Petshop Online Website</a>. All Rights Reserved.</center>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

<script type="text/javascript">
    $('#filter').change(function() {
    $.post( $("#formFilter").attr("action"),
                 $("#formFilter :input").serializeArray(),
                 function(filter) { 
                    //alert (filter);
                    $("#tablebody").empty();
                    $("#tablebody").html(filter);
                 });    
        $("#formFilter").change( function() {
           return false;    
        });
    });

</script>

    
</body>
</html>