<?php
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

    # Database connection file
	include "../db_conn.php";


	/*check if category name is submitted*/

     if (isset($_POST['category_name'])) {

     	/** Get data from post request and storeit in var**/
     	$name = $_POST['category_name'];

     	#simple form validation
     	if (empty($name)) {
     		$em = "The category name is required";
     		header("Location: ../add-category.php?error=$em");
     		exit;
     	}else {
     		# Insert into Database
     		$sql  = "INSERT INTO categories (name)
     		                 VALUES (?)";
     		$stmt = $conn->prepare($sql);
     		$res  = $stmt->execute([$name]);

     		/** If there is no error while inserting data into  database **/
     		if ($res) {
     			# success message
     			$sm = "Successfully created!";
     		    header("Location: ../add-category.php?success=$sm");
     		    exit;
     	}else{
     		    # Error message
     			$em = "Unknown Error Occurred!";
     		    header("Location: ../add-category.php?error=$em");
     		    exit;
             }
    
        }
  }
}else{
header("Location: ../admin.php");
exit;
}