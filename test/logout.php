<?php
session_start();

session_destroy();
header('Location: 4.php');

?>