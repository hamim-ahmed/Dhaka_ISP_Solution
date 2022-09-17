<?php

     if(isset($_GET['flag'])){
        $flag = $_GET['flag'];
        if($flag=="fail"){
            echo "<script> alert('This Username is already taken'); </script>";
        }
        if($flag=="signup_success"){
            echo "<script> alert('Signup Successful.'); </script>";
        }
    
       
     }
?>





<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dhaka ISP Solution</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">    <!-- semantic-ui cdn -->   <!--bootstrep-->
        <link rel="stylesheet" href="../css/signup.css">
        <style>

        </style>
       
    </head>
    <body>
        <div class="topbar">
            <div class="topleft">
              <a class="" href="index.php">Home</a>
              <a class="active" href="usersignup.php">USER-SIGNUP</a>
              <a class="" href="userlogin.php">USER-LOGIN</a>
            </div>
            <div class="topright">
              <a href="ispsignup.php">ISP-SIGNUP</a>
              <a href="isplogin.php">ISP-LOGIN</a>
              <a href="mypanel.php"><i class="blue large user circle icon"></i></a>
            </div>
        </div>

        <div class="mainbody">
            <div><h1 class="title">DHAKA ISP SOLUTION</h1></div>
             
        </div>

        <div class="form1">
                
                <form action="usersignupcheck.php" method="post">
                    <div class="form">
                            <div><h4>User SignUp</h4></div>
                            <div class="signupform">
                                <div class="signupfield">
                                        <label for ="firstname">FirstName:</label>
                                        <br>
                                        <input type="text" name="fname" id="firstname" class="" placeholder="Enter your First Name" requred><br>
                                </div>
                                <div class="signupfield">
                                        <label for="lastname">LastName:</label>
                                        <br>
                                        <input type="text" name="lname" id="lastname" class="" placeholder="Enter your Last Name" required>
                                </div>
                            </div>

                            <div class="signupform">
                                <div class="signupfield">
                                        <label for ="username">UserName:</label>
                                        <br>
                                        <input type="text" name="userid" id="username" class="" placeholder="Set a unique UserName" requred><br>
                                </div>
                                <div class="signupfield">
                                        <label for="password">Password:</label>
                                        <br>
                                        <input minlength="4" type="password" name="password" id="password" class="" placeholder="Set your login password" required>
                                </div>
                            
                            </div>

                            <div class="signupform">
                                <div class="signupfield">
                                        <label for ="address">Address:</label>
                                        <br>
                                        <input type="text" name="address" id="address" class="" placeholder="Enter your Address" requred><br>
                                </div>
                                <div class="signupfield">
                                        <label for="phn">Mobile No:</label>
                                        <br>
                                        <input type='tel' placeholder="01xxxxxxxxx" pattern="[0-9]{11}" name="phn" id="phn" class="" placeholder="Enter your MObile NO" required>
                                </div>
                            
                            </div>
                            

                            <div>
                            <button type="submit" class="ui blue button">Submit</button>
                            </div>

                            
                    </div>
                </form>
            </div>



    </body>
</html>