<?php

echo "hamim ahmed komol";
// $id = $_GET['userid'];
// echo $id;
session_start();
if(isset($_SESSION['userid'])){
    echo $_SESSION['userid'];
}

?>