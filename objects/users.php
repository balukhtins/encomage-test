<?php
class Users {

    // подключение к базе данных и таблице 'users'
    private $conn;
    private $table_name = "users";

    // свойства объекта
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $create_date;
    public $update_date;

    // конструктор для соединения с базой данных
    public function __construct($db){
        $this->conn = $db;
    }

    // метод read() - получение users
    function read(){

        // выбираем все записи
        $query = "SELECT 
             id, first_name, last_name, email, create_date, update_date
             FROM " .$this->table_name. " 
                   GROUP BY id
         ";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $stmt;
    }

    // используется при заполнении формы обновления user
    function readOne() {

        // запрос для чтения одной записи (user)
        $query = "SELECT 
             first_name, last_name, email
             FROM " .$this->table_name. "
                   WHERE
               		id = ?
        ";

        // подготовка запроса
        $stmt = $this->conn->prepare( $query );

        // привязываем id товара, который будет обновлен
        $stmt->bindParam(1, $this->id);

	    // выполняем запрос
        $stmt->execute();

        return $stmt;
    }

    //обновление данных пользователя
    function edit(){
        try {
            // запрос для чтения одной записи (user)
            $query = "UPDATE " . $this->table_name . "
                SET first_name = ?, last_name = ?, update_date = ?
                   WHERE
                   id = ?
            ";

            // подготовка запроса
            $stmt = $this->conn->prepare($query);

            //extract($data);

            // привязываем id товара, который будет обновлен
            $stmt->bindParam(1, $this->first_name);
            $stmt->bindParam(2, $this->last_name);
            $stmt->bindParam(3, $this->update_date);
            $stmt->bindParam(4, $this->id);

            // выполняем запрос
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $e){
            return $error = "Error: " . $e->getMessage("User not edit");
        }
}

// метод search - поиск товаров
function search(){

    // выборка по всем записям
    $query = "SELECT
         id, first_name, last_name, email, create_date, update_date
         FROM " .$this->table_name. "  
            WHERE
               (id LIKE ? OR first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR update_date LIKE ? OR create_date LIKE ?) 
        ";

    // подготовка запроса
    $stmt = $this->conn->prepare($query);

    // привязка
    $stmt->bindParam(1, $this->id);
    $stmt->bindParam(2, $this->first_name);
    $stmt->bindParam(3, $this->last_name);
    $stmt->bindParam(4, $this->email);
    $stmt->bindParam(5, $this->update_date);
    $stmt->bindParam(6, $this->create_date);

    // выполняем запрос
    $stmt->execute();

    return $stmt;
}

    // метод select - выбор товаров по параметрам
function select($keywords){

    $desc = $field = "%%";
    // разложим массив на переменные
    if (is_array($keywords)) {
        extract($keywords);
        $field = "{$field}";
        $desc = "{$desc}";
    }
    else die(json_encode(array("message" => "Users не найдены."), JSON_UNESCAPED_UNICODE));
    // выборка по всем записям

    $query = "SELECT 
         id, first_name, last_name, email, create_date, update_date
         FROM " .$this->table_name. " 
               ORDER BY " . $field . " " . $desc;

    // подготовка запроса
    $stmt = $this->conn->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $stmt;
    }

    // проверка на уникальность email
    function is_email(){

        $query = "SELECT
             email
             FROM " .$this->table_name. " 
             WHERE email = ?
         ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);
        $stmt->execute();

        return $stmt;
    }

    function add(){
        try {
            $query = "INSERT INTO " .$this->table_name. "
                 (first_name, last_name, email, create_date, update_date)
                 VALUES 
                 (:first_name, :last_name, :email, :create_date, :update_date)
             ";

            // подготовка запроса
            $stmt = $this->conn->prepare($query);

            // привязка

            $stmt->bindParam(':first_name', $this->first_name);
            $stmt->bindParam(':last_name', $this->last_name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':create_date', $this->create_date);
            $stmt->bindParam(':update_date', $this->create_date);

            // выполняем запрос
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $e){
            return $error = "Error: " . $e->getMessage("User not added");
        }
    }

}
