  <div class="section no-pad-bot" id="index-banner">
        <div class="container">
          <div class="row center">
            <div class="col s12 m10 offset-m1">

                <?php
                 $profile_login=$_SESSION['login'];
                 $profile_query=mysqli_query($con,"SELECT * FROM `users` WHERE `login`='$profile_login'");
                 $profile_data=(mysqli_fetch_assoc($profile_query));
                
                
                
               
               if($profile_data['password']==(md5(md5($_POST['password']))))
               { 
                   
                   if($_GET['ps']!=1)
                    {
                        
                    $newfname=htmlspecialchars($_POST['fname']);
                    $newlname=htmlspecialchars($_POST['lname']);
                    
                    $newfname=mysqli_real_escape_string($con,$newfname);
                    $newlname=mysqli_real_escape_string($con,$newlname);
                    
                    
                    
                    mysqli_query($con,"UPDATE `users` SET `fname` = '$newfname', `lname` = '$newlname' WHERE `users`.`login` = '$profile_login' ");
                    
                    
                    
                    
                    
                    $profile_login=$_SESSION['login'];
                    $profile_query=mysqli_query($con,"SELECT * FROM `users` WHERE `login`='$profile_login'");
                    $profile_data=(mysqli_fetch_assoc($profile_query));
                    }
                    else
                    {
                        if( ((isset($_POST['password1'])) and (isset($_POST['password2']))) and  (($_POST['password1']) == ($_POST['password2']))   )
                        { 
                            $newpass=(md5(md5($_POST['password1'])));
                            mysqli_query($con,"UPDATE `users` SET  `password`='$newpass' WHERE `users`.`login` = '$profile_login'      ");
                            $msg="Успех!";
                        } else $msg="Ошибка!";
                       
                    
                    }
                 
               }
               
                  ?>           
                
                <? if($_GET['upd']!=1) echo '<a class="btn waves-effect" href="?&cdt=3&upd=1" >Редактировать</a> ';  ?> 
                <? if($_GET['upd']!=1) echo '<a class="btn waves-effect" href="?&cdt=3&upd=1&ps=1" >Изменить пароль</a> ';  ?>
               <? if($_GET['upd']!=0) echo ' <a class="btn waves-effect" href="?&cdt=3" >Отмена</a>';  ?> 
       <form method="POST"> 
       <?
       if($_GET['upd']!=1)
       {
       $rdonly="readonly";
       }
       
       
       if($_GET['ps']!=1)
       { 
        echo '
        
         <div class="input-field">
        <input type="text" name="fname" minlength="2"  maxlength="15" class="form-control"   value="'.$profile_data['fname'] .'"  '.$rdonly.' required> 
        <label for="input_text">Имя</label>
        </div>
        
        ';
        echo '
         <div class="input-field">
        <input type="text" name="lname" minlength="2" maxlength="15" class="form-control" value="'.$profile_data['lname'] .'"  '.$rdonly.' required>  
        <label for="input_text">Фамилия</label>
        </div>
   ';
       } 
       else
       { echo $msg;
          $oldp="старый "; 
        echo ' 
         <div class="input-field">
         <input type="password" name="password1"    minlength="5" class="form-control" required>
      
        <label for="input_text">новый пароль</label>
        </div>';
        
          echo '
          <div class="input-field">
          <input type="password" name="password2"    minlength="5" class="form-control" required>
          
        <label for="input_text">повторите пароль</label>
        </div>
          
          
          
          
          
          ';
         
           
           
       }
       
       
       
       ?>
       <? if($_GET['upd']==1) echo '
       
       <div class="input-field">
       
       
       
       <input type="password" name="password" class="form-control" required> <button class="btn waves-effect" type="submit" >Изменить</button> 
       <label for="input_text">'. $oldp.'пароль</label>
        </div>
       
       ';      ?>  
        </form>
      
               
               
      
    
            </div>
          </div>
        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
