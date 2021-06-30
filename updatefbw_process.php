<?php
session_start();

	include('includes/dbconn.php');
	if(isset($_POST['pixsubmit'])){
	$package =  $_POST['package'];
	$size = $_POST['size'];
	$prize = $_POST['prize'];
	$status = $_POST['status'];
	
                                //image
                                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                                $image_name = addslashes($_FILES['image']['name']);
                                $image_size = getimagesize($_FILES['image']['tmp_name']);
//
                                move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
                                $location = "upload/" . $_FILES["image"]["name"];


	$sql = ("INSERT INTO foods VALUES (NULL,'$package','$size','$status','$location','$prize')") or die (mysqli_error());
	$result=mysqli_query($con, $sql);
				
			echo '<script>
					window.alert("Sucessfully Updated!")
					window.location.href="FBW.php";
				</script>';	
	}
	else if(isset($_POST['secondsubmit'])){
	$package =  $_POST['package'];
	$size = $_POST['size'];
	$prize = $_POST['prize'];
	$status = $_POST['status'];
	
                                //image
                                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                                $image_name = addslashes($_FILES['image']['name']);
                                $image_size = getimagesize($_FILES['image']['tmp_name']);
//
                                move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
                                $location = "upload/" . $_FILES["image"]["name"];


	$sql=("INSERT INTO foods VALUES (NULL,'$package','$size','$status','$location','$prize')") or die (mysqli_error());
	$result=mysqli_query($con, $sql);
				
			echo '<script>
					window.alert("Sucessfully Updated!")
					window.location.href="FBW.php";
				</script>';	
	}
	if(isset($_POST['thirdsubmit'])){
	$package =  $_POST['package'];
	$size = $_POST['size'];
	$prize = $_POST['prize'];
	$status = $_POST['status'];
	
                                //image
                                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                                $image_name = addslashes($_FILES['image']['name']);
                                $image_size = getimagesize($_FILES['image']['tmp_name']);
//
                                move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
                                $location = "upload/" . $_FILES["image"]["name"];


	$sql=("INSERT INTO foods VALUES (NULL,'$package','$size','$status','$location','$prize')") or die (mysqli_error());
	$result=mysqli_query($con, $sql);
			echo '<script>
					window.alert("Sucessfully Updated!")
					window.location.href="FBW.php";
				</script>';	
	}
mysqli_close($con);

?>