<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<?php
include_once 'connect.php';


?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <link rel="icon" href="logo1orig.png" sizes="32x32">


    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



     <!-- CSS-->
    <link href="css/prism.css" rel="stylesheet">
    <link href="css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
   
    <link href="css/css.css" rel="stylesheet" type="text/css">
    <link href="css/icon.css" rel="stylesheet">
    <style>
      
      .i 
      {   
          
          border: 1px solid black;
          margin: 6px;
        
      }
       .i2
      {   
          width: 5%;
          border: 1px solid black;
          margin: 6px;
        
      }
       .i3 
      {   
          width: 5%;
          border: 1px solid black;
          margin: 6px;
        
      }
     .i4
      {   
          width: 5%;
          border: 1px solid black;
          margin: 6px;
        
      }
       .i5 
      {   
          width: 5%;
          border: 1px solid black;
          margin: 6px;
        
      }
       .i6 
      {   
          width: 5%;
          border: 1px solid black;
          margin: 6px;
        
      }
       .i7 
      {   
         
          border: 1px solid black;
          
        
      }
    
      .ot p { text-indent: 25px; }
    </style>

  <title>PHP-book</title>
</head>
<body>
<header>
      <div class="container"><a href="#" data-target="nav-mobile" class="top-nav sidenav-trigger waves-effect waves-light circle hide-on-large-only"><i class="material-icons">menu</i></a></div>
      <ul id="nav-mobile" class="sidenav sidenav-fixed" >
      
        
        <li class="logo">
          <a id="logo-container" href="/" class="brand-logo">
            <object id="front-page-logo" type="image/svg+xml" data="logo1orig.svg">Your browser does not support SVG</object>
          </a> 
        </li>
        
       
        

        <ul class="collapsible collapsible-accordion">


        <?php
        

        
        $res=mysqli_query($con, "SELECT * FROM `tags`");


          while( ($ress = mysqli_fetch_assoc($res)) )
          { if(($_GET['id_tags'])==$ress['id'])
            {
             echo '<li class="bold active"><a href="?&id_tags='.$ress['id'].'" class="collapsible-header waves-effect waves-teal">'.$ress['name'].'</a></li> ';
            } 
            else
            {
            echo '<li class="bold"><a href="?&id_tags='.$ress['id'].'" class="collapsible-header waves-effect waves-teal">'.$ress['name'].'</a></li> '; 
            }
          }
            if(($_SESSION['lvl'])==1)
            {
                echo '<li class="bold"><a href="?&cdt=1" class="collapsible-header waves-effect waves-teal"> ТЕСТ </a></li> ';  
            }
          ?>



    <!--


    update_tag         <span data-badge-caption="updated" class="new badge"></span>


    -->



        
      </header>
  
    <main>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
          <div class="row center">
        
            <div class="col s12 m10 offset-m1">
              <?php 
                if((($_GET['id_tags'])!=0) && (($_GET['cdt'])==0) )
                      {
                      $idt= $_GET['id_tags'];
                      $resn=mysqli_query($con, "SELECT * FROM `tags` WHERE `id`=$idt ");
                      $resname=mysqli_fetch_assoc($resn);
                      echo '<h1 class="header">'. $resname['name'] .'</h1>';
                      }
                       elseif(($_GET['cdt'])==0)
                       {
                        echo '<h1 class="header"> Содержание </h1> ';
                        
                       }
                if(($_GET['cdt'])==1)
                  {
                    echo '<h1 class="header"> Тест </h1> ';
                  } 
                elseif(($_GET['cdt'])==2)   
                  {
                    
                  }elseif(($_GET['cdt'])==3)   
                  {
                    echo '<h1 class="header"> Профиль </h1>';
                  }  elseif(($_GET['cdt'])==4)   
                  {
                    echo '<h1 class="header"> Панель управления </h1>';
                  }  


              ?>
                        
            </div>
          </div>
        </div>
    </div>
     
     <?php

     
        if((($_SESSION['online'])==0) ) 
    {
        echo '  <div class="row center"> <br>
        <a href="/reg" class="btn waves-effect">Регистрация</a> 
        <a href="/log" class="btn waves-effect">Вход</a>
        </div> 
                      ';
    } 
    
    
    if((($_SESSION['online'])==1) and (($_GET['id_tags'])==0) and (($_GET['cdt'])==0) )
    {  
        
        if($_SESSION['lvl']==5)
        {
        $admin='<a href=admin/?&users=1 class="btn waves-effect" >админ панель</a>
        <a href="/lib" class="btn waves-effect" >редактор глав</a>';
            
        }
        
        
        
        echo '    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
          <div class="row center">
            <div class="col s12 m10 offset-m1">
      
    <h6> Вы вошли как: '. $_SESSION['login'] .' </h6> <a href="?&cdt=3" class="btn waves-effect">профиль</a> <a href="lout/index.php" class="btn waves-effect">Выход</a>
       '.$admin.' 
            </div>
          </div>
        </div>
    </div> 
        ';
    }              
