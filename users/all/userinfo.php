<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta charset="utf-8 />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>User Panel</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">    <!-- semantic-ui cdn -->   <!--bootstrep-->
        <link rel="stylesheet" href="../css/userstyle.css">
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
                    <a class="menuinfo" href="../../home/all/index.php"><button class="ui inverted teal button">HOME</button></a>
                </div>

                <div class="menuinfo">
                    <a href="userreport.php"><button class="ui inverted teal button">ISSUE REPROT</button></a>
                </div>

                <div class="menuinfo">
                    <a href="usersubscription.php"><button class="ui inverted teal button">SUBCRIPTIONS</button></a>
                </div>

                <div class="menuinfo">
                    <a href="userbilling.php"><button class="ui inverted teal button">BILLING</button></button></a>
                </div>

                <div class="menuinfo">
                    <a href="userinfo.php"><button class="active ui inverted teal button">USER INFO</button></a>
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
                                // print($id);

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
                            print("<h1>please login first</h1></br> ");
                            print("<button class='login'><a href='../../home/all/userlogin.php'> Login </a></button>");
                            $flag="login_fail";
                            header( "Location: ../../home/all/userlogin.php?flag=" .$flag );
                            exit();
                                
                        }
                    ?>
                </div>
                
                <div class="myinfo">
                    <h3>MY INFO</h3>
                </div>

                <div class="info">
                    <?php

                            
                                // $id = $_GET['userid'];
                                // session_start();
                                // if(isset($_SESSION['userid'])){
                                //     $id = $_SESSION['userid'];
                                        // print($id);
                                        // $query = "SELECT First_Name,Last_Name,Email,Address,mobile FROM user WHERE user_id = $id";
                                        $query = "SELECT * FROM user WHERE user_id = '$id'";
                        

                                        if ($result = $conn->query($query)) {
                                            // print($result);
                                        
                                            if($result->num_rows>"0"){
                                                //print("%s",$row["First_Name"]);

                                                while ($row = $result->fetch_assoc()) {
                                                    extract($row);
                                                    // print("<form action='page.php' method='get'>
                                                    //             f0:<input type='text' name='CourseID' value='$First_Name'> 
                                                                                                        
                                                    //             <input type='submit' value='Edit' name='Edit' >
                                                    //         </form>"); 
                                                    print("<form id='' class='' action='updateinfo.php' method='get'>
                                                            <!-- <h3 class=' text-white pt-5'></h3> -->
                                
                                                                <label for='First_Name' class=''><b>First_Name:</b></label>
                                                                <br>
                                                                <input type='text' name='First_Name' id='First_Name' value='$First_Name' class='' required>
                                                                <br>

                                                                <label for='Last_Name' class=''><b>Last_Name:</b></label> 
                                                                </br>
                                                                <input type='text' name='Last_Name' id='Last_Name' value='$Last_Name' class='' required>
                                                                <br>

                                                                <label for='email' class=''><b>Email:</b></label> 
                                                                <br>
                                                                <input type='email' name='Email' id='email' value='$Email' placeholder = 'enter your Email' class=''>
                                                                <br>

                                                                <label for='address' class=''><b>Home Address:</b></label> 
                                                                <br>
                                                                <input type='text' name='Address' id='address' value='$Address' class='' required> 
                                                                <br>

                                                                <label for='mobile' class=''><b>Phone No:</b></label> 
                                                                <br>
                                                                <input type='tel' placeholder='01xxxxxxxxx' pattern='[0-9]{11}' name='mobile' id='mobile' value='$mobile' class='' required>
                                                                <br>

                                                                <input type='hidden' name='userid' id='Last_Name' value='$id' class=''>
                                                            
                                                            <div class='submit_btn'>
                                                                <input type='submit' name='Update' class='' value='Update Info'>
                                                            </div>
                                                        </form>");
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
                                        $conn->close();

                                // }
                                // else{
                                //     echo "Plese Login First";
                                // }

                    ?>

                </div>

            </div>

        </div>
    </body>
</html>