<?php
   
     // starting the session
     session_start();
     if(isset($_SESSION['userid'])){
        require_once("db_connection.php");
             $conn = new mysqli($servername, $username, $password, $dbname);
             if ($conn->connect_errno) {
             printf("Connect failed: %s\n", $conn->connect_error);
             exit();
             }
        
        if(isset($_POST['isp_id'])){
            // printf("good");

            // printf("first post");
             $userid = $_SESSION['userid'];
             $user_name = $_POST['user_name'];
             $p_name = $_POST['p_name'];
             $ispid = $_POST['isp_id'];
             $isp_name = $_POST['isp_name'];
             $monthly_fee = $_POST['monthly_fee'];
             $p_speed = $_POST['p_speed'];
            //  echo $user_name,$monthly_fee;
            //  echo $user_name,$userid,$p_name,$monthly_fee,$p_speed,$isp_name;
            //  $ispid = $_GET['ispid'];
            //  $ispname = $_GET['ispname'];
            //  $monthly_fee = $_GET['monthly_fee'];

        
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
            }
        if(isset($_POST['submit'])){
            // if(isset($_POST['isp_id'])){
                // printf("ok");
                $userid = $_SESSION['userid'];
                $user_name = $_POST['user_name'];
                $p_name = $_POST['p_name'];
                $ispid = $_POST['isp_id_submit'];
                $isp_name = $_POST['isp_name'];
                $monthly_fee = $_POST['monthly_fee'];
                $p_speed = $_POST['p_speed'];

                $method = $_POST['pay_method'];
                $month = $_POST['month'];
                $pay_number =$_POST['mobile'];
                $trans_id = $_POST['tnxid'];
                $paid_amount = $_POST['paid_amount'];
                // echo $monthly_fee,$month,$ispid;
                // $flag = 0;
                $query = "SELECT * FROM billing where isp_id='$ispid' and subscriber_id='$userid' and $month='Paid'";
                if ($result = $conn->query($query)){
                    if(($result->num_rows)>0){     //if already paid.
                        echo "<script> alert('This Month is Alrady Paid!'); </script>";
                    }
                    else{
                        $sql = "UPDATE billing
                        SET $month = 'Paid'
                        WHERE subscriber_id='$userid' and isp_id='$ispid' and package_name='$p_name' and $month=''";
                        if ($conn->query($sql) === TRUE) {
                            $flag=" varified success";
                            echo "<script> alert('Successfully varified'); </script>";
                            unset($_POST['serial_id']);
                            unset($_GET['gateway_serial_id']);
                            header( "Location: userbilling.php?flag=".$flag  );
                        }
                        else {
                        echo "<script> alert('Payment Failed!'); </script>";
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }


                    $result->free(); //free result set
                }

                // $sql = "UPDATE billing
                //         SET $month = 'Paid'
                //         WHERE subscriber_id='$userid' and isp_id='$ispid' and package_name='$p_name' and $month=''";
                // if ($conn->query($sql) === TRUE) {
                //     $flag=" varified success";
                //     echo "<script> alert('Successfully varified'); </script>";
                //     unset($_POST['serial_id']);
                //     unset($_GET['gateway_serial_id']);
                //     header( "Location: userbilling.php?flag=".$flag  );
                // }
                //  else {
                // echo "<script> alert('Payment Failed!'); </script>";
                // echo "Error: " . $sql . "<br>" . $conn->error;
                // }

                // $trans_flag = 0;
                // $query = "SELECT pay_number,tnx_id,pay_method FROM gateway";
                // if ($result = $conn->query($query)) {
                            
                //     if($result->num_rows>"0"){
                //         //print("%s",$row["First_Name"]);

                //         while ($row = $result->fetch_assoc()) {
                //             extract($row);
                //                 if($pay_number==$mobile and $tnx_id==$trans_id and $pay_method==$method){
                //                 echo "<script> alert('invalid payment!'); </script>";
                //                 unset($_POST['user_id']);
                //                 unset($_POST['isp_id']);
                //                 $trans_flag = 1;
                //                 // header("Location: subbillpay.php?ispid=". $ispid);
                //                 // exit();
                                
                //                }

                //             // print("<h1>WELCOME &nbsp <span> $First_Name $Last_Name </span></h1>");
                //         }
                //         $result->free(); //free result set
                //     }
                //      if($trans_flag==0)
                //         {
                //             $sql = "INSERT INTO gateway (user_id, user_name, connected_ispid, isp_name, package_name, sub_fee,offers,monthly_fee,package_speed,pay_number,tnx_id,pay_method,pay_status)
                //                     VALUES ('$userid', '$username', '$ispid', '$ispname', '$p_name', '$p_cost', '$p_offer', '$monthly_fee', '$p_speed', '$mobile', '$trans_id', '$method', 'pending')";
                //             // $sql = "INSERT INTO gateway (user_id, user_name, connected_ispid, isp_name, package_name, sub_fee, offers,monthly_fee, package_speed,pay_number,tnx_id,pay_method,pay_status)
                //             // VALUES ('$userid', '$username', '$ispid')";
                //             if ($conn->query($sql) === TRUE) {
                //                 echo "<script> alert('Subscription Request Submitted'); </script>";
                //                 $sql = "INSERT INTO user_info (user_id, connected_ispid, isp_name, package_name,sub_fee,package_speed,sub_status)
                //                                     VALUES ('$userid', '$ispid', '$ispname', '$p_name', '$p_price', '$p_speed','pending')";
                //                 if ($conn->query($sql) === TRUE) {
                //                     $flag="success";
                //                     header("Location: usersubscription.php?flag=". $flag);
                //                     exit();
                //                 } else {
                //                     echo "Error: " . $sql . "<br>" . $conn->error;
                //                 }

                //             } else {
                //                 echo "<script> alert('Payment failed!'); </script>";
                //             }
                //         }
                // }


                   
            //         $conn->close();
            //         // header('Location: userlogin.php');
                
            // }

       
            // } 
               
        }

        // else{
        //     // print("<h1>please login first<h1>");
        //     header('Location: ../../users/all/userinfo.php');
        //     exit();
                
        }
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
<link rel="stylesheet" href="../css/bill.css">


</head>
<body>

<div class="container">

    <form action="#" method="POST">

        <div class="row">

            <div class="col">

                <h3 class="title">billing address</h3>

                <div class="inputBox">
                    <span>Customer Name:</span>
                    <input type="text" name="user_name" value="<?php echo $user_name; ?>"  readonly="readonly">
                </div>
                <div class="inputBox">
                    <span>ISP Name:</span>
                    <input type="text" name="isp_name" value="<?php echo $isp_name; ?>" required placeholder="Name" readonly="readonly">
                </div>
                <div class="inputBox">
                    <span>Package Name:</span>
                    <input type="email" name="p_name" value="<?php echo $p_name; ?>" required placeholder="Duronto" readonly="readonly">
                </div>
                <div class="inputBox">
                    <span>Package Speed:</span>
                    <input type="text" name="p_speed" value="<?php echo $p_speed; ?>" required placeholder="10 MBPS" readonly="readonly">
                </div>
                <div class="inputBox">
                    <span>Monthly Fee:</span>
                    <input type="text" name="monthly_fee" value="<?php echo $monthly_fee; ?>" required readonly="readonly"  >
                </div>
                <!-- <div class="inputBox">
                    <span>Offer Price:</span>
                    <input type="text" name="p_offer" value="<?php echo $offer ?>" required placeholder="1000" readonly="readonly">
                </div> -->
                <div class="inputBox">
                    <input type="hidden" name="user_id" value="<?php echo $userid ?>" required  readonly="readonly">
                    <input type="hidden" name="isp_id_submit" value="<?php echo $ispid ?>" required  >
                    <input type="hidden" name="monthly_fee" value="<?php echo $monthly_fee ?>" required  >
                    
                </div>
                
            <!-- 
                <div class="flex">
                    <div class="inputBox">
                        <span>state :</span>
                        <input type="text" placeholder="india">
                    </div>
                    <div class="inputBox">
                        <span>zip code :</span>
                        <input type="text" placeholder="123 456">
                    </div>
                </div> -->

            </div>

            <div class="col">

                <h3 class="title">payment</h3>

                <div class="inputBox">
                    <span>Send Money (01x-xxx-xxxxx) :</span>
                    <img src="../images/bkash.jpg" alt="">
                </div>
                <div class="inputBox">
                    <span>Select a Month:</span>
                    <select name="month" required>
                    <option value="jan">January</option>
                    <option value="feb">February</option>
                    <option value="mar">March</option>
                    <option value="apr">April</option>
                    <option value="may">May</option>
                    <option value="jun">June</option>
                    <option value="jul">July</option>
                    <option value="aug">August</option>
                    <option value="sep">September</option>
                    <option value="oct">October</option>
                    <option value="nov">November</option>
                    <option value="dcm">December</option>
                    </select>
                    
                </div>
                
                <!-- <div class="inputBox">
                    <span>Select Month :</span>
                        <datalist id="mylist">
                            <option value="January">
                            <option value="February">
                            <option value="March">
                            <option value="April">
                            <option value="May">
                            <option value="June">
                            <option value="July">
                            <option value="August">
                            <option value="September">
                            <option value="October">
                            <option value="November">
                            <option value="December">
                        </datalist>
                    <input type="text" id="mylist" list="mylist" name="month" value="" required placeholder="Select a month"  >
                </div> -->
                <div class="inputBox">
                    <span>Payment Method :</span>
                        <datalist id="mylist1">
                            <option value="bKash">
                            <option value="Rocket">
                            <option value="Nagad">
                        </datalist>
                    <input type="text" id="mylist1" list="mylist1" name="pay_method" value="" required placeholder="bKash/Rocket/Nagad"  >
                </div>
                <div class="inputBox">
                    <span>Mobile Number :</span>
                    <input type="tel" name="mobile" value="" required placeholder="014****855516" pattern="[0-9]{11}">
                </div>
                <div class="inputBox">
                    <span>TXN-ID :</span>
                    <input type="text" name="tnxid" value="" required placeholder="1111-2222-3333-4444">
                </div>
                <div class="inputBox">
                    <span>Paid Amount :</span>
                    <input type="text" name="paid_amount" value="<?php echo $monthly_fee; ?>" required placeholder="Insert Amount(Ex: 500)">
                </div>
                <!-- <div class="inputBox">
                    <span>ISP ID:</span>
                    <input type="text" placeholder="54545">
                </div> -->
                <!-- <div class="inputBox">
                    <span>ISP Name:</span>
                    <input type="text" placeholder="Name">
                </div> -->

                <!-- <div class="flex">
                    <div class="inputBox">
                        <span>exp year :</span>
                        <input type="number" placeholder="2022">
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" placeholder="1234">
                    </div>
                </div> -->

            </div>
    
        </div>

        <input type="submit" name="submit" value="Confirm Payment" class="submit-btn">

    </form>

</div>    
    
</body>
</html>







