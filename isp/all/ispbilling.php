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
                div.table{
                    height: auto;
                }
                table,th,td{
                border:3px solid blue;
                border-collapse: collapse;
                font-size: 20px;
                color:white;
                background-color:black;
                opacity:0.9;  /*to keep the text fixed ,use RGBa color */
                width:100%;
                height:auto;
                
                }
                
                th,td{
                    width: 300px;;
                    padding:5px;
                    text-align: center;
                    
                }
                td.mnth{
                    color:blue;
                    font-weight: bold;
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
                  background-size: 100% 100%;
                  height: auto;
              
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
                            <a class='' href='subrequest.php'>Sub Request</a>
                            <!-- <a class='' href='ispbilling.php'>Billing</a> -->
                            <a class='active' href='#'>Billing</a>
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

                                <div class="table" >
                                        <table >
                                            <thead>
                                                <th>Customer Name</th>
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
                                                

                                                <!-- <th>Unsubscribe</th>
                                                <th>Visit</th> -->
                                                <!--<th>Rating</th>-->
                                            </thead>
                                            <?php
                                                        $status = "Subscribed";
                                                        $query = "SELECT * FROM billing WHERE isp_id = '$id'";
                                                        if ($result = $conn->query($query)) {
                                                            printf("You have %d Subcribed Packages!", $result->num_rows);
                        
                                                            if($result->num_rows>"0"){
                                        
                            
                                                                while ($row = $result->fetch_assoc()) {
                                                                    extract($row);
                                                                    printf("<tr>");
                                                                    printf(" <td> %s</td> <td>%s</td> <td> %s</td> <td> %s</td>
                                                                            <td class='mnth'> %s</td> <td class='mnth'>%s</td> <td class='mnth'> %s</td> <td class='mnth'> %s</td>
                                                                            <td class='mnth'> %s</td> <td class='mnth'>%s</td> <td class='mnth'> %s</td> <td class='mnth'> %s</td>
                                                                            <td class='mnth'> %s</td> <td class='mnth'>%s</td> <td class='mnth'> %s</td> <td class='mnth'> %s</td>
                                                                        
                                                                            ",
                                                                    
                                                                            $subscriber_name, $package_name,$package_speed, $monthly_fee,$jan,$feb,$mar,$apr,$may,$jun,$jul,
                                                                            $aug,$sep,$oct,$nov,$dcm   );
                                                                    printf("</tr>");
                                                                    // echo $subscriber_name,$package_name,$package_speed;
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
                                <div>
                                    <form action='../../users/all/monthlybillpay.php' method='post'>

                                    <input  type='hidden' name='isp_id' value=$isp_id>
                                    <input  type='hidden' name='isp_name' value=$isp_name>
                                    <input  type='hidden' name='p_name' value=$package_name>
                                    <input  type='hidden' name='p_speed' value=$package_speed>
                                    <input  type='hidden' name='monthly_fee' value=$monthly_fee>
                                    <input  type='hidden' name='user_name' value='$subscriber_name'>

                                                                        
                                    <input class='ui pink button' type='submit' value='Confirm Payments' name='Edit' >
                                    </form>


                                </div>

                         </div>

                    </div>
                </div>
               
               

                <div class='footer'>

                </div>
        



    </body>
</html>