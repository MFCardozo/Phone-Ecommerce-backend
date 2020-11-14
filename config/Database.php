<?php


class Database
{


    // private $host='localhost';
    // private $db_name='products';
    // private $user='postgres';
    // private $password='1234';
    private $conn;

    public function connect()
    {
        $db = parse_url(getenv("DATABASE_URL"));

        $this->conn = null;

        try {
            $this->conn = new PDO(
                "pgsql:" . sprintf(
                    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                    $db["host"],
                    $db["port"],
                    $db["user"],
                    $db["pass"],
                    ltrim($db["path"], "/")
                )
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
