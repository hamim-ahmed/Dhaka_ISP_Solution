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
                  
                    background-image: url('../../images/<?php printf($image);?>');
                    background-repeat: no-repeat;
                    background-size: 100% 100%;
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
                            <a class='' href='subrequest.php'>Sub Request</a>
                            <a class='' href='ispbilling.php'>Billing</a>
                            
                        </div>
                        <div class='topright'>
                            <!-- <a href='ispsignup.php'>ISP-SIGNUP</a> -->
                            <a class='active' href='ispinfo.php'>My Info</a>
                            <a href='isplogout.php'>LogOut</a>
                        </div>
                    </div>

                    <div class='mainbody'>

                    

                        <div class='bg-color'>
                            <?php
                                // printf($id);
                                $query = "SELECT * FROM isp_admin where isp_id='$id'";
                                if ($result = $conn->query($query)) {
                                            
                                    if($result->num_rows>"0"){
                                        //print("%s",$row["First_Name"]);

                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            print("<h1> $isp_name </h1>");
                                        }
                                        $result = $conn->query($query);
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            // print("<form action='page.php' method='get'>
                                            //             f0:<input type='text' name='CourseID' value='$First_Name'> 
                                                                                                
                                            //             <input type='submit' value='Edit' name='Edit' >
                                            //         </form>"); 
                                            print("<form id='' class='' action='updateinfo.php' method='POST' autocomplete='off' enctype='multipart/form-data'>
                                                    <!-- <h3 class=' text-white pt-5'></h3> -->
                        
                                                        <label for='isp Name' class=''><b>ISP Name:</b></label>
                                                        <br>
                                                        <input type='text' name='isp_name' id='isp Name' value='$isp_name' class='' required>
                                                        <br>

                                                        <label for='area' class=''><b>Coverage Area:</b></label> 
                                                        </br>
                                                        <input readonly='readonly' type='text' name='' id='area' value='$area_coverage' class='' required>
                                                        <br>
                                                        <textarea  name='coverage' id='area' rows='3' cols='20' wrap='virtual' placeholder='$area_coverage' value='' >$area_coverage</textarea>
                                                        <br>

                                                        <label for='email' class=''><b>Email:</b></label> 
                                                        <br>
                                                        <input type='email' name='Email' id='email' value='$Email' placeholder = 'enter your Email' class=''>
                                                        <br>

                                                        <label for='address' class=''><b>Address:</b></label> 
                                                        <br>
                                                        <input type='text' name='Address' id='address' value='$office_address' class='' required> 
                                                        <br>

                                                        <label for='mobile' class=''><b>Contact No:</b></label> 
                                                        <br>
                                                        <input type='tel' placeholder='01xxxxxxxxx' pattern='[0-9]{11}' name='mobile' id='mobile' value='$mobile' class='' required>
                                                        <br>
                                                        
                                                        <label for='img' class=''>Upload Identity Image:</br> </label>
                                                        <br>
                                                        <input type='file' name='image' id='img' accept='.jpg, .jpeg, .png' title='choose jpg jpeg png only' value=''>
                                                        <br>


                                                        <input type='hidden' name='ispid' id='Last_Name' value='$id' class=''>
                                                    
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
                            ?>
                            
                        </div>

                    </div>
                  
                </div>

                <div class='footer'>

                </div>


                



    </body>
</html>