<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
        <title>Dhaka ISP Solution</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">    <!-- semantic-ui cdn -->   <!--bootstrep-->
    </head>

    <body>
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
                exit();
            }
            $p_name = $_GET['name'];
            $p_speed = $_GET['speed'];
            $p_cost = $_GET['cost'];
            $p_offer = $_GET['offer'];
            $monthly_fee= $_GET['monthly_fee'];

            echo $p_cost,$p_speed,$p_offer,$p_name;
            // $sql = "UPDATE isp_info SET package_name = '$p_name',packages ='$p_speed',package_cost='$p_cost',offers='$p_offer' WHERE isp_id=$id AND package_name='$p_name'";
            $sql = "DELETE FROM isp_info WHERE isp_id = '$id' AND package_name='$p_name' AND package_cost=$p_cost";

            if ($conn->query($sql) === TRUE) {
                header('Location: ispadmin.php');
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();


        

        ?>


        
    </body>

</html>