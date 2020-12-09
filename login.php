<?php 
session_start();
require "functions.php";

$email = $_POST['email'];
$password = $_POST['password'];


$result = login($email, $password);

if($result == false) {
    set_flash_message('danger', 'Вы ввели неправильный Email или Пароль');
    exit("<meta http-equiv='refresh' content='0; url= /page_login.php'>");
}

set_flash_message('success', 'Здравствуйте ' );


exit("<meta http-equiv='refresh' content='0; url= /users.php'>");


?>