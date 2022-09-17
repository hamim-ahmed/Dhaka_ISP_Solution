<?php
        // starting the session
        // session_start();
        // if(isset($_SESSION['userid'])){
        //         $userid = $_SESSION['userid'];

        //         $p_name = $_GET['p_name'];
        //         // $p_speed = $_GET['p_speed'];
        //         // $p_price = $_GET['p_cost'];
        //         // $p_offer = $_GET['p_offer'];
        //         $ispid = $_GET['ispid'];
        //         // $ispname = $_GET['ispname'];
        //         echo $userid;
        //         echo $p_name;
        //         // echo $p_speed;
        //         // echo $p_price;
        //         // echo $p_offer;
        //         echo $ispid;
        //         // echo $ispname;
            
        //         // echo($userid $p_name $p_speed $p_price $p_offer $ispid $ispname);
        //         // print($id);

        //         // connection to the database
        //         require_once("db_connection.php");
        //         $conn = new mysqli($servername, $username, $password, $dbname);
        //         if ($conn->connect_errno) {
        //         printf("Connect failed: %s\n", $conn->connect_error);
        //         exit();
        //         }

        //         // performing query selection from database.
                
        // }
        // else{
        //     print("<h1>please login first<h1>");
        //     exit();
                
        // }

        // $sql = "DELETE FROM user_info WHERE connected_ispid = $ispid AND package_name='$p_name' AND user_id='userid'";

        //         if ($conn->query($sql) === TRUE) {
        //             // header('Location: test.php');
        //             echo "successful";
        //         } else {
        //         echo "Error: " . $sql . "<br>" . $conn->error;
        //         }

        // $sql = "DELETE FROM subscriber_list WHERE isp_id = $ispid AND package_name='$p_name' AND subscriber_id ='userid'";

        //         if ($conn->query($sql) === TRUE) {
        //             // header('Location: usersubscription.php');
        //             echo "successful";
        //         } else {
        //         echo "Error: " . $sql . "<br>" . $conn->error;
        //         }

        session_start();
        if(isset($_SESSION['userid'])){
                $userid = $_SESSION['userid'];

                $p_name = $_GET['p_name'];
        //         // $p_speed = $_GET['p_speed'];
        //         // $p_price = $_GET['p_cost'];
        //         // $p_offer = $_GET['p_offer'];
                $ispid = $_GET['ispid'];
        //         // $ispname = $_GET['ispname'];
                echo $userid;
                echo $p_name;
        //         // echo $p_speed;
        //         // echo $p_price;
        //         // echo $p_offer;
                echo $ispid;
        //         // echo $ispname;

                require_once("db_connection.php");
                $conn = new mysqli($servername, $username, $password, $dbname);
                // if ($conn->connect_errno) {
                // printf("Connect failed: %s\n", $conn->connect_error);
                // exit();
                // }


                $sql = "DELETE FROM user_info WHERE connected_ispid = $ispid AND package_name='$p_name' AND user_id='userid'";

                if ($conn->query($sql) === TRUE) {
                    header('Location: usersubscription.php');
                    echo "successful";
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }




        }



?>