<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

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

$nameErr = $emailErr = $last_nameErr = "";
$arr_Err = $data = [];
$first_name = $last_name = "";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // код ответа - 404 Не найдено
    http_response_code(404);
    $arr_Err[] = 'Something went wrong...';
    // сообщим пользователю, что поля заполнены не правильно
    echo json_encode($arr_Err);
    die;
}
    if (empty($_POST["id"])) die($arr_Err[] = 'Something went wrong...');
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        array_push($arr_Err, $nameErr);
    } else {
        $first_name = test_input($_POST["name"]);
        // Проверяем, содержит ли имя только буквы и пробелы
        if (!preg_match("/^[a-яA-Я ]*$/", $first_name)) {
            $nameErr = "Only letters and spaces are allowed in the name";
            array_push($arr_Err, $nameErr);
        }
    }

    if (empty($_POST["last-name"])) {
        $last_nameErr = "Last Name is required";
        array_push($arr_Err, $last_nameErr);
    } else {
        $last_name = test_input($_POST["last-name"]);
        // Проверяем, содержит ли фамилия только буквы и пробелы
        if (!preg_match("/^[a-яA-Я ]*$/", $last_name)) {
            $last_nameErr = "Only letters and spaces are allowed in the last name";
            array_push($arr_Err, $last_nameErr);
        }
    }


if (!empty($arr_Err)){
    // код ответа - 404 Не найдено
    http_response_code(404);

    // сообщим пользователю, что товар не существует
    echo json_encode($arr_Err);
    die;
}
$database = new Database();
$db = $database->getConnection();

// подготовка объекта
$user = new Users($db);


$user->id = $_POST["id"];
$user->first_name = $first_name;
$user->last_name = $last_name;
$user->update_date = date('Y-m-d H:i:s');

$stmt = $user->edit();

if ($error){
    http_response_code(404);
    // сообщим пользователю, что user не обновлен
    echo json_encode( $error);
}
else{
    http_response_code(200);
    echo json_encode( 'User has been edited',JSON_UNESCAPED_UNICODE);
}
