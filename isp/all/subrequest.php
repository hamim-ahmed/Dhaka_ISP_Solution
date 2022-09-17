<?php
            session_start();
            if(isset($_SESSION['ispid'])){
                $id = $_SESSION['ispid'];
                require_once("db_connection.php");
                $conn = new mysqli($servername,$username,$password,$dbname);
                if($conn->connect_errno){
                    printf("database Connection failed:%s\n",$conn->connect_error);
                    exit();
                }
                if(isset($_GET['flag'])){
                    // printf($_GET['flag']);
                    echo "<script> alert('Subscription confirm.'); </script>";
                
                }
            }
            else{
                printf("Please Login first");
                header('Location: ../../home/all/isplogin.php');
                exit();
            }

            
            $query = "SELECT image from isp_admin where isp_id = '$id' ";
            if($result = $conn->query($query)){
                while ($row = $result->fetch_assoc()) {
                    extract($row);
                    // printf($image);
                }      
            }
            
            if($image==NULL){
                $image = 'main.png';
            }
            
?>




<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <title>Dhaka ISP Solution</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css'>    <!-- semantic-ui cdn -->   <!--bootstrep-->
        <link rel='stylesheet' href='../css/style.css'>
        <style>
                div.new_package{
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-content: center;
                    padding: 20px;
                    padding-top:0px;
                }
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
            div.mainbody1 {
                  
                  background-image: url('../../images/<?php printf($image);?>');
                  background-repeat: no-repeat;
                  background-size: 100% 100%
              
                }
            div.bg-color{
                background-color: rgba(58, 156, 160, 0.75);
            }
            
            div.footer{
                display: flex;
                flex-direction: column;
                align-items: center;
                background-color: rgb(61, 61, 61);
                height: 200px;
                width: 100%;
            }

        </style>
    </head>
    <body>
        
        <?php
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
                            <a class='active' href='#'>Sub Request</a>
                            <a class='' href='ispbilling.php'>Billing</a>
                            <!-- <a class=' href='userlogin.php'>USER-LOGIN</a> -->
                        </div>
                        <div class='topright'>
                            <!-- <a href='ispsignup.php'>ISP-SIGNUP</a> -->
                            <a class='' href='ispinfo.php'>My Info</a>
                            <a href='isplogout.php'>LogOut</a>
                        </div>
                    </div>

                    <div class='mainbody1'>
                        <div class='bg-color'>
                                <div>
                                    <?php
                                        // printf($id);
                                        $query = "SELECT isp_name FROM isp_admin where isp_id='$id'";
                                        if ($result = $conn->query($query)) {
                                                    
                                            if($result->num_rows>"0"){
                                                //print("%s",$row["First_Name"]);

                                                while ($row = $result->fetch_assoc()) {
                                                    extract($row);
                                                    print("<h1 class='name'> $isp_name </h1>");
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

                                <div >
                                        <table >
                                            <thead>
                                                <th>Customer Name</th>
                                                <th>Package Name</th>
                                                <th>speed</th>
                                                <th>Subscription Fee</th>
                                                <th>Offer Price</th>
                                                <th> Monthly Fee </th>
                                                <th> View Details </th>
                                                
                                                <!-- <th> Reply </th> -->
                                                <!--<th>Rating</th>-->
                                            </thead>
                                            <?php


                                                    $query = "SELECT * FROM gateway where pay_status='varified'";
                                                    //$query = "SELECT s.isp_name,s.sub_fee,s.package_speed,s.isp_id,s.package_name,s.reply,i.user_id FROM user i JOIN subscriber_list s ON(i.user_id = s.subscriber_id)  WHERE user_id = $id";  
                                                    if ($result = $conn->query($query)) {
                                                        printf("<b>You have %d Users!</b>", $result->num_rows);
                                                        /* fetch associative array */
                                                        //printf("<br><b>hotel_id  \n\n\n hotel_name contact_no location</b><br>");
                                                        if($result->num_rows>"0"){

                                                            
                                                        /*while ($row = $result->fetch_assoc()) {
                                                            printf("<tr>");
                                                            printf(" <td> %s</td> <td>%s</td> <td> %s</td> <td> %s</td> <td> %s </td> <td> %s </td> <td> 
                                                            <form action='reportsubmit.php' method='post'>

                                                            <input  type='hidden' name='ispid' value='%s'> 
                                                            <input  type='hidden' name='packagename' value='%s'>
                                                            <input  type='hidden' name='userid' value='%s'>
                                                                                                
                                                            <input class='btn btn-primary btn-lg' type='submit' value='Reply' name='Edit' >
                                                            </form> </td>"
                                                            
                                                            , $row["subscriber_name"], $row["package_name"],$row["subscriber_address"],$row["subscriber_phone"],$row["complain"],$row["reply"],$row["isp_id"], $row["package_name"],$row["subscriber_id"]  );
                                                            printf("</tr>");
                                                        }*/

                                                        while ($row = $result->fetch_assoc()) {
                                                            // $offer_price = $row["offers"];
                                                            // if($offer_price==0){
                                                            //     $offer_price=$row["sub_fee"];
                                                            // }
                                                            if($row["offers"]==0){
                                                                $row["offers"] = "None";
                                                            }
                                                            // printf($row["monthly_fee"]);
                                                            printf("<tr>");
                                                            printf(" <td> %s</td> <td>%s</td> <td> %s</td> <td> %s</td> <td> %s </td> <td>%s</td>
                                                            <form action='requestdetails.php' method='post'>

                                                            
                                                            <td> 
                                                            <input  type='hidden' name='isp_id' value='%s'> 
                                                            <input  type='hidden' name='gateway_serial_id' value='%s'>
                                                            <input  type='hidden' name='user_id' value='%s'>
                                                            <input  type='hidden' name='package_name' value='%s'>
                                                            <input  type='hidden' name='monthly_fee' value='%s'>

                                                                                                
                                                            <input class='ui white button' type='submit' value='Details' name='Edit' >
                                                            </form> 
                                                            </td>"
                                                            
                                                            , $row["user_name"], $row["package_name"],$row["package_speed"],$row["sub_fee"]
                                                            ,$row["offers"],$row["monthly_fee"], $row["connected_ispid"], $row["serial_id"],$row["user_id"],$row["package_name"],$row["monthly_fee"] );
                                                            printf("</tr>");
                                                        }

                                                        //printf("</table>");

                                                            $result->free(); //free result set
                                                        }
                                                        else{
                                                            printf("<h3><b>No record found!</b></h3>");
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
                </div>
               
               

                <div class='footer'>

                </div>
        



    </body>
</html>