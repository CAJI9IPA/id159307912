<?php
session_start();
include_once 'connect.php';

echo $_SESSION['reg'] .'<br>';
echo $_SESSION['reg_login'].'<br>';
echo $_SESSION['reg_password'].'<br>';
echo $_SESSION['reg_phone'].'<br>';
echo $_SESSION['reg_email'].'<br>';
echo $_SESSION['reg_lname'].'<br>';
echo $_SESSION['reg_fname'].'<br>';
echo $_SESSION['reg_bdate'].'<br>';
echo $_SESSION['logerror'].'<br>';
echo $_SESSION['deleted'].'<br>';
?>







<?php 
if ($_SESSION['online']==1)
{
    echo '
    <form action="logout.php" method="post">
    <input type="submit" value="Выход">
    </form>
    
    <form action="create.php" method="post">
    <input type="text" name="fname" placeholder="Введите Фамилию" required>
    <input type="text" name="lname" placeholder="Введите Имя" required>
     <input type="text" name="bdate" placeholder="Укажите дату рождения" required>
    <input type="text" name="phone" placeholder="Укажите телефон" required>
    
    <input type="text" name="email" placeholder="Укажите e-mail" required>
    <input type="text" name="login" placeholder="Логин" required>
    <input type="text" name="password" placeholder="Пароль" required> 
    <input type="submit" value="Зарегистрировать">
    </form>';



    $query=mysqli_query($con,"SELECT * FROM `users`");

echo '<form action="delete.php" method="post">
        <table border = "1">';
    while( ($array = mysqli_fetch_assoc( $query)) )
{   
    echo '<tr> <td>'.$array['fname'].'</td><td>' .$array['lname'].'</td> <td>'.$array['np'].'</td>
    <td>'.$array['login'].'</td><td>'.$array['password'].'</td><td>'.$array['ip_when_create'].'</td><td>'.$array['groups'].'</td><td> <input type="radio" name="id" value="'.$array['id'].'"></td></tr>';


} 
echo '</table> <input type="submit" value="удалить"></form>';



}
elseif ($_SESSION['online']==0)
{
    echo '<form action="login.php" method="post">
    <input type="text" name="login" placeholder="Введите логин " required>
    <input type="text" name="password" placeholder="Введите пароль " required>
    <input type="submit" value="Отправить">
    </form>';
}







?>