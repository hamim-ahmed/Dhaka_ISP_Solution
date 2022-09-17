<?php

require_once("db_connection.php");
$id = $_POST['ispid'];
$p =$_POST['packagename'];
$complain=$_POST['complain'];
$uid = $_POST['userid'];
//$id = $_POST['ispid'];
//$packagename = $_POST['packagename'];

    // printf("%s",$id);    
    // printf("%s",$p);
    // printf("%s", $uid);
    // printf("%s",$complain);  
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE subscriber_list SET reply ='$complain' WHERE isp_id=$id AND package_name='$p' AND subscriber_id='$uid' ";

    if ($conn->query($sql) === TRUE) {
    printf("<b><b>Issue Report Successful</b></b><br><button >
   
        <form action='userreport.php' method='post'>
        <input type='hidden' name='userid' value='".$uid."'> 
        
                                            
        <input type='submit' value='my Panel' name='Edit' >
        </form>

  
    
    </button></a>");
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: adminreport.php');


   
?>