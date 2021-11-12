<?php
session_start();
include_once 'connect.php';
$_SESSION['reg']=0;








if($_SESSION['online']==1)
{
        $login=$_POST['login'];
        $_SESSION['reg_login']=$login;
        
        $np=$_POST['phone'];
        $_SESSION['reg_phone'] =$np;

        
        $fnm=$_POST['fname']=$np;
        $_SESSION['reg_fname']=$fnm;
        
        $lnm=$_POST['lname'];
        $_SESSION['reg_lname']=$lnm;

        $email=$_POST['email'];
        $_SESSION['reg_email']=$email;
        
        // $adr=$_SERVER['REMOTE_ADDR'];
        
        $bdate=$_POST['bdate'];
        $_SESSION['reg_bdate']=$bdate;
        
        $password=md5(md5($_POST['password']));
        $_SESSION['reg_password']=$_POST['password'];
        
        $query="INSERT INTO `users` (`login`,`password`,`np`,`fname`,`lname`,`ip_when_create`,`groups`) VALUES ('$login','$password','$np','$fnm','$lnm','$email','$bdate')";
    
        $result=mysqli_query($con,$query);
  

        if($result)
            {
            $_SESSION['reg'] = "Регистрация прошла успешно!";
            

        
            header('Location: 4.php');
        
            }
            else
            {
            $_SESSION['logerror']=var_dump($result);
            $_SESSION['reg']= "Ошибка!";
            header('Location: 4.php');
            }

         
        
        
}



?>