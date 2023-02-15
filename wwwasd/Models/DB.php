<?php namespace Models;

use PDO;

include_once __DIR__."/../config/SERVER.php";

class DB
{
    private PDO $pdo;
    private string $host = SERVER;
    private string $db =DB;
    private string $user = USER;
    private string $password = PASS;

    public function __construct(){}

    function connect():PDO
    {
        try {
            $dns = "mysql:dbname={$this->db};host={$this->host}";
            $options = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->pdo = new \PDO($dns, $this->user, $this->password, $options);

            return $this->pdo;
        } catch (\PDOException $e) {
            print_r('Error connection: ' . $e->getMessage());
        }
    }
    public function closeConnection():void{
        $this->pdo=null;
    }

    public function getLastId()
    {
        $stmt = $this->connect()->query('SELECT usu_id from usuario WHERE usu_id= (SELECT MAX(usu_id) FROM usuario);');
        $lastId = $stmt->fetchColumn();

        return $lastId;
    }
}
