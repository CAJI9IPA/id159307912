<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<?php
include_once '../connect.php';

 $profile_login=$_SESSION['login'];
 $profile_query=mysqli_query($con,"SELECT * FROM `users` WHERE `login`='$profile_login'");
 $profile_data=(mysqli_fetch_assoc($profile_query));
 
 if($profile_data['color']==1){
     $color_mark=' вкл';
 $color= array("red","pink","purple","deep-purple","indigo","blue","green","lime","yellow","deep-orange","brown");
    $rc=rand(0,11);  } else $color_mark='выкл';
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
     <title>Редактор глав</title>
    </head>
    
    
    <a style="margin: 10px" href="/" class="btn waves-effect">На главную</a> 
<a style="float: right; margin: 10px" class="btn waves-effect" href="?&color=1" >Цвета <? echo $color_mark ;  ?></a> 


    <div class="container">
          <div class="row center">
        
            <div class="col s12 m10 offset-m1">
              <h1 class="header">Редактор глав </h1>                        
            </div>
          </div>
        </div>
        
        
<?php
        
        
        
    if($profile_data['lvl']==5)
        { 
              if(($_GET['color'])==1)
                {
                    if(($profile_data['color'])==0)
                    {   
                        
                        $qc=mysqli_query($con,"UPDATE `users` SET  `color`='1' WHERE `users`.`login` = '$profile_login'      ");
                    }    
                    
                    if(($profile_data['color'])==1)
                    {   
                        
                        $qc=mysqli_query($con,"UPDATE `users` SET  `color`='0' WHERE `users`.`login` = '$profile_login'      ");
                    }    
                    
                    
                    header ('Location: /lib');
                }
            
            
            
            
            
            
            
            if($_POST['btn_tag']==1)
            {
                $id=$_GET['tag_edit'];
                $num=$_POST['num'];
                $name=$_POST['name'];
                $query=mysqli_query($con,"UPDATE `tags` SET `id` = '$num', `name` = '$name' WHERE `tags`.`id` = '$id'");
                if($query){ header ('Location: /lib/'); }
                
                
                
            }
             if($_GET['del_id_tags']!=0)
             {
                  $id=$_GET['del_id_tags'];
                 $query=mysqli_query($con,"DELETE FROM `id_tags` WHERE `id_tags`.`id` = '$id';");
                if($query){ header ('Location: /lib/'); }
                
                 
             }
              if($_GET['del_tag']!=0)
              {
                  $id=$_GET['del_tag'];
                 $query=mysqli_query($con,"DELETE FROM `tags` WHERE `tags`.`id` = '$id';");
                if($query){ header ('Location: /lib/'); }
                
                  
              }
            
            
            
            
            
            if($_GET['tag_edit']!=0)
            {   
                $id=$_GET['tag_edit'];
                $query=mysqli_query($con,"SELECT * FROM `tags` WHERE `id`='$id'");
                $data=mysqli_fetch_assoc($query);
               echo' <div class="container">
                     <div class="row center">
                     <a class="btn waves-effect" href="/lib">назад</a>
                     <div class="card-panel '. $color[$rc]. '  lighten-5">
               
               
               
               
                <form method="POST">
                    <div class="input-field">
        
                <input type="number" id="textarea2"     name="num"   class="materialize-textarea" value="'.$data['id'].'" required>
                <label for="textarea2">Номер главы</label>
        
                    </div>
                    <div class="input-field">
        
                <input type="text" id="textarea2"     name="name" data-length="120"   class="materialize-textarea" value="'.$data['name'].'" required>
                <label for="textarea2">Название главы </label>
        
                    </div>
                   
                   
                   <button class="btn waves-effect" name="btn_tag" value="1" type="submit">изменить</button> 
                    <a class="btn waves-effect" href="?&del_tag='.$data['id'].'" >удалить главу</a>                     
                </form>   
                
                
                </div>
                </div>
                </div>
                
                    ';
                
                
            }
           
             if($_POST['tool1']==1)
             {
                $id=$_GET['edit'];
                 
                $tool='</p><p class="caption ot">';
                $text=$_POST['text'].$tool;
                $text=mysqli_real_escape_string($con,$text); 
                $query=mysqli_query($con,"UPDATE `id_tags` SET `text` = '$text' WHERE `id_tags`.`id` = '$id'");  
             }
              if($_POST['tool2']==1)
             {
                $id=$_GET['edit'];
                 
                $tool='<pre class=" language-markup"><code class=" language-markup">';
                $text=$_POST['text'].$tool;
                $text=mysqli_real_escape_string($con,$text); 
                $query=mysqli_query($con,"UPDATE `id_tags` SET `text` = '$text' WHERE `id_tags`.`id` = '$id'");  
             }
              if($_POST['tool3']==1)
             {  $id=$_GET['edit'];
                
                $tool='</code></pre>';
                $text=$_POST['text'].$tool;
                $text=mysqli_real_escape_string($con,$text); 
                $query=mysqli_query($con,"UPDATE `id_tags` SET `text` = '$text' WHERE `id_tags`.`id` = '$id'"); 
                 
                 
             }
              if($_POST['tool4']==1)
             {
                $id=$_GET['edit'];
                 
                $tool='&#60;';
              
                $text=$_POST['text'].$tool;
                $text=mysqli_real_escape_string($con,$text); 
                $query=mysqli_query($con,"UPDATE `id_tags` SET `text` = '$text' WHERE `id_tags`.`id` = '$id'"); 
                 
                 
             }
              if($_POST['tool5']==1)
             {
                 $id=$_GET['edit'];
                 
                $tool='&#62;';
                
                $text=$_POST['text'].$tool;
                $text=mysqli_real_escape_string($con,$text); 
                $query=mysqli_query($con,"UPDATE `id_tags` SET `text` = '$text' WHERE `id_tags`.`id` = '$id'");  
                 
             }
             
             if($_POST['btn_id_tag']==1)
             {
                $id=$_GET['edit'];
                $name=$_POST['name'];
                $text=$_POST['text'];
                $text=mysqli_real_escape_string($con,$text);
                $query=mysqli_query($con,"UPDATE `id_tags` SET `text` = '$text',`name` = '$name' WHERE `id_tags`.`id` = '$id'"); 
                
             }
             
            
            
            if($_GET['edit']!=0)
            { 
                $id=$_GET['edit'];
                $query=mysqli_query($con,"SELECT * FROM `id_tags` WHERE `id`='$id'");
                $data=mysqli_fetch_assoc($query);
               echo' <div class="container">
                     <div class="row center">
                     <a class="btn waves-effect" href="/lib">назад</a>
                     <div class="card-panel '. $color[$rc]. '  lighten-5">
               
               
               
               
                <form method="POST">
                    <div class="input-field">
        
                <input type="number" id="textarea2"     name="id"   class="materialize-textarea" value="'.$data['id'].'" required>
                <label for="textarea2">Номер раздела</label>
        
                    </div>
                    <div class="input-field">
        
                <input type="text" id="textarea2"     name="name"    class="materialize-textarea" value="'.$data['name'].'" required>
                <label for="textarea2">Название раздела </label>
        
                    </div>
                     <div class="input-field">
        
                <textarea type="text" id="textarea1"     name="text"    class="materialize-textarea"  required>'.htmlentities($data['text'],ENT_NOQUOTES).'</textarea>
                <label for="textarea1">Содержание </label>
        
                    </div>
                   
                    <button class="btn waves-effect" name="tool1" value="1" >новый параграф</button>
                    <button class="btn waves-effect" name="tool2" value="1" >открыть код   </button>
                    <button class="btn waves-effect" name="tool3" value="1" >закрыть код   </button>
                    <button class="btn waves-effect" name="tool4" value="1" >&#60;         </button>
                    <button class="btn waves-effect" name="tool5" value="1" >&#62;         </button>
                   <hr>
                   
                   <button class="btn waves-effect" name="btn_id_tag" value="1" type="submit">изменить</button> 
                      <a class="btn waves-effect" href="?&del_id_tags='.$data['id'].'" >удалить раздел</a>                  
                </form>   
                
                
                </div>
                </div>
                </div>
                
                    ';
                 
                 
                 
                 
                 
                 
            }
             
            if($_GET['add']!=0)
            {
                $query=mysqli_query($con,"INSERT INTO `tags` (`name`) VALUES ('Новая глава')");
                if($query) { header ('Location: /lib/'); } 
            }
            
            
            
            if($_GET['add_id_tag']!=0)
            {
                $new_id_tag=$_GET['add_id_tag'];
                $query=mysqli_query($con,"INSERT INTO `id_tags` (`name`,`id_tags`) VALUES ('Новый раздел','$new_id_tag')");
                if($query) { header ('Location: /lib/'); } 
                
            }
            
            
            
            
            
            
            
            
            
           if((($_GET['tag_edit'])==0) and (($_GET['edit'])==0) and (($_GET['add'])==0))
           {
            echo'<div class="card-panel"> <ul class="collapsible expandable">';
          $query=mysqli_query($con,"SELECT * FROM `tags`") ; 
         while( $data=(mysqli_fetch_assoc($query)))
            {   
                $id=$data['id'];
                $query1=mysqli_query($con,"SELECT * FROM `id_tags` WHERE `id_tags`='$id'") ; 
                
                
            echo '<li class="active">
            <div class="collapsible-header waves-effect"> 
            <i class="material-icons">label</i>
            '.$data['name'].'
             <a style="margin-left: 20px" href="?&tag_edit='.$data['id'].'">
             
             
             <span class="new badge" data-badge-caption="редактировать"></span> 
             </a>
            </div>
            <div class="collapsible-body">
            
            <ul class="collapsible expandable">
            
                    ';
                   while( $data1=(mysqli_fetch_assoc($query1)))
            {
              echo  ' <div class>
              <a class="collapsible-header waves-effect" href="?&edit='.$data1['id'].'"> 
              <i class="material-icons">mode_edit</i>
              '.$data1['name'].'
              </a>
                </div>  ';
               
                
            }
                    
                 echo '</li>
                 
                 </ul>
                 <a class="btn waves-effect" href="?&add_id_tag='.$data['id'].'" >Добавить раздел</a>
                 </div>' ;  
                    
            
            }
            
            echo '</ul>
            <a class="btn waves-effect" href="?&add=1" >Добавить главу</a>
            </div>
            
            
            ' ; 
            
            
           }
            
            
            
            
            
            
            
            
            
            
            
            
            
        }
        ?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
         <!--  Scripts-->
    
    <script async="" type="text/javascript" src="<?php echo $url;  ?>/js/carbon.js"></script>
    <script src="<?php echo $url;  ?>/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $url;  ?>/js/jquery.timeago.min.js"></script>
    <script src="<?php echo $url;  ?>/js/prism.js"></script>
    <script src="<?php echo $url;  ?>/js/lunr.min.js"></script>
    <script src="<?php echo $url;  ?>/js/search.js"></script>
    <script src="<?php echo $url;  ?>/js/materialize.js"></script>
    <script src="<?php echo $url;  ?>/js/init.js"></script>
   
  

