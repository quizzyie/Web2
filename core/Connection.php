<?php
class Connection
{
    private static $instance = null,$conn = null;

    private function __construct($config)
    {
        extract($config);
        if (empty($pass)) {
            $pass = '';
        }
        try {

            $dsn = 'mysql:dbname=' . $db . ';host=' . $host;

            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //Đẩy lỗi vào ngoại lệ khi truy vấn
            ];
            $conn = new PDO($dsn, $user, $pass, $options);

            self::$conn = $conn;
         
        } catch (Exception $exception) {
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public static function getInstance($config)
    {
        if (self::$instance == null) {
            $connection = new Connection($config);
            self::$instance = self::$conn;
            // Thuc hien tra ve kieu du lieu PDO
        }

        return self::$instance;
    }
}