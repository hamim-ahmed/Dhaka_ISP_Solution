<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dhaka ISP Solution</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">    <!-- semantic-ui cdn -->   <!--bootstrep-->
        <link rel="stylesheet" href="../css/style.css">
        <style>
        

        </style>
       
    </head>
    <body>
        <div class="topbar">
            <div class="topleft">
              <a class="" href="index.php">Home</a>
              <a href="usersignup.php">USER-SIGNUP</a>
              <a class="" href="userlogin.php">USER-LOGIN</a>
            </div>
            <div class="topright">
              <a href="ispsignup.php">ISP-SIGNUP</a>
              <a class="" href="isplogin.php">ISP-LOGIN</a>
              <a href="mypanel.php"><i class="blue large user circle icon"></i></a>
            </div>
        </div>

        <div class="mainbody">
            <div><h1 class="title">DHAKA ISP SOLUTION</h1></div>
            <div><h4>Search Your Desire ISP</h4></div>
           
        </div>

        <div class="custom">
             <form action="mainsearch.php" method="POST">
                    <div class="">
                      <table class="">
                        <thead>
                            <th>ISP Name</th>
                            <th>Coverage Areas</th>
                            <th>monthly_fee</th>
                            <th>Sub Fee</th>
                            <th>Bandwith</th>
                            <th>Rating</th>
                            <th>Visit Link</th>
                        </thead>
             
                             <?php 
                                  session_start();
                                  if( isset($_SESSION['bandwith'])){
                                    $packages = $_SESSION['bandwith'];
                                    $price = $_SESSION['price'];
                                    $area = $_SESSION['area'];
                                    $rating = $_SESSION['rating'];
                                  }
                                  else{
                                    session_unset();
                                    session_destroy();
                                    header('Location: index.php');
                                    
                                  }

                                  require_once("db_connection.php");
                                  // $userid = $_POST['userid'];

                                  $conn = new mysqli($servername, $username, $password, $dbname);
                                  if ($conn->connect_errno) {
                                    printf("Connect failed: %s\n", $conn->connect_error);
                                    exit();
                                  }

                                  $query = "SELECT i.isp_id,i.isp_name,i.area_coverage,i.rating,s.packages,s.package_cost,s.monthly_fee FROM isp_admin i JOIN isp_info s ON(i.isp_id = s.isp_id) WHERE i.`area_coverage` LIKE '%" . $area . "%' AND i.rating >= '$rating' AND s.packages = '$packages' And s.monthly_fee <= '$price'";
                                    if ($result = $conn->query($query)) {
                                    printf("%d ISP found!", $result->num_rows);
                                    /* fetch associative array */
                                    //printf("<br><b>hotel_id  \n\n\n hotel_name contact_no location</b><br>");
                                    
                                    if($result->num_rows>"0"){

                                    // while ($row = $result->fetch_assoc()) {
                                    //   printf("<tr>");
                                    //   printf(" <td> %s</td> <td>%s</td> <td> %s</td> <td> %s</td> <td> %s</td> <td> 
                                      
                                    //   <form action='../../users/all/packagesubscription.php' method='post'>

                                    //   <input  type='hidden' name='ispid' value='%s'> 
                                                                          
                                    //   <input class='ui inverted blue button' type='submit' value='Visit' name='Edit' >
                                    //   </form>
                                    //   </td><br>", $row["isp_name"], $row["area_coverage"],$row["package_cost"], $row["packages"], $row["rating"],$row["isp_id"]  );
                                    //   printf("</tr>");
                                    // }

                                    while ($row = $result->fetch_assoc()) {
                                      extract($row);
                                      printf("<tr>");
                                      printf(" <td> %s</td> <td>%s</td> <td> %s</td> <td> %s</td> <td> %s</td> <td>%s</td>
                                      <td>   
                                      <button class='ui white button'><a href='../../users/all/packagesubscription.php? ispid=%s'> Visit </a></button>

                                      </td>", 
                                      $isp_name, $area_coverage,$monthly_fee,$package_cost,$packages,$rating,$isp_id  );
                                      
                                      printf("</tr>");
                                    }

                                    //printf("</table>");

                                    $result->free(); //free result set
                                    }
                                    else{
                                      printf("<h3><b>Requirement not match!</b></h3>");
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
              <div class="search_btn">
                <form action="customsearch.php">
                   <button type="submit" class="ui green button"  name="Search1">
                    Search Again </button>
               </form>
              </div>
        </div>



    </body>
</html>