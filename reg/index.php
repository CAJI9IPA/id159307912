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
    
  <link rel="icon" href="http://f0424029.xsph.ru/logo1orig.png" sizes="32x32">


    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



     <!-- CSS-->
    <link href="http://f0424029.xsph.ru/css/prism.css" rel="stylesheet">
    <link href="http://f0424029.xsph.ru/css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
   
    <link href="http://f0424029.xsph.ru/css/css.css" rel="stylesheet" type="text/css">
    <link href="http://f0424029.xsph.ru/css/icon.css" rel="stylesheet">
 <title>Регистрация</title>
      
  </head>
   
<a style="margin: 10px" href="/" class="btn waves-effect">Назад</a> 
       
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
          <div class="row center">
            <div class="col s12 m10 offset-m1">

         <h1 class="header"> Регистрация </h1>
          <div class="card-panel <? echo $color[$rc] ?> lighten-5">
   <?php 
    if(isset($_SESSION['login'])){
        header('Location: /');
    }
    if(isset($_POST['login']) && isset($_POST['password']))
    {
            $login=htmlspecialchars($_POST['login'],ENT_QUOTES);
            $login=mysqli_real_escape_string($con,$login);
            
            $np=htmlspecialchars($_POST['phone'],ENT_QUOTES);
            $np=mysqli_real_escape_string($con,$np);
            
            $fnm=htmlspecialchars($_POST['fname'],ENT_QUOTES);
            $fnm=mysqli_real_escape_string($con,$fnm);
            
            $lnm=htmlspecialchars($_POST['lname'],ENT_QUOTES);
            $lnm=mysqli_real_escape_string($con,$lnm);
            
            $adr=$_SERVER['REMOTE_ADDR'];
            
            $group=htmlspecialchars($_POST['group'],ENT_QUOTES);
            $group=mysqli_real_escape_string($con,$group); 
            
        if(($_POST['password'])==($_POST['password2']))
        {
            if((preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])) && (preg_match("/^[a-zA-Z0-9]+$/",$_POST['password'])))
            {
            
        
           
            $password=md5(md5($_POST['password']));
        
            $query="INSERT INTO `users` (login,password,np,fname,lname,ip_when_create,groups) VALUES ('$login','$password','$np','$fnm','$lnm','$adr','$group')";
            $log="Профиль создан";
            $queryl="INSERT INTO `logs` (log,login) VALUES ('$log','$login')";
            $result=mysqli_query($con,$query);
            $resultlog=mysqli_query($con,$queryl);

            if($result)
                {
                $smsg = "Регистрация прошла успешно ";
                session_start();
                $_SESSION['login']=$login;
                $_SESSION['online']=1;
            
                header('Location: /');
            
                }
                else
                {
                $fsmsg= "Ошибка! ";
                }

            }  
            else
            $fsmsg .= "Используются запрещённые символы в поле логин (Допустимые символы: a-z, A-Z, 0-9)";
        } else $fsmsg .= "Пароли не совпадают";
    }

    
    ?>
 
    <form class="form-signing" method="POST">
        
        <?php if(isset($smsg)){?> <div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div> <?php } ?>
        <?php if(isset($fsmsg)){?> <div class="alert alert-danger" role="alert"> <?php echo $fsmsg; ?> </div> <?php } ?>
        <div class="input-field">
     
        <input type="text" id="input_text"   name="phone" pattern="[0-9]{11}" data-length="11"  minlength="11" maxlength="11"  <? if($fsmsg!="") echo 'value="'.$np.'"'; ?> required>	
        <label for="input_text">телефон</label>
       
        </div> 
        
        
        <div class="input-field">
            
        <input type="text" id="input_text"     name="login"    minlength="5" maxlength="15" class="form-control"  <? if($fsmsg!="") echo 'value="'.$login.'"'; ?> required>
         <label for="input_text">логин</label>
        
        </div>
        
        
        
        <div class="input-field">
        
        <input type="text" id="input_text"     name="fname"    minlength="2" class="form-control"  <? if($fsmsg!="") echo 'value="'.$fnm.'"'; ?> required>
        <label for="input_text">имя</label>
        
       </div>
       
       
       
       <div class="input-field">
           
        <input type="text" id="input_text"     name="lname"    minlength="2" class="form-control"  <? if($fsmsg!="") echo 'value="'.$lnm.'"'; ?> required>
        <label for="input_text">фамилия</label>
       
       </div>
       
       
       
       <div class="input-field">
           
        <input type="text" id="input_text"     name="group"    minlength="2" maxlength="8" class="form-control"  <? if($fsmsg!="") echo 'value="'.$group.'"'; ?> required>
        <label for="input_text">группа</label>
        
       </div>
       
       
        <div class="input-field">
       
        <input type="password" id="input_text" name="password" minlength="5" class="form-control"  required>
       
         <label for="input_text">пароль</label>
        
       </div>
       
        <div class="input-field">
       
        <input type="password" id="input_text" name="password2" minlength="5" class="form-control" required>
         <label for="input_text">пароль ещё раз</label>
        
       </div>
       
       
        <button id="btnw" class="btn waves-effect " type="submit">Зарегистрироваться</button>

    
    
    </form>

    









</div>
            </div>
          </div>
        </div>
    </div>



    <!--  Scripts-->
    
    <script async="" type="text/javascript" src="http://f0424029.xsph.ru/js/carbon.js"></script>
        <script src="http://f0424029.xsph.ru/js/jquery-3.2.1.min.js"></script>
    <script src="http://f0424029.xsph.ru/js/jquery.timeago.min.js"></script>
    <script src="http://f0424029.xsph.ru/js/prism.js"></script>
    <script src="http://f0424029.xsph.ru/js/lunr.min.js"></script>
    <script src="http://f0424029.xsph.ru/js/search.js"></script>
    <script src="http://f0424029.xsph.ru/js/materialize.js"></script>
    <script src="http://f0424029.xsph.ru/js/init.js"></script>
   
  



