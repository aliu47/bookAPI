<?php
class Database
{
    private $conn;

    //DB Connect
    public function connect()
    {
        $config = parse_ini_file(__DIR__ .'/../dbconfig/secret.ini');
        $host = $config['host'];
        $db_name =  $config['db_name'];
        $username = $config['username'];
        $password = $config['password'];

        $this->conn = null;

        try {
            $this->conn = new PDO(
                'mysql:host=' . $host . ';charset=utf8;dbname=' .
                    $db_name,
                $username,
                $password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
