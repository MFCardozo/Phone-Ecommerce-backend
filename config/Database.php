<?php
class Database
{
    private $db = parse_url(getenv("postgresql-octagonal-09743"));

    // private $host='localhost';
    // private $db_name='products';
    // private $user='postgres';
    // private $password='1234';
    private $conn;

    public function connect()
    {

        $this->conn = null;

        try {
            $this->conn = new PDO(
                "pgsql:" . sprintf(
                    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                    $this->db["host"],
                    $this->db["port"],
                    $this->db["user"],
                    $this->db["pass"],
                    ltrim($this->db["path"], "/")
                )
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
