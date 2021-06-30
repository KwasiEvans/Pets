
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="images/foods/logo.png" rel="shortcut icon">
    <title>Petshop Online Website</title>
	
	<!-- core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">  
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">


<!--*********************************************START OF NAVIGATION BAR****************************************--> 
      
			
            	<table class="table table-responsive table-hover" style="border: 1px dashed #8c8b8b;
                border-top: 1px dashed #8c8b8b;">


         <?php include('includes/dbconn.php');
        $count = 0;
        $id = 0;
        $sql = "SELECT * FROM tblcnp WHERE status = 'available' order by id desc" or die (mysqli_error($con));
        
        $result=mysqli_query($con, $sql) or die (mysqli_error($con));
        
        if(mysqli_num_rows($result)>=0){
          while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $count++;
        ?>




                	<tr style="border: 1px dashed #8c8b8b; cursor:pointer;">
                    <td  style="border: 1px dashed #8c8b8b;"><center><strong class="wow fadeInDown"><p style="margin-top:25px;">No.<?php echo $count;?></p></strong></center></td>
                    	<td style="border: 1px dashed #8c8b8b;"><center><img src="<?php echo $row['image']?>" width="120px;" class="img-responsive img-rounded wow fadeInDown"></center></td>
                        <td style="border: 1px dashed #8c8b8b;"> 
                        <dl class="dl-horizontal wow fadeInDown" style="text-align:left">
                        <dt>Name:</dt> <dd><?php echo $row['name'];?></dd>
						            <dt>Description:</dt> <dd><?php echo $row['description'];?></dd>
                        <dt>Prize:</dt> <dd><?php echo $row['prize'];?></dd>
                        </dl></td>
                        <td style="border: 1px dashed #8c8b8b;"><button class="btn btn-success  wow fadeInDown" name="order" type="button" style="margin-top:25px;" data-toggle="modal" data-target="#orderModal<?php echo $id;?>"><i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart</button></td>
                    </tr>
                     <!-- Modal -->
<div class="modal fade" id="orderModal<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> CUSTOMER INFORMATION</h4>
      </div>
      <form class="form-horizontal" enctype="multipart/form-data" method="post" action="">
      <div class="modal-body">
      <p>Fields with (*) are required</p>
      <div class="row">
       <div class="col-lg-2">
    <label>Name*</label>
    </div>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="name" name="name" placeholder="Your name" required>
       <input type="hidden" class="form-control" id="fooddid" name="foodid"  value="<?php echo $id;?>" required>
    </div>
  </div>
  <div class="row">
  <div class="col-lg-2">
    <label>Address*</label></div>
    <div class="col-lg-10">
      <textarea class="form-control" name="address" required></textarea>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2">
    <label>Contact*</label></div>
    <div class="col-lg-10">
      <input type="text" name="contact" class="form-control" required placeholder="Your number">
    </div>
  </div>
    <div class="row">
    <div class="col-lg-2">
    <label>Quantity*</label></div>
    <div class="col-lg-10">
      <input type="number" name="oqty" class="form-control" required placeholder="0">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2">
    <label>Order Type*</label></div>
    <div class="col-lg-10">
      <select name="otype" class="form-control" required>
      	<option>Select</option>
      	<option value="Deliver">Deliver</option>
        <option value="Pick-up">Pick-up</option>
      </select>
    </div>
  </div>
   <div class="row" id="datepickup">
    <div class="col-lg-2">
    <label>Date Pick up*</label></div>
    <div class="col-lg-10">
      <input type="date" name="datep" class="form-control" />
    </div>
  </div>
  
 </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" name="savechanges"><i class="glyphicon glyphicon-thumbs-up"></i> Order</button>
      </div>
      </form>
    </div>
  </div>
</div>
 <?php }}

 else {echo '<strong style="color:red">No availables data in server</strong>'; } 

 ?>
</table>
            
         
 
<?php include('includes/dbconn.php');
if(isset($_POST['savechanges'])){
		$id = $_POST['foodid'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$qty = $_POST['oqty'];
		$otype = $_POST['otype'];
		$datep = $_POST['datep'];


		$sql =("SELECT * FROM tblorders WHERE cname = '$name'") or die (mysqli_error());
    $result=mysqli_query($con, $sql);
			if(mysqli_num_rows($result)==5){
					echo '<script>alert("You reach maximum order of 5");
								window.loaction.href="availableframe.php";</script>';
				}
				else{

				$sql = ("INSERT INTO tblorders VALUES(NULL,'$name','$address','$contact','$id','$qty','new',NULL,'$otype','$datep')") or die (mysqli_error());
        $result=mysqli_query($con, $sql);
							if($result==true){
								echo '<script>alert("Your order will be process.The system will follow up by contacting your number thankyou!");
											 window.location.href="availableframe.php"</script>';}
											 else{
												 echo '<script>alert("Sorry unable to process your request. please try again later!");
											 window.location.href="availableframe.php"</script>';
												 }
	}	}
?>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>

 <script type="text/javascript">
    $("#datepickup").hide();
    

   $(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("value")=="Pick-up"){
               
                $("#datepickup").show(200);
               
            }
            else{
                $("#datepickup").hide();
               
            }

        });
    }).change();
    });
  </script>