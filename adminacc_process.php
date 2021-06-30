<?php
		session_start();

		include('includes/dbconn.php');
if(isset($_POST['update'])){
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$id = $_SESSION['proprietor_id'];

		$name = $_POST['proprietor_name'];
		$phone = $_POST['phone'];
		$mail = $_POST['email'];
		$nusername = $_POST['nuname'];
		$npassword = $_POST['npword'];
	
	
		
		if (empty($nusername) || empty($npassword))
				echo "Please fill all fields";
		else { 
		
			$sql = "SELECT * FROM admininfo WHERE username='$username' and password='$password'" ;
			
			$result = mysqli_query($sql);
			
			if(mysqli_num_rows($result)==0){
				echo "Invalid username and password";
				header("location:adminacc.php");}
			else
			{
			$sql=("UPDATE admininfo SET name='$name', 
											  
											 contact='$phone', 
											 email = '$mail',
											 username='$nusername',
											 password='$npassword' WHERE id='$id'") or die(mysqli_error());
			$result=mysqli_query($con, $sql);
			$_SESSION['username'] = $nusername ;
			$_SESSION['password'] = $npassword ;

			echo "<script>alert('Save Successfully!');
						window.location.href='adminacc.php';</script>";
			
			}
		}}
		else if (isset($_POST['save'])) {
			$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$id = $_SESSION['proprietor_id'];

		$name = $_POST['proprietor_name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$nusername = $_POST['nusername'];
		$npassword = $_POST['npassword'];
		$dob = $_POST['date'];
		$type = $_POST['type'];
		
		if (empty($nusername) || empty($npassword))
				echo "Please fill all fields";
		else { 
		
			$sql = "SELECT * FROM userinfo WHERE username='$username' and password='$password' and id = '$id'" ;
			
			$result = mysqli_query($sql);
			
			if(mysqli_num_rows($result)==0){
				echo "Invalid username and password";
				header("location:adminacc.php");}
			else
			{
			$sql=("INSERT INTO userinfo VALUES(NULL,'$name','$address','$phone','$dob','$nusername','$npassword','$type')") or die(mysqli_error());
			$result=mysqli_query($con, $sql);

			echo "<script>alert('Save Successfully!');</script>";
			header("location:adminacc.php");
			}
		}
			
			}
		mysqli_close($con);
?>