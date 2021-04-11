<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение необходимых файлов
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/users.php';

if ($_SERVER["REQUEST_METHOD"] != "POST" && empty($_POST)) {
    // код ответа - 404 Не найдено
    http_response_code(404);
    $arr_Err[] = 'Something went wrong...';
    // сообщим пользователю, что поля заполнены не правильно
    die(json_encode($arr_Err));
}
// создание подключения к БД
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$select = new Users($db);

$data = $_POST;

// запрос товаров
$stmt = $select->select($data);
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

    // скажем пользователю, что товары не найдены
    echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}