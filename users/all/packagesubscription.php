
<?php
            // $id = $_GET['ispid'];
            // $id = $_POST['ispid'];
            // print($id);

            // session_start();
            if(isset($_GET['ispid'])){
                $id = $_GET['ispid'];
                // $id = $_SESSION['ispid'];
                require_once("db_connection.php");
                $conn = new mysqli($servername,$username,$password,$dbname);
                if($conn->connect_errno){
                    printf("database Connection failed:%s\n",$conn->connect_error);
                    exit();
                }
            }
            elseif(isset($_POST['ispid'])){
                $id = $_POST['ispid'];
                // $id = $_SESSION['ispid'];
                require_once("db_connection.php");
                $conn = new mysqli($servername,$username,$password,$dbname);
                if($conn->connect_errno){
                    printf("database Connection failed:%s\n",$conn->connect_error);
                    exit();
                }
            }
            else{
                printf("ISP NOT FOUND");
                // header('Location: ../../users/all/userinfo.php');

                exit();
            }
            $query = "SELECT image from isp_admin where isp_id = '$id' ";
            // printf($id);
            if($result = $conn->query($query)){
                while ($row = $result->fetch_assoc()) {
                    extract($row);
                    // printf($image);
                }      
            }
            
            if($image == NULL){
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
            // // $id = $_GET['ispid'];
            // $id = $_POST['ispid'];

            // // session_start();
            // if(isset($id)){
            //     // $id = $_SESSION['ispid'];
            //     require_once("db_connection.php");
            //     $conn = new mysqli($servername,$username,$password,$dbname);
            //     if($conn->connect_errno){
            //         printf("database Connection failed:%s\n",$conn->connect_error);
            //         exit();
            //     }
            // }
            // else{
            //     printf("Please Login first");
            //     // header('Location: ../../users/all/userinfo.php');

            //     exit();
            // }
        ?>    
                <div class='outer'>
                    <div class='topbar'>
                        <div class='topleft'>
                        <a class='active' href='../../home/all/index.php'>Home</a>
                        <a href='../../home/all/usersignup.php'>USER-SIGNUP</a>
                        <a href='../../home/all/userlogin.php'>USER-LOGIN</a>
                        </div>
                        <div class='topright'>
                        <a href='../../home/all/ispsignup.php'>ISP-SIGNUP</a>
                        <a href='../../home/all/isplogin.php'>ISP-LOGIN</a>
                        <a href ='userinfo.php'><i class="blue large user circle icon"></i></a>
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
                                            $ispname = $isp_name;
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
                                            <h1>$package_name</h2>
                                            <h2>Speed:&nbsp<span>$packages Mbps</span></h2>
                                            <h2>Subscription Fee:&nbsp <span>$package_cost tk</span></h2>
                                            <h2>Offer Price: &nbsp<span>$offers tk</span></h2>
                                            <h2>Monthly Fee: &nbsp<span>$monthly_fee tk</span></h2>
                                        </div>
                                        <div class='btn'>
                                            <button class='ui red button'><a href='subbillpay.php? p_name=$package_name & p_speed=$packages & p_cost=$package_cost & p_offer=$offers & ispid=$id & ispname=$isp_name & monthly_fee=$monthly_fee'>Subscribe</a></button>
                                        </div>
                                    </div>");

                                }

                            }
                        ?>

                    </div>

                </div>

                <div class='footer'>

                </div>
        



    </body>
</html>