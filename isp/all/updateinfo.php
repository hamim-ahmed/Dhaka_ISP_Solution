<?php

	$Name = $_POST["isp_name"];

	$area = $_POST["coverage"];

	$Email = $_POST["Email"];

    $Address = $_POST["Address"];

	$mobile = $_POST["mobile"];

    $id = $_POST["ispid"];

	require_once('db_connection.php');
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE isp_admin SET isp_name ='$Name',area_coverage='$area',
    Email='$Email',office_address='$Address',mobile = '$mobile' WHERE isp_id='$id'";

    if ($conn->query($sql) === TRUE) {
        // printf("done");
        // header('Location:ispinfo.php');
    // printf("<b>New Record Updated Successfully</b><br><button >
   
    //     <form action='userinfo.php' method='POST'>
    //     <input type='hidden' name='userid' value='".$id."'> 

                                            
    //     <input type='submit' value='My Info' name='Edit' >
    //     </form>

  
    
    // </button></a>");
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();


?>
<?php
require_once('db_connection.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// if(isset($_POST["submit"])){
//   $name = $_POST["name"];
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> 
    document.location.href = 'ispinfo.php'; 
    </script>"
    ;
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
        document.location.href = 'ispinfo.php';
      </script>
      ";
    }
    else if($fileSize > 1000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
        document.location.href = 'ispinfo.php';
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, '../../images/' . $newImageName);
    //   $query = "INSERT INTO tb_upload VALUES('', '$name', '$newImageName')";
    $query = "UPDATE isp_admin SET image = '$newImageName' WHERE isp_id='$id'";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Successfully Added');
        document.location.href = 'ispinfo.php';
      </script>
      ";
    }
  }
// }
?>