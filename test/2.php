
<!-- 
1.	Создайте форму обратной связи. В форме должны присутствовать следующие поля:
- Имя
- Телефон
- E-mail
- Сообщение
Форма должна отправлять сообщение на почту prog@it-delta.ru
Форму оформить на свой вкус.
 -->


<?php

$fname = $_POST['fname'];
$email_sender = $_POST['email'];
$phone = $_POST['phone'];
$text = $_POST['text'];

$email_recipient= 'prog@it-delta.ru';

$send_text= "Имя:".$name.".  E-mail: ".$email_sender ." Телефон:  " .$phone .  $text  ;
echo $send_text;


if (mail($email_recipient , "Тест ", $send_text," From: ". $email_sender ))
 {     
     
    echo "<hr> сообщение успешно отправлено";
} else {
    echo "при отправке сообщения возникли ошибки";
}

?>


<form method="post">
<input type="text" name="fname" placeholder="Укажите имя" required>
<input type="text" name="phone" placeholder="Укажите телефон" required>

<input type="text" name="email" placeholder="Укажите e-mail" required>
<hr>
<textarea rows="10" cols="45" name="text"></textarea>

<input type="submit" value="Отправить">
</form>