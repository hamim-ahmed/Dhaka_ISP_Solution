<?php

session_start();
if(isset($_SESSION['pass']) || isset($_SESSION['id'])){
  // $flag = $_SESSION['pass'];
  // echo $flag;
  echo "<script> alert('incorrect id or password'); </script>";
}
if(isset($_SESSION['flag'])){
  echo "<script> alert('Please login first'); </script>";
}

session_unset();
session_destroy();



?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta  charset="utf-8">
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
              <a href="isprequest.php">Isp-Request</a>
              <!-- <a class="active" href="userlogin.php">USER-LOGIN</a> -->
            </div>
            <div class="topright">
              <!-- <a href="ispsignup.php">ISP-SIGNUP</a> -->
              
              <?php
              session_start();
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
            <!-- <div><h4>User Login</h4></div> -->

           
        </div>

        <div class="form1">

                <form action="passwordcheck.php" method="POST">
                  <div class="form">
                    <div><h4>Admin Login</h4></div>
                    <label for ="username">UserName:</label>
                    <br>
                    <input type="text" name="adminid" id="username" class="" placeholder="Enter your login id" requred><br>
                    <label for="password">Password:</label>
                    <br>
                    <input type="text" name="password" id="password" class="" placeholder="Enter your login password" required>
                    <br>
                    <button type="submit" class="ui blue button">Submit</button>
                    <h5 style="color:red;"> Forget Password?<a href='usersignup.php'>&nbsp&nbsp Forget</a></h5>
                    
                  </div>
                </form>
         </div>
         <?php
            session_start();
            if(isset($_SESSION['pass']) || isset($_SESSION['id'])){
              // $flag = $_SESSION['pass'];
              // echo $flag;
              echo "<script> alert('incorrect id or password'); </script>";
            }
            
            session_unset();
            session_destroy();
        ?>



    </body>
</html>