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
            $monthly_fee = $_GET['monthly_fee'];
            $p_offer = $_GET['offer'];
            // $update = $_GET['op1'];
            // $delete = $_GET['op2'];

            echo $p_name,$p_cost;
            
                $sql = "UPDATE isp_info SET package_name = '$p_name',packages ='$p_speed',package_cost='$p_cost', monthly_fee='$monthly_fee',offers='$p_offer' WHERE isp_id='$id' AND package_name='$p_name'";

                if ($conn->query($sql) === TRUE) {
                    header('Location: ispadmin.php');
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();

            


        

        ?>


        
    </body>

</html>