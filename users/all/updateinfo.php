<?php

	$First_Name = $_GET["First_Name"];

	$Last_Name = $_GET["Last_Name"];

	$Email = $_GET["Email"];

    $Address = $_GET["Address"];

	$mobile = $_GET["mobile"];

    $id = $_GET["userid"];

	require_once('db_connection.php');
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE user SET First_Name ='$First_Name',Last_Name='$Last_Name',Email='$Email',Address='$Address',mobile = '$mobile' WHERE user_id='$id'";

    if ($conn->query($sql) === TRUE) {
        header('Location:userinfo.php');
    // printf("<b>New Record Updated Successfully</b><br><button >
   
    //     <form action='userinfo.php' method='get'>
    //     <input type='hidden' name='userid' value='".$id."'> 
        
                                            
    //     <input type='submit' value='My Info' name='Edit' >
    //     </form>

  
    
    // </button></a>");
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();






?>