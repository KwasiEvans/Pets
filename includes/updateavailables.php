

            <div class="col-md-12" style="background-color:#fff; border: solid #D9D9D9 1px; padding: 10px; padding-top: 5px; box-shadow: #9F9F9F 2px 3px 5px; margin-top: 10px; height:700px;">
            

    
        <div class="panel panel-primary">
            <div class="panel-heading panel-title text-center wow fadeInDown">
                <span style="font-weight:bold; font-family:verdana;"><i class="glyphicon glyphicon-list-alt"></i> Product List</span>
            </div>
            <div class="panel-body" style="background-color:#fff;">
                 <!--   Basic Table  -->
              <table class="table table-responsive table-hover table-bordered table-condensed table-striped wow fadeInDown" width="100%">
              	<thead>
                	<tr style="background-color:#000; color:#FFF;">
                    	<td style="text-align:center; width:auto;" class="wow fadeInDown">NAME</td>
                        <td style="text-align:center; width:auto;" class="wow fadeInDown">DESCRIPTION</td>
                        <td style="text-align:center; width:auto;" class="wow fadeInDown">PRIZE</td>
                        <td style="text-align:center; width:auto;" class="wow fadeInDown">STATUS</td>
                        <td style="text-align:center; width:auto;" class="wow fadeInDown">IMAGE</td>
                        <td style="text-align:center; width:auto;" class="wow fadeInDown">ACTION</td>
                        
                    </tr>
                    <tbody>
                    <?php include('includes/dbconn.php');
					$id = 0;
					$sql = ("SELECT *  FROM tblcnp order by id DESC") or die (mysqli_error());
                    $result=mysqli_query($con, $sql);
					if(mysqli_num_rows($result)>0){
						while($row = mysqli_fetch_assoc($result)){
							$id = $row['id'];
							$name = $row['name'];
							$des = $row['description'];
							$prize = $row['prize'];
							$stat = $row['status'];
							$image = $row['image'];?>
                    	<tr style="font-size:16px; cursor:pointer;">
                        	<td class="wow fadeInDown"> <center><strong><?php echo $row['name'];?></strong></center></td>
                            <td class="wow fadeInDown"> <center><strong><?php echo $row['description'];?></strong></center></td>
                            <td class="wow fadeInDown"> <center><strong><?php echo 'P'.$row['prize'];?></strong></center></td>
                            <td class="wow fadeInDown"> <center><strong><?php echo $row['status'];?></strong></center></td>
                            <td class="wow fadeInDown"> <center><img src="<?php echo $row['image'];?>" width="100px;" class="img-responsive img-rounded" /></center></td>
                            <td class="wow fadeInDown"><center><a href="#updateModal<?php echo $id;?>" data-toggle="modal" data-target="#updateModal<?php echo $id;?>" class="btn btn-default">Update</a> | <a href="#deleteModal<?php echo $id;?>" data-toggle="modal" data-target="#deleteModal<?php echo $id;?>" class="btn btn-danger"> Delete</a></center></td>
                        </tr>
                       <?php include('updateModal.php')?>
                       <?php include('deleteModal.php')?>
                        <?php }}?>
                    </tbody>
                </thead>
              
              </table>
                  <!-- End  Basic Table  -->
       
        </div>
    </div>
</div> 
