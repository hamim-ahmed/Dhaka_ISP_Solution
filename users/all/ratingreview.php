<?php
        // starting the session
        session_start();
        if(isset($_SESSION['userid'])){
            if(isset($_POST['review_submit'])){
                $userid = $_SESSION['userid'];

                // $p_name = $_GET['p_name'];
                // $p_speed = $_GET['p_speed'];
                // $p_price = $_GET['p_cost'];
                // $userid = $_POST['userid'];
                $ispid = $_POST['ispid'];
                $ispname = $_POST['ispname'];
                $review = $_POST['review'];
                $user_rating = $_POST['rating'];
                // echo $userid;
                // echo $p_name;
                // echo $p_speed;
                // echo $p_price;
                // echo $p_offer;
                echo $ispid;
                // echo $ispname,$review,$rating;
            
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

                            $sql = "INSERT INTO rating_review (user_id, isp_id, isp_name,user_name, rating,review)
                                                    VALUES ('$userid', '$ispid', '$ispname', '$First_Name', '$user_rating', '$review')";

                            if ($conn->query($sql) === TRUE) {
                                // echo "$ Successfull";
                                // header('Location: ');
                                $sum_rating=0;
                                $query = "SELECT rating FROM rating_review where isp_id='$ispid'";
                                if ($result = $conn->query($query)) {
                                    // $flag = $result;
                                    // $flag = floatval($flag);
                                    if($result->num_rows>"0"){
                                        $flag = $result->num_rows;
                                        //print("%s",$row["First_Name"]);
                
                                        while ($row = $result->fetch_assoc()) {
                                            extract($row);
                                            $sum_rating = $sum_rating+$rating;
                                            // echo $sum_rating;
                                        }
                                        
                                        // echo floatval($user_rating);
                                        // echo $flag+1;
                                        echo ' ',$sum_rating,' ';
                                        echo $flag,' ';
                                        echo $user_rating,' ';
                                        $updated_rating = $sum_rating;
                                        $updated_rating=($sum_rating+$user_rating)/($flag+1);
                                        // echo $updated_rating,' ';
                                        $updated_rating= round($updated_rating, 1) . PHP_EOL;
                                        echo $updated_rating,' ';
                                        echo $ispid;

                                        $sql = "UPDATE isp_admin
                                        SET rating = '$updated_rating'
                                        WHERE isp_id='$ispid'";
                                        if ($conn->query($sql) === TRUE) {
                                            $flag="review";
                                            echo "<script> alert('Successfully varified'); </script>";
                                            unset($_POST['submit']);
                                            
                                            // unset($_GET['gateway_serial_id']);
                                            header( "Location: usersubscription.php?flag=".$flag  );
                                        }
                                    }
                                    else {
                                    echo "<script> alert('Payment Failed!'); </script>";
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                    }
                                }


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
        }
        else{
            // print("<h1>please login first<h1>");
            header('Location: ../../users/all/userinfo.php');
            exit();
                

            }
                
        
?>