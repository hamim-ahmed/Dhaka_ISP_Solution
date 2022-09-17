<?php
        // starting the session
        session_start();
        if(isset($_SESSION['userid'])){
                $userid = $_SESSION['userid'];

                $p_name = $_GET['p_name'];
                $p_speed = $_GET['p_speed'];
                $p_price = $_GET['p_cost'];
                $p_offer = $_GET['p_offer'];
                $ispid = $_GET['ispid'];
                $ispname = $_GET['ispname'];
                // echo $userid;
                // echo $p_name;
                // echo $p_speed;
                // echo $p_price;
                // echo $p_offer;
                // echo $ispid;
                // echo $ispname;
            
                // echo($userid $p_name $p_speed $p_price $p_offer $ispid $ispname);
                // print($id);

                // connection to the database
                require_once("db_connection.php");
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_errno) {
                printf("Connect failed: %s\n", $conn->connect_error);
                exit();
                }

                // performing query selection from database.
                $query = "SELECT First_Name,Address,mobile FROM user where user_id='$userid'";
                if ($result = $conn->query($query)) {
                            
                    if($result->num_rows>"0"){
                        //print("%s",$row["First_Name"]);

                        while ($row = $result->fetch_assoc()) {
                            extract($row);

                            $sql = "INSERT INTO user_info (user_id, connected_ispid, isp_name, package_name,sub_fee,package_speed)
                                                    VALUES ('$userid', $ispid, '$ispname', '$p_name', $p_price, $p_speed)";

                            if ($conn->query($sql) === TRUE) {
                                echo "$ Successfull";
                                // header('Location: ');
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                            $sql = "INSERT INTO subscriber_list(isp_id, isp_name,sub_fee,package_name, package_speed,subscriber_id, subscriber_name,subscriber_address,subscriber_phone)
                                                    VALUES ($ispid, '$ispname', $p_price, '$p_name', $p_speed, '$userid', '$First_Name', '$Address', '$mobile'  )";

                            if ($conn->query($sql) === TRUE) {
                                echo "$ Successfull";
                                header('Location: usersubscription.php');
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }

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
        else{
            // print("<h1>please login first<h1>");
            header('Location: ../../users/all/userinfo.php');
            exit();
                
        }
?>