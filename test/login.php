<?php
session_start();
include_once 'connect.php';



if(isset($_POST['login']) && isset($_POST['password'])){
   
    $login=mysqli_real_escape_string($con,$_POST['login']);
    
    $password=md5(md5($_POST['password']));
    
    $query="SELECT * FROM `users` WHERE login='$login' and password='$password'";
    $result=mysqli_query($con,$query) or die(mysqli_error($con));
    $count=mysqli_num_rows($result);

    if($count) {
     
        $_SESSION['login']=$login;
        $_SESSION['online']=1;
        $profile=mysqli_fetch_assoc($result);
        header('Location: 4.php');
        
    } else {
        $fmsg = "Ошибка. Не верный логин или пароль.";
    }
   
   


}
?>