<?php
session_start();
require "functions.php";

$email = $_POST['email'];
$password = $_POST['password'];


$user = get_user_by_email($email);


if(!empty($user)) {
	 set_flash_message("danger",
        "<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.");
	exit("<meta http-equiv='refresh' content='0; url= /page_register.php'>");
}


add_user($email, $password);


set_flash_message("success", "Регистрация прошло успешна");
exit("<meta http-equiv='refresh' content='0; url= /page_login.php'>");