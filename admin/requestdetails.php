<?php
            session_start();
            if(isset($_SESSION['admin_id'])){
                // $id = $_SESSION['admin_id'];
                $id = $_GET['ispid'];
                // printf($id);
                require_once("db_connection.php");
                $conn = new mysqli($servername,$username,$password,$dbname);
                if($conn->connect_errno){
                    printf("database Connection failed:%s\n",$conn->connect_error);
                    exit();
                }
            }
            else{
                session_start();
                $_SESSION['flag']="request";
                header('Location: login.php');

            }

            if(isset($_POST['username'])){
                $id = $_POST["username"];
                $pass = $_POST["password"];
                $isp_name = $_POST["name"];
                $area = $_POST["coverage"];
                $address = $_POST["Address"];
                $mobile = $_POST["phn"];
                // printf("ok");
                
                $sql = "DELETE FROM isp_requests WHERE isp_id = '$id' AND password='$pass'";

                if ($conn->query($sql) === TRUE) {
                    // header('Location: usersubscription.php');
                    // echo "<script> alart('isp deleted successfully');</script>";
                    // echo "<script> alert('Please login first'); </script>";
                    // echo "successful";
                    $sql = "INSERT INTO isp_admin (isp_id, isp_name, area_coverage,password,office_address,mobile)
                                VALUES ('$id', '$isp_name', '$area','$pass', '$address', '$mobile')";
                    if ($conn->query($sql) === TRUE) {
                        $flag="success";
                            echo "<script> alert('Successfully added'); </script>";
                            header( "Location: isprequest.php?flag=".$flag  );
                    } else {
                        // echo "<script> alert('Successfully added'); </script>";
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }




                // require_once('db_connection.php');
                // $sql = "INSERT INTO isp_requests (isp_id, isp_name, password, area_coverage,office_address,mobile)
                //                 VALUES ('$id', '$isp_name', '$pass', '$area', '$address', '$mobile')";
                        
                // if ($conn->query($sql) === TRUE) {
                //     echo "<script> alert('ISP signup Request Submitted'); </script>";
                // } else {
                //     echo "<script> alert('ISP signup Request failed!'); </script>";
                // }
                
                $conn->close();
                // header('Location: userlogin.php');

      }

            
            
            // while ($row = $result->fetch_assoc()) {
            //     extract($row);
            //     // printf($image);
            // }
            
            
?>




<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <title>Dhaka ISP Solution</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css'>    <!-- semantic-ui cdn -->   <!--bootstrep-->
        <link rel='stylesheet' type='text/css' href='style1.css'>
        <style>
            /* div.new_package{
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-content: center;
                    padding: 20px;
                    padding-top:0px;
                } */
                div.outer {
/*                   
                    background-image: url('../images/main.png');
                    background-repeat: no-repeat;
                    background-size: 100% 100%; */
                    /* background-color:rgba(58, 156, 160, 0.55); */
                
                }
                div.bg-color{
                    background-color:rgba(58, 156, 160, 0.55);
                    background-size: 100% 100%;

                }

        </style>
    </head>
    <body>
        
        <?php
        // print($image);
            // session_start();
            // if(isset($_SESSION['ispid'])){
            //     $id = $_SESSION['ispid'];
            //     require_once("db_connection.php");
            //     $conn = new mysqli($servername,$username,$password,$dbname);
            //     if($conn->connect_errno){
            //         printf("database Connection failed:%s\n",$conn->connect_error);
            //         exit();
            //     }
            // }
            // else{
            //     printf("Please Login first");
            //     exit();
            // }
        ?>    
                <div class='outer'>

                    <div class="topbar">
                        <div class="topleft">
                        <a class="" href="admin.php">Home</a>
                        <a class="active" href="isprequest.php">Isp-Request</a>
                        <!-- <a class="active" href="userlogin.php">USER-LOGIN</a> -->
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

                    <div class='mainbody'>

                        <h1> Isp Request Details </h1>

                        <div class='bg-color'>
                            <?php
                                // printf($id);
                                // $query = "SELECT * FROM isp_admin where isp_id=$id";
                                $query = "SELECT isp_name,password,area_coverage,office_address,mobile from isp_requests where isp_id = '$id' ";
                                $result = $conn->query($query);
                                // printf($query);
                                if ($result = $conn->query($query)) {
                                            
                                    if($result->num_rows>"0"){
                                        //print("%s",$row["First_Name"]);

                                        // while ($row = $result->fetch_assoc()) {
                                        //     extract($row);
                                        //     print("<h1> $isp_name </h1>");
                                        // }
                                        // $result = $conn->query($query);
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            // print("<form action='page.php' method='get'>
                                            //             f0:<input type='text' name='CourseID' value='$First_Name'> 
                                                                                                
                                            //             <input type='submit' value='Edit' name='Edit' >
                                            //         </form>"); 
                                            print("<form id='' class='' action='#' method='POST' autocomplete='off' enctype='multipart/form-data'>
                                                    <!-- <h3 class=' text-white pt-5'></h3> -->
                        
                                                        <label for='isp Name' class=''><b>ISP Name:</b></label>
                                                        <br>
                                                        <input readonly='readonly' type='text' name='name' id='isp Name' value='$isp_name' class='' required>
                                                        <br>

                                                        <label for='area' class=''><b>Coverage Area:</b></label> 
                                                        </br>
                                                        <input readonly='readonly' type='text' name='coverage' id='area' value='$area_coverage' class='' required>
                                                        <br>
                                                        <textarea name='' id='area' rows='3' cols='20' wrap='virtual' placeholder='$area_coverage' value='$area_coverage' ></textarea>
                                                        <br>


                                                        <label for='address' class=''><b>Address:</b></label> 
                                                        <br>
                                                        <input readonly='readonly' type='text' name='Address' id='address' value='$office_address' class='' required> 
                                                        <br>

                                                        <label for='mobile' class=''><b>Contact No:</b></label> 
                                                        <br>
                                                        <input readonly='readonly' type='text' name='phn' id='mobile' value='$mobile' class='' required>
                                                        <br>
                                                    

                                                        <input type='hidden' name='username' id='' value='$id' class=''>
                                                        <input type='hidden' name='password' id='' value='$password' class=''>
                                                    
                                                    <div class='submit_btn'>
                                                        <input type='submit' name='approve' class='' value='Approve Request'>
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
                            ?>
                            
                        </div>

                    </div>
                  
                </div>

                <!-- <div class='footer'>

                </div> -->


                



    </body>
</html>