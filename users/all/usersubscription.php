<?php
if(isset($_GET['flag'])){
    if($_GET['flag']=='review'){
        echo "<script> alert('Review_Rating Submitted'); </script>";
    }
    else{
        echo "<script> alert('Request successfully Submitted'); </script>";
    }
    
    $_GET['flag'] = array();
    unset($_GET['flag']);
    $_GET['flag'] = array();
    
}
// if(isset($_POST['submit']))

if(isset($_POST['submit'])){

    // $userid = $_SESSION['userid'];

// $p_name = $_GET['p_name'];
// $p_speed = $_GET['p_speed'];
// $p_price = $_GET['p_cost'];
$userid = $_POST['userid'];
$ispid = $_POST['ispid'];
$ispname = $_POST['ispname'];
// $review = $_POST['review'];
// $user_rating = $_POST['rating'];
// echo $userid;
// echo $p_name;
// echo $p_speed;
// echo $p_price;
// echo $p_offer;
echo $ispid,$userid,$ispname;

    printf("
    <div class='overlay'>
                               
    <div class='popup'>
        <h3>Review and Rating</h3>
       
            <form class='form' action='ratingreview.php' method='POST'> 

                <label id='rating'> Give your rating</label><br>
                <select name='rating' id='rating' required>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                    <option value='may'></option>
                    
                </select><br><br>
                <label id='review'> Give an honest Review</label><br>
                <textarea class='txtarea'  name ='review' placeholder='Write your Review' row=3 col=20 required >
                </textarea><br>
                <input  type='hidden' name='userid' value=$userid>
                <input  type='hidden' name='ispid' value=$ispid>
                <input  type='hidden' name='ispname' value=$ispname>

                
                
                <input class='ui small blue button' type='submit' name='review_submit' value='submit'>
                
            </form>
        
    </div>
</div>
    
    
    ");
    
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
                    <a href="usersubscription.php"><button class="active ui inverted teal button">SUBCRIPTIONS</button></a>
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
                    <h3>MY SUBSCRIPTIONS</h3>
                </div>

                <div class="info">
                    <table class="">
                        <thead>
                            <th>ISP Name</th>
                            <th>Package Speed</th>
                            <th>Package fees</th>
                            <th>Subscription Status</th>
                            <th>Rating</th>
                            <th>Unsubscribe</th>
                            <th>Visit</th>
                            <!--<th>Rating</th>-->
                        </thead>
                            <?php
                                    // $status = "Subscribed";
                                    $query = "SELECT * FROM user_info WHERE user_id = '$id'";
                                    if ($result = $conn->query($query)) {
                                        printf("You have %d Subcribed Packages!", $result->num_rows);
    
                                        if($result->num_rows>"0"){
                    
        
                                            while ($row = $result->fetch_assoc()) {
                                                extract($row);
                                                printf("<tr>");
                                                printf(" <td> %s</td> <td>%s</td> <td> %s</td> <td> %s</td>
                                                         
                                                         
                                                         <td>
                                                         
                                                          <form action='../../users/all/usersubscription.php' method='post'>

                                                            <input  type='hidden' name='ispid' value=$connected_ispid>
                                                            <input  type='hidden' name='ispname' value='$isp_name'>
                                                            <input  type='hidden' name='userid' value=$user_id>
                                                            <input class='ui inverted yellow small button' type='submit' name='submit' value='Rate Us'>

                                                                                                
                                                            
                                                          </form>
                                                         </td>
                                                         
                                                       
                                             
                                                         
                                                            
                                                            
                                                         
                                                         
                                                         
                                                         <td><button class='ui red button'><a href='unsubscription.php? p_name=$package_name & ispid= $connected_ispid'>Unsubscribe</a></button></td>
                                                         <td>
                                                         <form action='../../users/all/packagesubscription.php' method='post'>

                                                        <input  type='hidden' name='ispid' value=$connected_ispid> 
                                                                                            
                                                        <input class='ui inverted blue button' type='submit' value='Visit' name='Edit' >
                                                        </form>
                                                         </td>",
                                                
                                                         $isp_name, $package_speed,$sub_fee, $sub_status   );
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