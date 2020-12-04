<?php 
session_start();

function get_user_by_email($email)
{
    //подключаемся к БД
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=tasks_db;", "root", "");

    //создаем запрос
    $sql = "SELECT * FROM ttest WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // возвращаем $user (то есть весь столбец "email" будет записан в $user)
    return $user;
};



function set_flash_message($name, $message) {

	$_SESSION[$name] = $message;

}

function add_user($email,$password) {
	$pdo = new PDO("mysql:host=localhost;port=3307;dbname=tasks_db;", "root", "");
	$sql = "INSERT INTO ttest (email,password) VALUES (:email,:password)";
	$statement = $pdo->prepare($sql);
	$statement->execute([
	"email" => $email,
	"password" => password_hash($password, PASSWORD_DEFAULT)

]);

return $pdo->lastInsertId();
}


function display_flash_message($name) {
    if (isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]);
    }
}



?>