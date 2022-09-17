<?php
$p_name = $_POST['p_name'];
printf($p_name);
$p_cost = $_POST['p_cost'];
printf($p_cost);
$username = $_POST['user_name'];
printf($username);
printf($_POST['user_id']);
$ispid = $_POST['isp_id'];
printf($ispid);
$method = $_POST['pay_method'];
$mobile = $_POST['mobile'];
$trans_id =$_POST['tnxid'];
$total_paid = $_POST['paid_amount'];
printf($method,$mobile,$trans_id,$total_paid);
printf($mobile);
?>