<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>User Panel</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">    <!-- semantic-ui cdn -->   <!--bootstrep-->
        <link rel="stylesheet" href="../css/userstyle.css">
        <style>
               table,th,td{
                border:3px solid blue;
                border-collapse: collapse;
                font-size: 20px;
                color:white;
				background-color:black;
				opacity:0.9;  /*to keep the text fixed ,use RGBa color */
				width:100%;
				height:100%
                
            }
            th,td{
                width: 300px;;
                padding:5px;
                text-align: center;
				
            }
			th{
				color:red;
				background-color:white;
				opacity:1.0;
			}
            tr{
                
                height: 50px;
            }
            textarea
            {
                background: transparent;
                border: solid rgb(255, 0, 0);
                box-shadow:yes;
                color: white;
            }
            
        </style>
    </head>
    <body>
        <div class="topbar">
            <div class="topleft">
              
            </div>
            <div class="topright">
              
            </div>
        </div>
        <div class="main">
            <div class="menubar">
                <div class="menuinfo">
                    <a class="active" href="../../home/all/index.php"><button class="ui inverted teal button">HOME</button></a>
                </div>

                <div class="menuinfo">
                    <a href="userreport.php"><button class="active ui inverted teal button">ISSUE REPROT</button></a>
                </div>

                <div class="menuinfo">
                    <a href="usersubscription.php"><button class="ui inverted teal button">SUBCRIPTIONS</button></a>
                </div>

                <div class="menuinfo">
                    <a href="userbilling.php"><button class="ui inverted teal button">BILLING</button></button></a>
                </div>

                <div class="menuinfo">
                    <a href="userinfo.php"><button class="ui inverted teal button">USER INFO</button></a>
                </div>

                <div class="menuinfo">
                    <a href="logout.php"><button class="ui inverted teal button">LOGOUT</button></a>
                </div>

            </div>
            <div class="body">
                <div class="welcome">
                    <?php
                        // starting the session
                        session_start();
                        if(isset($_SESSION['userid'])){
                                $id = $_SESSION['userid'];

                            // connection to the database
                            require_once("db_connection.php");
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_errno) {
                            printf("Connect failed: %s\n", $conn->connect_error);
                            exit();
                            }

                            // performing query selection from database.
                            $query = "SELECT First_Name,Last_Name FROM user where user_id='$id'";
                            if ($result = $conn->query($query)) {
                                        
                                if($result->num_rows>"0"){
                                    //print("%s",$row["First_Name"]);

                                    while ($row = $result->fetch_assoc()) {
                                        extract($row);
                                        print("<h1>WELCOME &nbsp <span> $First_Name $Last_Name </span></h1>");
                                    }
                

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
                            
                        }
                        else{
                            print("please login first");
                            $flag="login_fail";
                            header( "Location: ../../home/all/userlogin.php?flag=" .$flag );
                            exit();
                            exit();
                                
                        }
                    ?>
                </div>
                
                <div class="myinfo">
                    <h3>ISSUES & REPORT</h3>
                </div>

                <div class="info">
                    <table class="table">
                        <thead>
                            <th>ISP Name</th>
                            <th>Package Speed</th>
                            <th>Package fees</th>
                            <th>Subscription Status</th>
                            <th>My Issue</th>
                            <th>Report A New Issue</th>
                            <th> ISP Reply</th>
                            <!--<th>Rating</th>-->
                        </thead>
                            <?php
              
                                    $status = "Subscribed";
                                    printf($status);
                                    $query = "SELECT s.isp_name,s.sub_fee,s.package_speed,s.isp_id,s.package_name,s.complain,s.reply,i.user_id 
                                    FROM user i JOIN subscriber_list s ON(i.user_id = s.subscriber_id)  WHERE user_id = '$id'";
                                    if ($result = $conn->query($query)) {
                                      printf("You have %d Subcribed Packages!", $result->num_rows);
                                
                                      if($result->num_rows>"0"){
                                        printf($result->num_rows);
                                   
      
                                      /*while ($row = $result->fetch_assoc()) {
                                        printf("<tr>");
                                        printf(" <td> %s</td> <td>%s</td> <td> %s</td> <td> %s</td> <td> %s </td> 
                                        <td> 
                                        <form action='userreportissue.php' method='post'>

                                        <input  type='hidden' name='ispid' value='%s'> 
                                        <input  type='hidden' name='packagename' value='%s'>
                                        <input  type='hidden' name='userid' value='%s'>
                                                                            
                                        <input class='ui inverted blue button' type='submit' value='Send Report' name='Edit' >
                                        </form> </td> 
                                        <td> %s </td>"
                                        
                                        , $row["isp_name"], $row["package_speed"],$row["sub_fee"], $status,$row["complain"],$row["isp_id"],$row["package_name"],$row["user_id"], $row["reply"]  );
                                        printf("</tr>");
                                      }*/

                                      while ($row = $result->fetch_assoc()) {
                                        printf("<tr>");
                                        printf(" <td> %s</td> <td>%s</td> <td> %s</td> <td> %s</td> 

                                        <form action='userreportdatabase.php' method='post'>

                                        
                                        <td><textarea name='complain'  cols =20 wrap='virtual' placeholder='%s' ></textarea>
                                        </td> 
                                        <td> 
                                        
                                        <input  type='hidden' name='ispid' value='%s'> 
                                        <input  type='hidden' name='packagename' value='%s'>
                                        <input  type='hidden' name='userid' value='%s'>
                                                                            
                                        <input class='ui inverted blue button' type='submit' value='Send Report' name='Edit' >
                                        </form> 
                                        </td> 
                                        <td> %s </td>"
                                        
                                        , $row["isp_name"], $row["package_speed"],$row["sub_fee"], $status,$row["complain"],$row["isp_id"],$row["package_name"],$row["user_id"], $row["reply"]  );
                                        printf("</tr>");
                                      }
      
                                      //printf("</table>");
      
                                      $result->free(); //free result set
                                      }
                                      else{
                                        printf("<h3>No Subscription Yet!</h3>");
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

            </div>

        </div>
    </body>
</html>