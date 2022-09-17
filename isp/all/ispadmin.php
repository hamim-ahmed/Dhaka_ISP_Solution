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
                div.mainbody {
                  
                  background-image: url('../../images/<?php printf($image);?>');
                  background-repeat: no-repeat;
                  background-size: 100% 100%;
              
                } 
                  
                div.lower_body{
                    background-image: url('../../images/<?php printf($image);?>');
                    background-repeat: no-repeat;
                    background-size: 100% 100%;
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
                            <a class='active' href='ispadmin.php'>My Panel</a>
                            <a class='' href='adminreport.php'>Users & Complain</a>
                            <a class='' href='subrequest.php'>Sub Request</a>
                            <a class='' href='ispbilling.php'>Billing</a>
                        </div>
                        <div class='topright'>
                            <!-- <a href='ispsignup.php'>ISP-SIGNUP</a> -->
                            <a class='' href='ispinfo.php'>My Info</a>
                            <a href='isplogout.php'>LogOut</a>
                        </div>
                    </div>

                    <div class='mainbody'>
                        <div class='bg-color'>
                            <?php
                                // printf($id);
                                $query = "SELECT isp_name FROM isp_admin where isp_id='$id'";
                                
                                if ($result = $conn->query($query)) {
                                            
                                    if($result->num_rows>"0"){
                                        //print("%s",$row["First_Name"]);

                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            print("<h1> $isp_name </h1>");
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

                <div class='title1'>
                    <h1>OUR <span>PACKAGES<span><h1>
                </div>

                <div class='lower_body'>

                    <div class ='all_pck'>
                        <?php
                            $query = "SELECT package_name,packages,package_cost,offers,monthly_fee FROM isp_info where isp_id='$id'";
                            if($result = $conn->query($query)){
                                while($row = $result->fetch_assoc()){
                                    extract($row);
                                    print("<div class = 'package'>
                                        <div class='image'>
                                            <img src='../images/main.png' width=300px hight=300px>
                                        </div>
                                        <div class ='info'>
                                                        <form id='' class='' action='updatepackage.php' method='get'>
                                                            <!-- <h3 class=' text-white pt-5'></h3> -->
                                
                                                                <label for='First_Name' class=''><b>Pakage Name:</b></label>
                                                                <br>
                                                                <input type='text' name='name' id='First_Name' value='$package_name' class='' required>
                                                                <br>

                                                                <label for='Last_Name' class=''><b>Speed:</b></label> 
                                                                </br>
                                                                <input type='number' name='speed' id='Last_Name' value='$packages' class='' required>
                                                                <br>

                                                                <label for='email' class=''><b>Subscription Price:</b></label> 
                                                                <br>
                                                                <input type='number' name='cost' id='email' value='$package_cost' placeholder = '' class='' required>
                                                                <br>

                                                                <label for='address' class=''><b>Offer Price:</b></label> 
                                                                <br>
                                                                <input type='number' name='offer' id='address' value='$offers' class='' required> 
                                                                <br>

                                                                <label for='email' class=''><b>Monthly Fees:</b></label> 
                                                                <br>
                                                                <input type='number' name='monthly_fee' id='email' value='$monthly_fee' placeholder = '' class='' required>
                                                                <br>

                                                                

                                                     
                                                        
                                        </div>
                                        <div class='btn'>
                                            <button class='ui violet button'><input type='hidden' name='userid' id='Last_Name' value='Update package' class=''>Update Package</button>
                                        </div>
                                        <div class='btn'>
                                            <button class='ui red button'><a href='deletepackage.php? name=$package_name & speed=$packages & cost=$package_cost & offer=$offers'>Delete Package</a></button>
                                        </div>
                                        </form>
                                    </div>");

                                }

                            }
                        ?>

                    </div>

                    <?php
                    print("<div class='new_package'>
                            <button class='ui inverted big red button'><a href='addpackage.php'>ADD New Package</a></button>
                    </div>");
                ?>

                </div>
                <?php
                    // print("<div class='new_package'>
                    //         <button class='ui inverted big red button'><a href='addpackage.php'>ADD New Package</a></button>
                    // </div>");
                ?>

                <div class='footer'>

                </div>
        



    </body>
</html>