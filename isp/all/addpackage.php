<?php 
      $flag = 0;
      if(isset($_POST['name'])){
          $p_name = $_POST["name"];
          $p_speed = $_POST["speed"];
          $p_price = $_POST["price"];
          $p_offer = $_POST["offer"];
          $monthly_fee=$_POST['monthly_fee'];
          
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

          $query = "SELECT isp_id,package_name FROM isp_info where isp_id='$id'";
          if ($result = $conn->query($query)){
            if(($result->num_rows)>0){
              while ($row = $result->fetch_assoc()) {
                extract($row);
                if($package_name == $p_name){
                  $flag = 1;

                }
               
              }
            }

            $result->free(); //free result set
          }

          if($flag == 0){
            $sql = "INSERT INTO isp_info (isp_id, packages, package_name, package_cost,offers,monthly_fee,isp_name)
                                    VALUES ('$id', '$p_speed', '$p_name', '$p_price', '$p_offer','$monthly_fee', '$isp')";
        
            if ($conn->query($sql) === TRUE) {
                echo "$ Successfull";
                header('Location: ispadmin.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
          }
          else{
            echo "<script> alert('Duplicate Package Name used'); </script>";
          }



      }
          

    ?>



<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <title>Dhaka ISP Solution</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css'>    <!-- semantic-ui cdn -->   <!--bootstrep-->
        <link rel='stylesheet' href='../css/style1.css'>
        <style>
        

        </style>
       
    </head>
    <body>
      <div class='outer'>
              <div class='topbar'>
                  <div class='topleft'>
                    <a class='active' href='ispadmin.php'>My Panel</a>
                    <a href='adminreport.php'>Users & Complain</a>
                    <!-- <a class=' href='userlogin.php'>USER-LOGIN</a> -->
                  </div>
                  <div class='topright'>
                    <!-- <a href='ispsignup.php'>ISP-SIGNUP</a> -->
                    <a class='' href='isplogin.php'>My Info</a>
                    <a href='isplogout.php'>Logout</a>
                  </div>
              </div>

              <div class='mainbody'>
                  <!-- <div><h1 class='title'>DHAKA ISP SOLUTION</h1></div> -->
                  <div><h4>Add Package Info</h4></div>
                
              

                  <div class='custom'>
                      <form action='#' method='POST'>
                        <div class='customform'>
                            
                          <label for ='speed'>Package Name</label>
                          <input type='text' name='name' id='speed' class='' placeholder='Enter package name' required>
                          <br>

                          <label for='pricing'>package Speed</label>
                          <input type='number' name='speed' id='pricing' class='' placeholder='Enter package speed here' min='1'  max='10000' step='1' required>
                          <br>
                          

                          <label for='a'>Subscription Fee </label>
                          <input type='number' name='price' id='a' class='' placeholder='Enter package subscripton fee.' required>
                          <br>

                          <label for='r'>Offer Price</label>
                          <input type='number' name='offer' id='r' class='' placeholder='Enter any offer Price' required>
                          <br>

                          <label for='a'>Monthly Fee</label>
                          <input type='number' name='monthly_fee' id='a' class='' placeholder='Enter Monthly Fee' required>
                          <br>

                          <button type='submit' class='ui violet button'>ADD</button>
                        </div>
                      </form>
                </div>
      </div>
        



    </body>
</html>