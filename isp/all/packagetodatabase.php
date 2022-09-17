
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
        <title>Dhaka ISP Solution</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">    <!-- semantic-ui cdn -->   <!--bootstrep-->
    </head>

    <body>
      <?php
          $p_name = $_POST["name"];
          $p_speed = $_POST["speed"];
          $p_price = $_POST["price"];
          $p_offer = $_POST["offer"];
          
          session_start();
          $id = $_SESSION['ispid'];
          require_once('db_connection.php');
          
          $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_errno) {
            printf("Connect failed: %s\n", $conn->connect_error);
            exit();
          }


          $query = "SELECT isp_id,isp_name FROM isp_admin where isp_id='$id'";
          if ($result = $conn->query($query)) {
       
          //printf("<br>%d record(s) found!<br>", $result->num_rows);
          if(($result->num_rows)>0){
       
          /* fetch associative array */
          while ($row = $result->fetch_assoc()) {
              extract($row);
              $isp = $isp_name;
              echo $isp;

           // printf("%s %s                 ", $row["User_id"],$row["Password"] );
            
               // header('Location: ../../isp/all/test.php');
               // printf("yes");
            }
       
          }
          $result->free(); //free result set
          }




          $sql = "INSERT INTO isp_info (isp_id, packages, package_name, package_cost,offers,isp_name)
                                    VALUES ('$id', '$p_speed', '$p_name', '$p_price', '$p_offer', '$isp')";
        
        if ($conn->query($sql) === TRUE) {
            echo "$ Successfull";
            header('Location: ispadmin.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();

    ?>
 
    </body>

</html>


