<?php
          
          if(isset($_POST['username'])){
                    $id = $_POST["username"];
                    $pass = $_POST["password"];
                    $isp_name = $_POST["name"];
                    $area = $_POST["area"];
                    $address = $_POST["address"];
                    $mobile = $_POST["phn"];
                    // printf($id);

                    require_once('db_connection.php');
                
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_errno) {
                    printf("Connect failed: %s\n", $conn->connect_error);
                    exit();
                    }
                    // printf("Connected successfully");
                    $query = "(SELECT isp_id,Password FROM isp_requests where isp_id='$id') UNION
                    (SELECT isp_id,Password FROM isp_admin where isp_id='$id')";
                    if ($result = $conn->query($query)) {
                        
            
                        // printf("<br>%d record(s) found!<br>", $result->num_rows);
                        if(($result->num_rows)>0){
                            echo "<script> alert('This Username is already taken'); </script>";
                            $result->free(); //free result set
                        }
                
                        else
                        {
                            $sql = "INSERT INTO isp_requests (isp_id, isp_name, password, area_coverage,office_address,mobile)
                                    VALUES ('$id', '$isp_name', '$pass', '$area', '$address', '$mobile')";
                            
                            if ($conn->query($sql) === TRUE) {
                                echo "<script> alert('ISP signup Request Submitted'); </script>";
                            } else {
                                echo "<script> alert('ISP signup Request failed!'); </script>";
                            }
                        }
                    }
                    $conn->close();
                    // header('Location: userlogin.php');
  
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
              <a class="" href="usersignup.php">USER-SIGNUP</a>
              <a class="" href="userlogin.php">USER-LOGIN</a>
            </div>
            <div class="topright">
              <a class="active" href="ispsignup.php">ISP-SIGNUP</a>
              <a href="isplogin.php">ISP-LOGIN</a>
              <a href="mypanel.php"><i class="blue large user circle icon"></i></a>
            </div>
        </div>

        <div class="mainbody">
            <div><h1 class="title">DHAKA ISP SOLUTION</h1></div>
             
        </div>

        <div class="form1">
                
                <form action="#" method="POST">
                    <div class="form">
                            <div><h4>ISP SignUp</h4></div>
                            <div class="signupform">
                                <div class="signupfield">
                                        <label for ="firstname">ISP Name:</label>
                                        <br>
                                        <input type="text" name="name" id="firstname" class="" placeholder="Enter your ISP Name" requred><br>
                                </div>
                                <div class="signupfield">
                                        <label for="coverage">Coverage Area:</label>
                                        <br>
                                        <input type="text" name="area" id="coverage" class="" placeholder="Enter all the Coverage Area" required>
                                </div>
                            </div>

                            <div class="signupform">
                                <div class="signupfield">
                                        <label for ="username">UserName:</label>
                                        <br>
                                        <input type="text" name="username" id="username" class="" placeholder="Set a unique UserName" requred><br>
                                </div>
                                <div class="signupfield">
                                        <label for="password">Password:</label>
                                        <br>
                                        <input minlength="4" type="password" name="password" id="password" class="" placeholder="Set your login password" required title="min password length is 4">
                                </div>
                            
                            </div>

                            <div class="signupform">
                                <div class="signupfield">
                                        <label for ="address">Address:</label>
                                        <br>
                                        <input type="text" name="address" id="address" class="" placeholder="Enter your Office Address" requred><br>
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