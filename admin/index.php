<!DOCTYPE html>
<html lang="ru">
<?php
include_once '../connect.php';
session_start();

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
  <title>Админ-панель</title>
      
  </head>
  
   
<a style="margin: 10px" href="/" class="btn waves-effect">Назад</a> 
<a style="float: right; margin: 10px" class="btn waves-effect" href="?&color=1" >Цвета  <? echo $color_mark ;  ?></a>       
 
 
  
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
          <div class="row center">
        
            

         
         
                
                <?php
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
                    
                    
                    header ('Location: /admin/?&users=1');
                }
                
                if(($_GET['unload'])!=0)
                { $unload_id=$_GET['unload'];
                $qqc=mysqli_query($con,"SELECT * FROM `result` WHERE `id`='$unload_id'");
                
                $res_log=mysqli_fetch_assoc($qqc);
                $ll= $res_log['login'];
                $rslt= $res_log['result'];
                $rres= $res_log['res'];
                $avrg= $res_log['average'];
                   $qc=mysqli_query($con,"INSERT INTO `result_log` (`login`, `result`, `res`, `average`) VALUES ('$ll', '$rslt', '$rres','$avrg')");
                   
                   if($qc) {
                       $qqc=mysqli_query($con,"DELETE FROM `result` WHERE `id`='$unload_id'");
                   header ('Location: /admin/?&test_result=1');
                   }
                }
                
                
                if($profile_data['lvl']==5)
                {  #$color= array("red","pink","purple","deep-purple","indigo","blue","green","lime","yellow","deep-orange","brown");
                    
                    echo ' <a class="btn waves-effect" href="?&users=1" >Пользователи</a>
                    <a class="btn waves-effect" href="?&test_result=1" >Результаты теста</a>
                    <a class="btn waves-effect" href="?&logs=all" >История сервера</a> 
                    <a class="btn waves-effect" href="?&result_log=1" >История результатов</a>
                    <a class="btn waves-effect" href="?&updtest=1" >Редактор теста</a>';
                  
                    
                    
                    if(( (($_POST['fname'])!="") and (($_POST['lname'])!="") and (($_POST['np'])!="") and  (($_POST['lvl'])!="")  ))
                    {   
                        $id=$_GET['rd'];
                        $newfn=$_POST['fname'];
                        $newln=$_POST['lname'];
                        $newnp=$_POST['np'];
                        $newlvl=$_POST['lvl'];
                        $query=mysqli_query($con,"UPDATE `users` SET  `fname`='$newfn',`lname`='$newln',`np`='$newnp',`lvl`='$newlvl'  WHERE `users`.`id` = '$id'      ");
                        
                    }
                    
                  if(($_GET['logs'])!=0) 
                  {    
                      if(($_GET['logs'])!="all"){
                      $rc=rand(0,11);
                      $id=$_GET['logs'];
                      $qlog=mysqli_query($con,"SELECT `login` FROM `users` WHERE `id`='$id' ORDER BY id DESC LIMIT 0,10");
                      $qlogin=mysqli_fetch_assoc($qlog);
                       $qlogindata= $qlogin['login'];
                       $query=mysqli_query($con,"SELECT * FROM `logs` WHERE `login`='$qlogindata' ORDER BY id DESC LIMIT 0,10");
                       echo '<div class="card-panel">
                              
                                <table> 
                                <thead>
                                
                                <th class="i '. $color[$rc]. ' lighten-4">время</th>
                                <th class="i '. $color[$rc]. ' lighten-4" >логин</th>
                                <th class="i '. $color[$rc]. ' lighten-4">действие</th>
                                </thead>'; 
                       
                       while( ($log_data = mysqli_fetch_assoc( $query)) )
                              {$rc=rand(0,11);
                                  echo '
                                
                                <tr>
                                
                                <td class="i '. $color[$rc]. ' lighten-4">'.$log_data['time'].'</td>
                                <td class="i '. $color[$rc]. ' lighten-4">'.$log_data['login'].'</td>
                                <td class="i '. $color[$rc]. ' lighten-4">'.$log_data['log'].'</td>
                                </tr>';   
                              }
                              
                              echo '</div></table>';
                          
                      }
                  }
                  if(($_GET['logs'])=="all"){
                      $query=mysqli_query($con,"SELECT * FROM `logs` ORDER BY id DESC");
                       echo '
                              
                                <table> 
                                <thead>
                                
                                <th class="i '. $color[$rc]. ' lighten-4">время</th>
                                <th class="i '. $color[$rc]. ' lighten-4" >логин</th>
                                <th class="i '. $color[$rc]. ' lighten-4">действие</th>
                                </thead>'; 
                       
                       while( ($log_data = mysqli_fetch_assoc( $query)) )
                              {$rc=rand(0,11);
                                  echo '
                                
                                <tr>
                                
                                <td class="i '. $color[$rc]. ' lighten-4">'.$log_data['time'].'</td>
                                <td class="i '. $color[$rc]. ' lighten-4">'.$log_data['login'].'</td>
                                <td class="i '. $color[$rc]. ' lighten-4">'.$log_data['log'].'</td>
                                </tr>';   
                              }
                              
                              echo '</table>';
                      }
                  
                  if(($_GET['del'])!=0)
                  { 
                      $id=$_GET['del'];
                     
                   echo'<hr>  <a class="btn waves-effect" href="?&del='.$id.'&accept=1">подтвердить удаление</a>';
                     
                     if(($_GET['accept'])==1)
                     {
                      $query=mysqli_query($con,"DELETE FROM `users` WHERE `users`.`id` = '$id'");
                      header ('Location: /admin/?&users=1');
                     }
                      
                      
                  }
                    
                    
                  if(($_GET['rd'])!=0)
                    {   $rc=rand(0,11);
                        $id=$_GET['rd'];
                        $query=mysqli_query($con,"SELECT * FROM `users` WHERE `id`='$id' ");
                        $profile_data=(mysqli_fetch_assoc($query));
                        echo '<div class="col s12 m10 offset-m1">
                        <hr>
                        <form method="POST"> 
                        <table>
                         <thead>
                              <th class="i '. $color[$rc]. '  lighten-4">id           </th>
                              <th class="i '. $color[$rc]. ' lighten-4">login         </th>
                              <th class="i '. $color[$rc]. '  lighten-4">Имя          </th>
                              <th class="i '. $color[$rc]. ' lighten-4">Фамилия       </th>
                              <th class="i '. $color[$rc]. '  lighten-4">Телефон      </th>
                              <th class="i '. $color[$rc]. ' lighten-4">Уровень       </th>
                              <th class="i '. $color[$rc]. '  lighten-4">дата создания</th>
                              <th class="i '. $color[$rc]. '  lighten-4">группа</th>
                              <th class="i '. $color[$rc]. '  lighten-4">ip при регистрации</th>
                              
                              </thead>
                        <thead>
                              <th class="i '. $color[$rc]. '  lighten-4">'.$profile_data['id'].'</td>
                              <th class="i '. $color[$rc]. ' lighten-4">'.$profile_data['login'].'</td>
                              <th class="i '. $color[$rc]. '  lighten-4"><input type="text" name="fname"    minlength="2" class="form-control" placeholder="имя" value="'.$profile_data['fname'] .'"   required></td>
                              <th class="i '. $color[$rc]. ' lighten-4"><input type="text" name="lname"    minlength="2" class="form-control" placeholder="фамилия" value="'.$profile_data['lname'] .'"   required></td>
                              <th class="i '. $color[$rc]. '  lighten-4"><input type="text" name="np"    minlength="2" class="form-control" placeholder="телефон" value="'.$profile_data['np'] .'"   required></td>
                              <th class="i '. $color[$rc]. ' lighten-4"><input type="text" name="lvl"    minlength="2" class="form-control" placeholder="уровень" value="'.$profile_data['lvl'] .'"   required></td>
                              <th class="i '. $color[$rc]. '  lighten-4">'.$profile_data['create_date'].'</td>
                              <th class="i '. $color[$rc]. '  lighten-4">'.$profile_data['groups'].'</th>
                              <th class="i '. $color[$rc]. '  lighten-4">'.$profile_data['ip_when_create'].'</th>
                              </thead>
                        </table>
                        <hr>
                        <button class="btn waves-effect" href="?&rd='.$id.'&accept=1 " type="submit" >Изменить</button>
                        </form>
                        </div>
                        ';
                        
                    }
                    
                    
                  if(($_GET['users'])==1)
                {   $rc=rand(0,11);
                   if(isset($_GET['updlvl']))
                   {    $userid=$_GET['updlvl'];
                       $qupdlvl=mysqli_query($con,"UPDATE `users` SET `lvl` = '1' WHERE `users`.`id` ='$userid'");
                       header ('Location: /admin/?&users=1');
                   }
                 $query=mysqli_query($con,"SELECT * FROM `users` ORDER BY id DESC");

                    echo  ' 
                            <table>
                            <thead>
                              <th class="i '. $color[$rc]. '  lighten-4">id           </th>
                              <th class="i '. $color[$rc]. ' lighten-4">login         </th>
                              <th class="i '. $color[$rc]. '  lighten-4">Имя          </th>
                              <th class="i '. $color[$rc]. ' lighten-4">Фамилия       </th>
                              <th class="i '. $color[$rc]. '  lighten-4">Телефон      </th>
                              <th class="i '. $color[$rc]. ' lighten-4">Уровень       </th>
                              <th class="i '. $color[$rc]. '  lighten-4">дата создания</th>
                              <th class="i '. $color[$rc]. '  lighten-4">группа</th>
                              <th class="i '. $color[$rc]. '  lighten-4">ip при регистрации</th>
                              <th class="i '. $color[$rc]. ' lighten-4">#             </th>
                              <th class="i '. $color[$rc]. '  lighten-4">#            </th>
                              <th class="i '. $color[$rc]. ' lighten-4">#             </th>
                              </thead>
                              
                              ';
                              
                              while( ($data = mysqli_fetch_assoc( $query)) )
                              { $rc=rand(0,11);
                                    if($data['lvl']==0){ $updlvl='<a class="btn waves-effect" href="?&users=1&updlvl='.$data['id'].'"> #</a>';} else {$updlvl='';}
                                  echo '<tr>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['id'] .'         </td>
                              <td class="   i  '. $color[$rc]. ' lighten-4">' .$data['login'].'       </td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['fname'] .'      </td>
                              <td class="   i  '. $color[$rc]. ' lighten-4">' .$data['lname'] .'      </td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['np'] .'         </td>
                              <td class="   i  '. $color[$rc]. ' lighten-4">' .$data['lvl'] .' '.$updlvl.'       </td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['create_date'] .'</td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['groups'] .'</td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['ip_when_create'] .'</td>
                              <td class="   i  '. $color[$rc]. ' lighten-4"><a href=?&rd='.$data['id'].' class="btn waves-effect">изменить</a></td>
                              <td class="   i  '. $color[$rc]. '  lighten-4"><a href=?&logs='.$data['id'].' class="btn waves-effect">история</a></td>
                              <td class="   i  '. $color[$rc]. ' lighten-4"><a href=?&del='.$data['id'].' class="btn waves-effect">удалить</a></td>
                              </tr>';
                                  
             
                              } 
                              
                              
                              
                              
                              
                              
                              
                              
                    echo  ' </table>';
                }
                    
                    if(($_GET['test_result'])==1)
                {   $rc=rand(0,11);
                

                    echo  ' 
                            <table>
                            <thead>
                              <th class="i '. $color[$rc]. '  lighten-4">id           </th>
                              <th class="i '. $color[$rc]. ' lighten-4">login         </th>
                              <th class="i '. $color[$rc]. '  lighten-4">Имя          </th>
                              <th class="i '. $color[$rc]. ' lighten-4">Фамилия       </th>
                              <th class="i '. $color[$rc]. '  lighten-4">введённые ответы     </th>
                              <th class="i '. $color[$rc]. ' lighten-4">оценка </th>
                              <th class="i '. $color[$rc]. '  lighten-4">процент правильных ответов</th>
                              <th class="i '. $color[$rc]. '  lighten-4">время сдачи</th>
                              <th class="i '. $color[$rc]. ' lighten-4">#             </th>

                              </thead>
                              
                              ';
                              $query=mysqli_query($con,"SELECT * FROM `result` ORDER BY id DESC");
                              while( ($data = mysqli_fetch_assoc( $query)) )
                              {   
                                  $data_l=$data['login'];
                                  $data_pq=mysqli_query($con,"SELECT `fname`,`lname` FROM `users` WHERE `login`='$data_l' ");
                                    $data_p=mysqli_fetch_assoc( $data_pq);
                                  $rc=rand(0,11);
                                    
                                  echo '<tr>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['id'] .'         </td>
                              <td class="   i  '. $color[$rc]. ' lighten-4">' .$data['login'].'       </td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data_p['fname'] .'      </td>
                              <td class="   i  '. $color[$rc]. ' lighten-4">' .$data_p['lname'] .'      </td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['result'] .'         </td>
                              <td class="   i  '. $color[$rc]. ' lighten-4">' .$data['res'] .'        </td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['average'] .'</td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['date_time'] .'</td>
                              <td class="   i  '. $color[$rc]. ' lighten-4"><a href=?&unload='.$data['id'].' class="btn waves-effect">Пересдать</a></td>
                              </tr>';
                                  
             
                              } 
                              
                              
                              
                              
                              
                              
                              
                              
                    echo  ' </table> ';
                } 
                if(($_GET['result_log'])==1)
                {   $rc=rand(0,11);
                

                    echo  ' 
                            <table>
                            <thead>
                              <th class="i '. $color[$rc]. '  lighten-4">id           </th>
                              <th class="i '. $color[$rc]. ' lighten-4">login         </th>
                              <th class="i '. $color[$rc]. '  lighten-4">Имя          </th>
                              <th class="i '. $color[$rc]. ' lighten-4">Фамилия       </th>
                              <th class="i '. $color[$rc]. '  lighten-4">введённые ответы     </th>
                              <th class="i '. $color[$rc]. ' lighten-4">оценка </th>
                              <th class="i '. $color[$rc]. '  lighten-4">процент правильных ответов</th>
                              <th class="i '. $color[$rc]. '  lighten-4">время сдачи</th>
                             

                              </thead>
                              
                              ';
                              $query=mysqli_query($con,"SELECT * FROM `result_log` ORDER BY id DESC");
                              while( ($data = mysqli_fetch_assoc( $query)) )
                              {   
                                  $data_l=$data['login'];
                                  $data_pq=mysqli_query($con,"SELECT `fname`,`lname` FROM `users` WHERE `login`='$data_l' ");
                                    $data_p=mysqli_fetch_assoc( $data_pq);
                                  $rc=rand(0,11);
                                    
                                  echo '<tr>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['id'] .'         </td>
                              <td class="   i  '. $color[$rc]. ' lighten-4">' .$data['login'].'       </td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data_p['fname'] .'      </td>
                              <td class="   i  '. $color[$rc]. ' lighten-4">' .$data_p['lname'] .'      </td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['result'] .'         </td>
                              <td class="   i  '. $color[$rc]. ' lighten-4">' .$data['res'] .'        </td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['average'] .'</td>
                              <td class="   i  '. $color[$rc]. '  lighten-4">'.$data['date_time'] .'</td>
                              </tr>';
                                  
             
                              } 
                              
                              
                              
                              
                              
                              
                              
                              
                    echo  ' </table> ';
                } 
                
                if( ( ($_GET['updtest'])==1) and (isset($_POST['btn']) ) )
                {
                    
                    $query_ct=mysqli_query($con, "SELECT COUNT(*) AS 'count' FROM `test`");
                    $query1=mysqli_query($con, "SELECT * FROM `test`");
                    $count_td = mysqli_fetch_assoc($query_ct);
                    for($i=1;$i<=$count_td['count'];$i++)
                    {    
                        
                        $qdate= mysqli_fetch_assoc($query1);
                        $qid=$qdate['id'];
                        $iqst='quest_'.$qid;
                        $quest=$_POST[$iqst];
                        $iv1='v1_'.$qid;
                        $iv2='v2_'.$qid;
                        $iv3='v3_'.$qid;
                        $iv4='v4_'.$qid;
                        $v1=$_POST[$iv1];
                        $v2=$_POST[$iv2];
                        $v3=$_POST[$iv3];
                        $v4=$_POST[$iv4];
                        
                        
                         $query_ct=mysqli_query($con, "UPDATE `test` SET `quest` = '$quest', `1` = '$v1',`2` = '$v2',`3` = '$v3',`4` = '$v4' WHERE `test`.`id` = '$qid'");
                        
                    }
                    
                    if($query_ct)
                    {
                       header ('Location: /admin/?&updtest=1'); 
                       $message='<h3> Успешно </h3>';
                    }
                    
                    
                    
                    
                    
                    
                }
                
                if((($_GET['updtest'])==1) and (($_GET['ctest'])==1))
                {
                    $query=mysqli_query($con,"INSERT INTO `test` ( `1`, `2`, `3`, `4`, `quest`) VALUES ('a', 'b', 'c', 'd', 'quest')");
                    
                    if($query) { header ('Location: /admin/?&updtest=1'); } 
                    
                }
                if((($_GET['updtest'])==1) and (($_GET['ctest'])==2))
                {
                    $query=mysqli_query($con,"SELECT * FROM `test` ORDER BY `id` DESC");
                    $query_id=mysqli_fetch_assoc($query);
                    $q_id=$query_id['id'];
                    $query1=mysqli_query($con,"DELETE FROM `test` WHERE `test`.`id` = '$q_id'");
                    if($query1){ header ('Location: /admin/?&updtest=1'); }
                    
                }
                
                
                if(($_GET['updtest'])==1)
                {
                     $query=mysqli_query($con,"SELECT * FROM `test`");
                     
                     echo '<div class="card-panel '. $color[$rc]. '  lighten-5"> <form method="POST"> 
                     
                            '.$message.'
                     
                     '; $message='';
                                
                              while( ($data = mysqli_fetch_assoc( $query)) )
                              { $rc=rand(0,11);
                                  
                                  
                                  
                                  echo '  <div class="card-panel '. $color[$rc]. '  lighten-5">
                                        <div class="input-field">
        
                         <input type="text" id="textarea2"     name="quest_'.$data['id'].'"    class="materialize-textarea" value="'.$data['quest'].'" required>
                         <label for="textarea2">Вопрос </label>
        
                                        </div>
                                        <div class="input-field">
        
                         <input type="text" id="textarea2"     name="v1_'.$data['id'].'"    class="materialize-textarea" data-length="120" value="'.$data['1'].'" required>
                         <label for="textarea2">Ответ 1 (верный) </label>
        
                                        </div>
                                        <div class="input-field">
        
                         <input type="text" id="textarea2"     name="v2_'.$data['id'].'"    class="materialize-textarea" data-length="120" value="'.$data['2'].'" required>
                         <label for="textarea2">Ответ 2  </label>
        
                                        </div>
                                        <div class="input-field">
        
                         <input type="text" id="textarea2"     name="v3_'.$data['id'].'"    class="materialize-textarea" data-length="120" value="'.$data['3'].'" required>
                         <label for="textarea2">Ответ 3  </label>
        
                                        </div>
                                        <div class="input-field">
        
                         <input type="text" id="textarea2"     name="v4_'.$data['id'].'"    class="materialize-textarea" data-length="120" value="'.$data['4'].'" required>
                         <label for="textarea2">Ответ 4 </label>
        
                                        </div>
                                        </div>
                                        
                                    ';
                              }
                              echo '<a class="btn waves-effect" href="?&updtest=1&ctest=2" >-1</a>
                              <button class="btn waves-effect" name="btn" value="1" type="submit">изменить</button> 
                              <a class="btn waves-effect" href="?&updtest=1&ctest=1" >+1</a>
                              </form> </div>';
                    
                    
                    
                    
                }
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                  
                  
                  
                    
                }
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                ?>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                  
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
   
  