<!DOCTYPE html>
<html lang="ru">
<?php
include_once '../connect.php';
session_start();

 $color= array("red","pink","purple","deep-purple","indigo","blue","green","lime","yellow","deep-orange","brown");
    $rc=rand(0,11);              
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <link rel="icon" href="<?php echo $url;  ?>/logo1orig.png" sizes="32x32">


    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



     <!-- CSS-->
    <link href="<?php echo $url;  ?>/css/prism.css" rel="stylesheet">
    <link href="<?php echo $url;  ?>/css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
   
    <link href="<?php echo $url;  ?>/css/css.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url;  ?>/css/icon.css" rel="stylesheet">
 
       <title>Вход</title>
  </head>
   
<a style="margin: 10px"  href="/" class="btn waves-effect">Назад</a> 

    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
          <div class="row center">
            <div class="col s12 m10 offset-m1">
                
     <h1 class="header"> Вход</h1>
     <div class="card-panel <? echo $color[$rc] ?> lighten-5">
         
        <?php 

     if(isset($_SESSION['login'])){
        header('Location: /');
    }
    if(isset($_POST['login']) && isset($_POST['password'])){
       
        $login=mysqli_real_escape_string($con,$_POST['login']);
        
        $password=md5(md5($_POST['password']));
        
        $query="SELECT * FROM `users` WHERE login='$login' and password='$password'";
        $result=mysqli_query($con,$query) or die(mysqli_error($con));
        $count=mysqli_num_rows($result);

        if($count) {
            $log="Пользователь онлайн";
            $queryl="INSERT INTO `logs` (log,login) VALUES ('$log','$login')";
            $resultlog=mysqli_query($con,$queryl);
            $_SESSION['login']=$login;
            $_SESSION['online']=1;
            $profile=mysqli_fetch_assoc($result);
            $_SESSION['lvl']=$profile['lvl'];
            header('Location: /');
        } else {
            $fmsg = "Ошибка. Не верный логин или пароль.";
        }
       
       


    }

    
    ?>
<form class="form-signing" method="POST">
       <? echo $fmsg; ?>
        <div class="input-field">
        <input type="text" name="login" maxlength="15" class="form-control"  required>
        <label for="input_text">Логин</label>
        </div>
       
        <div class="input-field">
        
        <input type="password" id="i" name="password" maxlength="15" class="form-control"  required>
        <label for="i">Пароль</label>
        </div>
        <button id="btnw" class="btn waves-effect" type="submit">Войти </button> 
        
    
    
    </form>

  
    
    
    </div>
            </div>
          </div>
        </div>
    </div>
    
    
    
    <!--  Scripts-->
    
    <script async="" type="text/javascript" src="<?php echo $url;  ?>/js/carbon.js"></script>
        <script src="<?php echo $url;  ?>/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $url;  ?>/js/jquery.timeago.min.js"></script>
    <script src="<?php echo $url;  ?>/js/prism.js"></script>
    <script src="<?php echo $url;  ?>/js/lunr.min.js"></script>
    <script src="<?php echo $url;  ?>/js/search.js"></script>
    <script src="<?php echo $url;  ?>/js/materialize.js"></script>
    <script src="<?php echo $url;  ?>/js/init.js"></script>
   
  

