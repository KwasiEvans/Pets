<!-- Modal -->
<div class="modal fade" id="updateModal<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> UPDATE CAKES</h4>
      </div>
      <form class="form-horizontal" enctype="multipart/form-data" method="post" action="">
 
      <div class="modal-body">
      <div class="row">
      <div class="col-lg-2">
    <label class="pull-right">Name*</label>
  </div>
  <div class="col-lg-10">
	   <textarea name="name" class="form-control" required><?php echo $name; ?></textarea>
       <input type="hidden" class="form-control" id="fdid" name="fdid"  value="<?php echo $id;?>" required>

</div></div><br>
<div class="row">
<div class="col-lg-2">
    <label class="pull-right">Description*</label>
    </div>
    <div class="col-lg-10">
   
      <textarea name="des" class="form-control" required><?php echo $des; ?></textarea>
  </div></div><br>
  <div class="row">
  <div class="col-lg-2">
    <label class="pull-right">Amount*</label></div>
    <div class="col-lg-10">
   
      <input type="number" class="form-control" id="prize" name="prize" placeholder="<?php echo $prize;?>" value="<?php echo $prize;?>" required>
  </div></div><br>
  <div class="row">
  <div class="col-lg-2">
    <label class="pull-right">Status*</label>
   </div><div class="col-lg-10">
      <select name="stat" class="form-control" required>
      <option value="<?php echo $stat;?>"><?php echo $stat;?></option>
      <option>Select</option>
      <option value="Available">Available</option>
      <option value="Un-Available">Un-Available</option>
      </select>
   </div></div><br>
   <div class="row">
   <div class="col-lg-2">
    <label class="pull-right">Image</label>
   </div>
   <div class="col-lg-10">
    <img src="<?php echo $image;?>" width="120px;" class="img-responsive img-rounded" style="margin-bottom:5px;">
      <input type="file" class="form-control" id="image" name="image"required>
    </div></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" name="savechanges">Save changes</button>
      </div>
  
      </form>
    </div>
  </div>
</div>
<?php include('includes/dbconn.php');
if(isset($_POST['savechanges'])){
		$id = $_POST['fdid'];
		$name = $_POST['name'];
		$des = $_POST['des'];
		$stat = $_POST['stat'];
		$prize = $_POST['prize'];
		
                                //image
                                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                                $image_name = addslashes($_FILES['image']['name']);
                                $image_size = getimagesize($_FILES['image']['tmp_name']);
//
                                move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
                                $location = "upload/" . $_FILES["image"]["name"];
								
				$sql = ("UPDATE tblcnp set name = '$name',
													   description = '$des',
													   status = '$stat',
													   prize = '$prize',
													   image = '$location' WHERE id = '$id'") or die (mysqli_error());
        $result=mysqli_query($con, $sql);
				if($result==true){
					echo '<script>alert("Update successfully!");
								  window.location.href="update_cnp.php"</script>';
					}
					else{
						echo '<script>alert("Sorry unable to process your request!");
								  window.location.href="update_cnp.php"</script>';
						}
	
	
	}
	mysqli_close($con);
	?>