<?php
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

    # Database connection file
	include "../db_conn.php";


	/*check if author name is submitted*/

     if (isset($_POST['author_name'])) {

     	/** Get data from post request and storeit in var**/
     	$name = $_POST['author_name'];

     	#simple form validation
     	if (empty($name)) {
     		$em = "The author name is required";
     		header("Location: ../add-author.php?error=$em");
     		exit;
     	}else {
     		# Insert into Database
     		$sql  = "INSERT INTO authors (name)
     		                 VALUES (?)";
     		$stmt = $conn->prepare($sql);
     		$res  = $stmt->execute([$name]);

     		/** If there is no error while inserting data into  database **/
     		if ($res) {
     			# success message
     			$sm = "Successfully created!";
     		    header("Location: ../add-author.php?success=$sm");
     		    exit;
     	}else{
     		    # Error message
     			$em = "Unknown Error Occurred!";
     		    header("Location: ../add-author.php?error=$em");
     		    exit;
             }
    
        }
  }
}else{
header("Location: ../admin.php");
exit;
}