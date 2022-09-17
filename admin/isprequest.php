<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    $_SESSION['flag']="request";
    // echo "<script> alert('Please login first'); </script>";
    header('Location: login.php');
    exit();
  }
if(isset($_GET['flag'])){
    echo "<script> alert('Isp Added Successfully'); </script>";

}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dhaka ISP Solution</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">    <!-- semantic-ui cdn -->   <!--bootstrep-->
        <link rel="stylesheet" href="style.css">
        <style>
        

        </style>
       
    </head>
    <body>
        <div class="topbar">
            <div class="topleft">
              <a class="" href="admin.php">Home</a>
              <a class="active" href="isprequest.php">Isp-Request</a>
              <a class="" href="subrequest.php">Sub-Request</a>
            </div>
            <div class="topright">
              <!-- <a href="ispsignup.php">ISP-SIGNUP</a> -->
              
              <?php
            //   session_start();
              if(!isset($_SESSION['admin_id'])){
                printf("<a class='active' href='#'>login</a>");
              }
              else{
                printf("<a href='logout.php'>logout</a>");
              }
              
              ?>
              <a href="adminpanel.php"><i class="blue large user circle icon"></i></a>
            </div>
        </div>

        <div class="mainbody">
            <div><h1 class="title">DHAKA ISP SOLUTION</h1></div>
            <div><h4>Isp Requests</h4></div>
           
        </div>

        <div class="custom">
             <form action="" method="POST">
                    <div class="">
                      <table class="">
                        <thead>
                            <th>ISP Name</th>
                            <th>Office Address</th>
                            <th>Contact</th>
                            <th>View Details</th>
                        </thead>
             
                             <?php 
                                  // $packages = $_POST['bandwith'];
                                  // $price = $_POST['price'];
                                  // $area = $_POST['area'];
                                  // $rating = $_POST['rating'];
                                  // $srch = $_POST['search'];
                                  $srch = 'undefine'; 
                                  if( isset( $_POST['search'])) {
                                      $srch = $_POST['search']; 
                                  } 
                                //   echo $srch;
                                  
                                  // $srch= (isset($_POST['search']) ? $_POST['search'] : '');

                                  require_once("db_connection.php");
                                  // $userid = $_POST['userid'];

                                  $conn = new mysqli($servername, $username, $password, $dbname);
                                  if ($conn->connect_error) {
                                    printf("Connect failed: %s\n", $conn->connect_error);
                                    exit();
                                  }
                                  
                                  $query = "SELECT isp_id,isp_name,password,area_coverage,office_address,mobile FROM isp_requests";
                                  
                                    if ($result = $conn->query($query)) {
                                    printf("%d Request Pending!", $result->num_rows);
                                    /* fetch associative array */
                                    //printf("<br><b>hotel_id  \n\n\n hotel_name contact_no location</b><br>");
                                    
                                    if($result->num_rows>"0"){

                                    // while ($row = $result->fetch_assoc()) {
                                    //   printf("<tr>");
                                    //   printf(" <td> %s</td> <td>%s</td> <td> %s</td> 
                                    //   <td>   
                                    //   <form action='../../users/all/packagesubscription.php' method='POST'>

                                    //   <input  type='hidden' name='ispid' value='%s'> 
                                                                          
                                    //   <input class='ui inverted blue button' type='submit' value='Visit' name='Edit' >
                                    //   </form>
                                    //   </td>", 
                                    //   $row["isp_name"], $row["area_coverage"],$row["rating"],$row["isp_id"]  );

                                    //   printf("</tr>");
                                    // }

                                    while ($row = $result->fetch_assoc()) {
                                      extract($row);
                                      printf("<tr>");
                                      printf(" <td> %s</td> <td>%s</td> <td> %s</td> 
                                      <td>   
                                      <button class='ui white button'><a href='requestdetails.php? ispid=%s'> Details </a></button>

                                      </td>", 
                                      $isp_name, $office_address,$mobile,$isp_id  );
                                      
                                      printf("</tr>");
                                    }

                                    //printf("</table>");

                                    $result->free(); //free result set
                                    }
                                    else{
                                      printf("<h3><b>No Record Found!</b></h3>");
                                    }
                                    }
                                    else
                                    {
                                      printf("No record found!");
                                    }
                                    $conn->close();
                            ?> 
                       </table>      
                      
                
                    </div>
            </form>
            <!-- <div class="search_btn">
              <form action="index.php">
                  <button type="submit" class="ui green button"  name="Search1">
                  Search Again </button>
              </form>
            </div> -->
        </div>


    </body>
</html>