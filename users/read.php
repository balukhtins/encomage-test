<?php
// необходимые HTTP-заголовки
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

// подключение базы данных и файл, содержащий объекты
include_once './config/database.php';
include_once './objects/users.php';

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$users = new Users($db);

// запрашиваем товары
$stmt = $users->read();
$num = $stmt->rowCount();

// проверка, найдено ли больше 0 записей
if ($num>0) {

    // массив товаров
    $users_arr=array();
       
    // получаем содержимое нашей таблицы
    // fetch() быстрее, чем fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку
        extract($row);

            $users_item=array(
                "user_id" => $id,
                "user_first_name" => $first_name,
                "user_last_name" => $last_name,
                "user_email" => $email,
                "create_date" => $create_date,
                "update_date" => $update_date,
            );
        array_push($users_arr, $users_item);
    }

    // устанавливаем код ответа - 200 OK
    http_response_code(200);

    // выводим данные о товаре в формате JSON
    return($users_arr);
}

else {

    // установим код ответа - 404 Не найдено
    http_response_code(404);

    // сообщаем пользователю, что товары не найдены
    echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}