<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение файла для соединения с базой и файл с объектом
include_once '../config/database.php';
include_once '../objects/users.php';

// получаем соединение с базой данных

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] != "POST" && empty($_POST)) {
    http_response_code(404);
    $arr_Err[] = 'Something went wrong...';
    die(json_encode($arr_Err));
}

if (!empty($_POST["id"])) {
    // Проверяем id
    $id = test_input($_POST["id"]);
    if (!preg_match("/^[1-9]*$/", $id)) {
        $id = '';
    }
}
if (!empty($_POST["first_name"])) {
    // Проверяем, содержит ли имя только буквы и пробелы
    $first_name = test_input($_POST["first_name"]);
    if (!preg_match("/^[a-яA-Я ]*$/", $first_name)) {
        $first_name = '';
    }
}

if (!empty($_POST["last_name"])) {
    // Проверяем, содержит ли фамилия только буквы и пробелы
    $last_name = test_input($_POST["last_name"]);
    if (!preg_match("/^[a-яA-Я ]*$/", $last_name)) {
        $last_name = '';
    }
}

if (!empty($_POST["email"])) {
    // Проверяем, правильно ли сформирован адрес электронной почты
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = '';
    }
}

if (!empty($_POST["create_date"])) {
    // Проверяем id
    $create_date = test_input($_POST["create_date"]);
    if (!preg_match("/^[0-9-: ]*$/", $create_date)) {
        $create_date = "";
    }
    else $create_date = "{$create_date}%";
}

if (!empty($_POST["update_date"])) {
    // Проверяем id
    $update_date = test_input($_POST["update_date"]);
    if (!preg_match("/^[0-9-: ]*$/", $update_date)) {
        $update_date = '';
    }
    else $update_date = "{$update_date}%";

}

$database = new Database();
$db = $database->getConnection();

// подготовка объекта
$user = new Users($db);

$user->id = $id;
$user->email = $email;
$user->first_name = $first_name;
$user->last_name = $last_name;
$user->update_date = $update_date;
$user->create_date = $create_date;
//var_dump($user->create_date);
$stmt = $user->search();
$num = $stmt->rowCount();
// проверяем, найдено ли больше 0 записей
if ($num>0) {

    // массив товаров
    $users_arr=array();

    // получаем содержимое нашей таблицы
    // fetch() быстрее чем fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // извлечём строку
        extract($row);

        $user_item=array(
            "id" => $id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "create_date" => $create_date,
            "update_date" => $update_date,
        );
        array_push($users_arr, $user_item);
    }

    // код ответа - 200 OK
    http_response_code(200);

    // покажем товары
    echo json_encode($users_arr);
}

else {
    // код ответа - 404 Ничего не найдено
    http_response_code(404);
}
