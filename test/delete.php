<?php
session_start();
include_once 'connect.php';


if($_SESSION['online']==1)
{
    $id=$_POST['id'];
$query=mysqli_query($con,"DELETE FROM `users` WHERE `users`.`id` = '$id'");

if($query)
{
    $_SESSION['deleted']= "Пользователь ".$id." успешно удалён!";
    header('Location: 4.php');

}

}






?>