?>

    <?php 
    if(($_GET['id_tags'])!=0 )
    {
        echo '<div class="row" style="width: 80%">';
    } 
    else
    {
        echo '<div style="width: 100%">';
    }
    ?>
      <div class="col s12 m9 l10">
        <?php      
          if(($_GET['id_tags'])!=0 && (($_GET['cdt'])==0)  )
            {
              $idtg= $_GET['id_tags'];
              $res1=mysqli_query($con, "SELECT * FROM `id_tags` WHERE `id_tags` = $idtg  ");
              while( ($ress1 = mysqli_fetch_assoc($res1)) )
               {
                  echo '<div id="'.$ress1['id'].'" class="section scrollspy ot">';
                  echo ' <h3 class="header"> '.$ress1['name'] .'</h3>';
                  echo ' <p class="caption"> '. $ress1['text']   .'</p>';
                  echo '</div> ';
                }
            } 
            elseif(($_GET['cdt'])==0)  
            {
                $res0=mysqli_query($con, "SELECT * FROM `tags`");

                echo '<ul class="collapsible expandable">';
                while( ($ress0 = mysqli_fetch_assoc($res0)) )
                { 
               
                
                echo '<li class="active"> <div class="collapsible-header waves-effect"> <i class="material-icons">label</i>'.$ress0['name'].'</div> <div class="collapsible-body">';
                echo '<ul class="collapsible">';
                $qq1=$ress0['id'];
                $q1=mysqli_query($con, "SELECT `name`,`id` FROM `id_tags` WHERE `id_tags` = $qq1  ");
                while( ($qr = mysqli_fetch_assoc($q1)) )
                echo '<li><div class=""><a class="collapsible-header waves-effect " href="?&id_tags='.$qq1.'&#38;&#35;'.$qr['id'].'"  > <i class="material-icons">label_important</i>'.$qr['name'].'</a><div></li>';
                
                
                
                echo '</ul></div></li> '; 
                }
                
            }
            
           
             if((($_GET['cdt'])==1) and (($_SESSION['lvl'])==1) and (isset($_POST['1'])))
            
            {   
              $q_count_test=mysqli_query($con, "SELECT COUNT(*) AS 'count' FROM `test`");
              $q_num_id_test=mysqli_query($con, "SELECT * FROM `test`");
              
              $count_test = mysqli_fetch_assoc($q_count_test);
             $login=$_SESSION['login'];
                $result=0;
                 $dres='';
                for($i = 1; $i <= $count_test['count']; $i++)
                { $num=mysqli_fetch_assoc($q_num_id_test);
                    $ii=$num['id'];
                    $dres.= '['.$i.']'.'='.$_POST[$ii].';';
                    if( ($_POST[$ii])==1) 
                    {
                        $result++;
                    }
                    
                    
                }
                
                
                
                
                $_SESSION['result']=$result;
                $result=($result/$count_test['count']*100);
                
                
                 if($result<30){ $point=2;}
                if(($result<=50) and ($_SESSION['result']>30) ){ $point=3;}
                if(($result>50) and ($_SESSION['result']<80)){ $point=4;}
                if(($result>=80) ){ $point=5;}
            $query=mysqli_query($con, "INSERT INTO `result` ( `login`, `result`, `average`,`res`) VALUES ( '$login', '$dres', '$result', '$point')");
 
          
       
                echo '<div class="section no-pad-bot" id="index-banner">
        <div class="container">
          <div class="row center"> <h3> Результат: '.$_SESSION['result']. ' из '.$count_test['count'].'. Оценка: '.$point .'</h3></div> <a class= </div> </div> ';
              
                   
            }
            
      
            if((($_GET['cdt'])==1) and (($_SESSION['lvl'])==1) and (!isset($_POST['1']))  )
            {   
                $login=$_SESSION['login']; 
                $query_count_test=mysqli_query($con, "SELECT COUNT(*) AS 'count' FROM `result` WHERE `login`='$login'");
                $count_test_l = mysqli_fetch_assoc($query_count_test);
                if(($count_test_l['count'])==0){
                    
                        
                         
                echo' <div class="container"><div class="row"> <div class="col s12 m9 l10">
                <form name="test" method="POST">';
                $login=$_SESSION['login'];
                $log="Пользователь сдает тест";
            $queryl=mysqli_query($con,"INSERT INTO `logs` (log,login) VALUES ('$log','$login')");
            
              $q_test=mysqli_query($con, "SELECT * FROM `test`");
              while( ($d_test = mysqli_fetch_assoc($q_test)) )
                {   
                    $tr_t[$d_test['id']]=$d_test['1'];
                }
              $q_test=mysqli_query($con, "SELECT * FROM `test`");
              while( ($d_test = mysqli_fetch_assoc($q_test)) )
              {         
                    $values=array(1 => 1  ,   2 => 1 , 3 => 1 , 4 => 1   );
                 
                      $values[1] = rand(1,4);
                     while(($values[1])==($values[2]))
                     { 
                         $values[2] = rand(1,4);
                         
                     }
                     while((($values[1])==($values[3])) or (($values[2])==($values[3])) ) 
                     {
                         $values[3] = rand(1,4);
                     }
                     while((($values[1])==($values[4])) or (($values[2])==($values[4])) or (($values[3])==($values[4])) ) 
                     { 
                         $values[4] = rand(1,4);
                     }
                     
                  
                  
                  
                  
                  echo '
                        
                        
                        <h5> '.$d_test['quest'].' </h5>
                       
                        <p>
                        <label>
                        <input class="with-gap" name="'.$d_test['id'].'" type="radio" value="'.$values[1].'" required/>
                        <span>'.$d_test[$values[1]].'</span>
                        </label>
                        </p>
                        <p>
                        <label>
                        <input class="with-gap" name="'.$d_test['id'].'" type="radio" value="'.$values[2].'" />
                        <span>'.$d_test[$values[2]].'</span>
                        </label>
                        </p>
                        <p>
                        <label>
                        <input class="with-gap" name="'.$d_test['id'].'" type="radio" value="'.$values[3].'" />
                        <span>'.$d_test[$values[3]].'</span>
                        </label>
                        </p>
                        <p>
                        <label>
                        <input class="with-gap" name="'.$d_test['id'].'" type="radio" value="'.$values[4].'" />
                        <span>'.$d_test[$values[4]].'</span>
                        </label>
                        </p>
                  
                        
                  
                  
                  
                  
                 
                  <hr>
                  ';
                  
                  
              }
              
              
              
              
              echo'<button class="btn waves-effect" type="submit"> Готово! </button>
              
              </div> </div></div> </form>';
             
            } else 
            
            {
                 $login=$_SESSION['login']; 
                $query_count_test=mysqli_query($con, "SELECT * FROM `result` WHERE `login`='$login'");
                $count_test_l = mysqli_fetch_assoc($query_count_test);
                echo '<div class="section no-pad-bot" id="index-banner">
        <div class="container">
          <div class="row center">
          <h3> Результат: '.$count_test_l['average']. '%. Оценка: '.$count_test_l['res'].'</h3>
          </div> <a class= </div> </div> ';
              
                  
                
            }
    
            }
            
            
            
            
            if((($_GET['cdt'])==3) and (($_GET['id_tags'])==0) )
            {
              include_once 'cab/index.php';
            }
            if((($_GET['cdt'])==4) and (($_GET['id_tags'])==0) )
            {
              include_once 'admin/index.php';
             
            }
             if((($_GET['cdt'])==5) and (($_GET['id_tags'])==0) )
            {
              include_once 'lib.php';
             
            }






        ?>
       
      </div>
   


      

























































    

  

      <div class=" hide-on-small-only " style=" position: fixed; right: 10px;top: 25%;">
          <ul class="section table-of-contents">
            <?php 
            if(($_GET['id_tags'])!=0 )
              {
              $idtg1= $_GET['id_tags'];
     
              $res2=mysqli_query($con, "SELECT * FROM `id_tags` WHERE `id_tags` = $idtg1  ");
              while( ($ress2 = mysqli_fetch_assoc($res2)) )
                {  
                  echo '<li><a href="#'.$ress2['id'] .'" class="">'. $ress2['name'] .'</a></li>';
                }
              }
            ?>
          </ul>
          
      </div> 
    <script>
      $(document).ready(function(){
      $('.scrollspy').scrollSpy();
      });       
    </script>

  </div> 
</main>
    <!--  Scripts-->
    <script async="" type="text/javascript" src="js/carbon.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script>if (!window.jQuery) { document.write('<script src="bin/jquery-3.2.1.min.js"><\/script>'); }
    </script>
    <script src="js/jquery.timeago.min.js"></script>
    <script src="js/prism.js"></script>
    <script src="js/lunr.min.js"></script>
    <script src="js/search.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
   
  

    </body>
  </html>