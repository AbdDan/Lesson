<?php 
session_start();

function get_user_by_email($email)
{
    //подключаемся к БД
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=crud_db;", "root", "");

    //создаем запрос
    $sql = "SELECT * FROM products WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // возвращаем $user (то есть весь столбец "email" будет записан в $user)
    return $user;
};



function set_flash_message($name, $message) {

	$_SESSION[$name] = $message;

}

function add_user($email,$password,$role) {
	$pdo = new PDO("mysql:host=localhost;port=3307;dbname=crud_db;", "root", "");
	$sql = "INSERT INTO products (email,password,role) VALUES (:email,:password,:role)";
	$statement = $pdo->prepare($sql);
	$statement->execute([
	"email" => $email,
	"role" => $role,
	'password' => password_hash($password, PASSWORD_DEFAULT)

]);

 $_SESSION['id'] = $pdo->lastInsertId();

  return $_SESSION['id'];
}


function login ($email, $password) {
	$pdo = new PDO("mysql:host=localhost;port=3307;dbname=crud_db;", "root", "");
	$sql = "SELECT * FROM products WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'email'  => $email
    ]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if(password_verify($password, $result['password'])) {
        return $result;
    } 
    else {
        return false;
    }

}


function select_all_users() {
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=crud_db;", "root", "");
    $sql = "SELECT * FROM products";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


function is_admin()
{
    //подключаемся к БД
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=crud_db;", "root", "");

    //создаем запрос
    $sql = "SELECT * FROM products WHERE role=:role";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    //fetch_assoc формирует ответ из БД в нормальный массив
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);


    if ($user == 'admin') {
        return true;
    } else {
        return false;
    }
}




// function check_admin () {
// 	if($_SESSION['role'] == 'admin') {
// 		return true;
// 	}
// 	return false;
// }

// function is_not_logged_in () {

//     if(isset($_SESSION['email']) && !empty($_SESSION['email'])) {
//         return false;
//     }

//     return true;
// }



function display_flash_message($name) {
    if (isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]);
    }
}



?>


