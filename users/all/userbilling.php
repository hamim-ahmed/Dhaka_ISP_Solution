<?php
if(isset($_GET['flag'])){
    echo "<script> alert('Payment Successfull.'); </script>";
    $_GET['flag'] = array();
    unset($_GET['flag']);
    $_GET['flag'] = array();
    
}

?>

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

        </style>
    </head>
    <body>
    <!-- <div><h1 class="ui blue message"> "hamim ahmed" </h1></div> -->
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
                    <a href="userreport.php"><button class="ui inverted teal button">ISSUE REPROT</button></a>
                </div>

                <div class="menuinfo">
                    <a href="usersubscription.php"><button class="ui inverted teal button">SUBCRIPTIONS</button></a>
                </div>

                <div class="menuinfo">
                    <a class="" href="userbilling.php"><button class="active ui inverted teal button">BILLING</button></button></a>
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
                                    printf("<h3><b>Requirement not match!</h3>");
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
                                
                        }
                    ?>
                </div>
                
                <div class="myinfo">
                    <h3>User Billing</h3>
                </div>

                <div class="info">
                    <table class="">
                        <thead>
                            <th>ISP Name</th>
                            <th>Package Name</th>
                            <th>Package Speed</th>
                            <th>Monthly Fee</th>
                            <!-- <th>Rating</th> -->
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>May</th>
                            <th>jun</th>
                            <th>Jul</th>
                            <th>Aug</th>
                            <th>Sep</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dec</th>
                            <th></th>

                            <!-- <th>Unsubscribe</th>
                            <th>Visit</th> -->
                            <!--<th>Rating</th>-->
                        </thead>
                            <?php
                                    $status = "Subscribed";
                                    $query = "SELECT * FROM billing WHERE subscriber_id = '$id'";
                                    if ($result = $conn->query($query)) {
                                        printf("You have %d Subcribed Packages!", $result->num_rows);
    
                                        if($result->num_rows>"0"){
                    
        
                                            while ($row = $result->fetch_assoc()) {
                                                extract($row);
                                                printf("<tr>");
                                                printf(" <td> %s</td> <td>%s</td> <td> %s</td> <td> %s</td>
                                                         <td class='payment'> %s</td> <td class='payment'>%s</td> <td class='payment'> %s</td> <td class='payment'> %s</td>
                                                         <td class='payment'> %s</td> <td class='payment'>%s</td> <td class='payment'> %s</td> <td class='payment'> %s</td>
                                                         <td class='payment'> %s</td> <td class='payment'>%s</td> <td class='payment'> %s</td> <td class='payment'> %s</td>
                                                      
                                                         <td>
                                                         <form action='../../users/all/monthlybillpay.php' method='post'>

                                                        <input  type='hidden' name='isp_id' value=$isp_id>
                                                        <input  type='hidden' name='isp_name' value=$isp_name>
                                                        <input  type='hidden' name='p_name' value=$package_name>
                                                        <input  type='hidden' name='p_speed' value=$package_speed>
                                                        <input  type='hidden' name='monthly_fee' value=$monthly_fee>
                                                        <input  type='hidden' name='user_name' value='$subscriber_name'>

                                                                                            
                                                        <input class='ui inverted blue button' type='submit' value='Pay' name='Edit' >
                                                        </form>
                                                         </td>",
                                                
                                                         $isp_name, $package_name,$package_speed, $monthly_fee,$jan,$feb,$mar,$apr,$may,$jun,$jul,
                                                        $aug,$sep,$oct,$nov,$dcm   );
                                                printf("</tr>");
                                            }
            
                                            
            
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