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
    $id = $_POST["ispid"];
    $pass = $_POST["password"];

    require_once('db_connection.php');
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_errno) {
      printf("Connect failed: %s\n", $conn->connect_error);
      exit();
    }
  // printf("Connected successfully");
   $query = "SELECT isp_id,Password FROM isp_admin where isp_id='$id'";
   if ($result = $conn->query($query)) {

   //printf("<br>%d record(s) found!<br>", $result->num_rows);
  if(($result->num_rows)>0){

      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
        // printf("%s %s                 ", $row["User_id"],$row["Password"] );
        if($pass == $row["Password"]){
            session_start();
            $_SESSION['ispid'] = $id;
            $_SESSION['password']= $pass;
            header('Location: ../../isp/all/ispadmin.php');
            // header('Location: ../../isp/all/test.php');
            // printf("yes");
        }
        else
        {
          session_start();
            $_SESSION['pass'] = "password incorrect";
            header('Location: ../../home/all/isplogin.php');
          // printf("incorrect id or password!");
          // printf("<br><button class='ui inverted blue button'><a href='isplogin.php'>Try Again</a></button>");
        }

      }
      $result->free(); //free result set
      }

   else
   {
    session_start();
      $_SESSION['id'] = "username doesn't exist";
      header('Location: ../../home/all/isplogin.php');
    //  printf("incorrect id or password!");
     
   }
}
   $conn->close();



?>

        
    </body>

</html>

