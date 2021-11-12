<?php
session_start();
include_once '../connect.php';

$login=$_SESSION['login'];
$log="Пользователь вышел";
$queryl="INSERT INTO `logs` (log,login) VALUES ('$log','$login')";
$resultlog=mysqli_query($con,$queryl);
session_destroy();
header('Location: /');
?>