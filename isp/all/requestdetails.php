<?php
            session_start();
            if(isset($_SESSION['ispid'])){
               
                // $id = $_SESSION['admin_id'];
                if(isset($_POST['gateway_serial_id'])){
                    $serial_id = $_POST['gateway_serial_id'];
                    $ispid = $_POST['isp_id'];
                    $userid = $_POST['user_id'];
                    $package_name=$_POST['package_name'];
                    $monthly_fee = $_POST['monthly_fee'];
                    // echo $monthly_fee;
                    // printf($_POST['gateway_serial_id']);
                    // printf($serial_id);
                    // echo $monthly_fee;
                    
                }
                

                // printf($userid);
                // printf($id);
                require_once("db_connection.php");
                $conn = new mysqli($servername,$username,$password,$dbname);
                if($conn->connect_errno){
                    printf("database Connection failed:%s\n",$conn->connect_error);
                    exit();
                }
            }
            else{
                printf("Please Login first");
                header('Location: ../../home/all/isplogin.php');

                exit();

            }

            if(isset($_POST['id'])){
                $serial_id = $_POST["id"];
                $userid = $_POST["user_id"];
                $ispid = $_POST["isp_id"];
                printf($userid);
                $p_name = $_POST["package_name"];
                $p_speed = $_POST["p_speed"];
                $mobile= $_POST["phn"];
                $address = $_POST["address"];
                $ispname = $_POST["isp_name"];
                $username = $_POST["username"];
                $sub_fee = $_POST["sub_fee"];
                $monthly_fee = $_POST['monthly_fee'];
                // $mobile = $_POST["phn"];
                echo $p_name;
                printf($monthly_fee);
                // exit();
                // $address = $_POST["Address"];
                // $mobile = $_POST["phn"];
                // printf("ok");

                $sql = "INSERT INTO subscriber_list(isp_id, isp_name,sub_fee,package_name, package_speed,  monthly_fee, subscriber_id, subscriber_name,subscriber_address,subscriber_phone)
                                    VALUES ('$ispid', '$ispname', '$sub_fee', '$p_name', '$p_speed', '$monthly_fee', '$userid', '$username', '$address','$mobile'    )";
                $sql1 = "INSERT INTO billing(isp_id, isp_name, package_name, package_speed,  monthly_fee, subscriber_id, subscriber_name)
                                    VALUES ('$ispid', '$ispname',  '$p_name', '$p_speed', '$monthly_fee', '$userid', '$username'  )";
                if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE ) {

                    $sql = "UPDATE gateway
                    SET pay_status = 'subscribed'
                    WHERE serial_id=$serial_id";
                    if ($conn->query($sql) === TRUE) {
                        $sql = "UPDATE user_info
                        SET sub_status = 'subscribed'
                        WHERE user_id='$userid' and connected_ispid='$ispid' and package_name='$p_name' and sub_status='varified'";
                        if ($conn->query($sql) === TRUE) {
                            $flag=" varified success";
                            echo "<script> alert('Successfully varified'); </script>";
                            unset($_POST['id']);
                            unset($_POST['gateway_serial_id']);
                            header( "Location: subrequest.php?flag=".$flag  );
                        }
                    } else {
                        // echo "<script> alert('Successfully added'); </script>";
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }


                echo "$ Successfull";
                // header('Location: usersubscription.php');
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
                    // $sql = "UPDATE gateway
                    // SET pay_status = 'subscribed'
                    // WHERE serial_id=$id";
                    // if ($conn->query($sql) === TRUE) {
                    //     $sql = "UPDATE user_info
                    //     SET sub_status = 'subscribed'
                    //     WHERE user_id='$userid' and connected_ispid='$ispid' and package_name='$p_name' and sub_status='varified'";
                    //     if ($conn->query($sql) === TRUE) {
                    //         $flag=" varified success";
                    //         echo "<script> alert('Successfully varified'); </script>";
                    //         unset($_POST['serial_id']);
                    //         unset($_GET['gateway_serial_id']);
                    //         header( "Location: subrequest.php?flag=".$flag  );
                    //     }
                    // } else {
                    //     // echo "<script> alert('Successfully added'); </script>";
                    //     echo "Error: " . $sql . "<br>" . $conn->error;
                    // }

                    // $sql = "UPDATE gateway, user_info
                    // SET gateway.pay_status = 'varified', user_info = 'varified'
                    // WHERE gateway.serial_id=$id and
                    // user_info.user_id='$userid' and user_info.connected_ispid='$ispid' and user_info.package_name='$p_name' and user_info.sub_status='pending'";
                    // if ($conn->query($sql) === TRUE) {
                    //     // $sql = "UPDATE user_info
                    //     // SET sub_status = 'varified'
                    //     // WHERE user_id='$user_id' and connected_ispid='$isp_id' and package_name='$package_name' and sub_status='pending'";
                    //     // if ($conn->query($sql) === TRUE) {
                    //         $flag=" varified success";
                    //         echo "<script> alert('Successfully varified'); </script>";
                    //         unset($_POST['serial_id']);
                    //         unset($_GET['gateway_serial_id']);
                    //         header( "Location: subrequest.php?flag=".$flag  );
                    //     // }
                    // } else {
                    //     // echo "<script> alert('Successfully added'); </script>";
                    //     echo "Error: " . $sql . "<br>" . $conn->error;
                    // }
                // } else {
                // echo "Error: " . $sql . "<br>" . $conn->error;
                // }




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
        <link rel='stylesheet' type='text/css' href='../css/style1.css'>
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

                <div class='topbar'>
                        <div class='topleft'>
                            <a class='' href='ispadmin.php'>My Panel</a>
                            <a class='' href='adminreport.php'>Users & Complain</a>
                            <a class='active' href='subrequest.php'>Sub Request</a>
                            <!-- <a class=' href='userlogin.php'>USER-LOGIN</a> -->
                        </div>
                        <div class='topright'>
                            <!-- <a href='ispsignup.php'>ISP-SIGNUP</a> -->
                            <a class='' href='ispinfo.php'>My Info</a>
                            <a href='isplogout.php'>LogOut</a>
                        </div>
                    </div>

                    <div class='mainbody'>

                        <h1> Customer Request Details </h1>

                        <div class='bg-color'>
                            <?php
                                $query = "SELECT First_Name,Last_Name,Address,mobile FROM user where user_id='$userid'";
                                if ($result = $conn->query($query)) {
                                            
                                    if($result->num_rows>"0"){
                                        //print("%s",$row["First_Name"]);
                
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                
                                            // print("<h1>WELCOME &nbsp <span> $First_Name $Last_Name </span></h1>");
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
                                // printf($id);
                                // $query = "SELECT * FROM isp_admin where isp_id=$id";
                                $query = "SELECT * from user_info where user_id = '$userid' and connected_ispid='$ispid' and package_name='$package_name' ";
                                $result = $conn->query($query);
                                // printf($query);
                                if ($result = $conn->query($query)) {
                                            
                                    if($result->num_rows>"0"){
                                
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            // $paid = $offers;
                                            // if($paid == 0){
                                            //     $paid = $sub_fee;
                                            // }
                                            // print("<form action='page.php' method='get'>
                                            //             f0:<input type='text' name='CourseID' value='$First_Name'> 
                                                                                                
                                            //             <input type='submit' value='Edit' name='Edit' >
                                            //         </form>"); 
                                            print("<form id='' class='' action='#' method='POST' autocomplete='off' enctype='multipart/form-data'>
                                                    <!-- <h3 class=' text-white pt-5'></h3> -->

                                                        <label for='area' class=''><b>Customer Name:</b></label> 
                                                        </br>
                                                        <input type='text' readonly='readonly' name='username' id='area' value='$First_Name $Last_Name' class='' required>
                                                        <br>

                                                        <label for='address' class=''><b>Home Address:</b></label> 
                                                        <br>
                                                        <input type='text' readonly='readonly' name='address' id='address' value='$Address' class='' required> 
                                                        <br>

                                                        <label for='mobile' class=''><b>Package Name:</b></label> 
                                                        <br>
                                                        <input type='text' readonly='readonly' name='package_name' id='mobile' value='$package_name' class='' required>
                                                        <br>

                                                        <label for='mobile' class=''><b>Subscription fee:</b></label> 
                                                        <br>
                                                        <input type='text' readonly='readonly' name='sub_fee' id='mobile' value='$sub_fee' class='' required>
                                                        <br>

                                                        <label for='mobile' class=''><b>Contact No:</b></label> 
                                                        <br>
                                                        <input type='text' readonly='readonly' name='phn' id='mobile' value='$mobile' class='' required>
                                                        <br>
                                                    

                                                        <input type='hidden' name='id' id='' value='$serial_id' class=''>
                                                        <input type='hidden' name='user_id' id='' value='$user_id' class=''>
                                                        <input type='hidden' name='isp_id' id='' value='$connected_ispid' class=''>
                                                        <input type='hidden' name='package_name' id='' value='$package_name' class=''>
                                                        <input type='hidden' name='isp_name' id='' value='$isp_name' class=''>
                                                        <input type='hidden' name='p_speed' id='' value='$package_speed' class=''>
                                                        <input type='hidden' name='monthly_fee' id='' value='$monthly_fee' class=''>
                                                    
                                                    <div class='submit_btn'>
                                                        <input type='submit' name='approve' class='' value='Confirm Sub'>
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