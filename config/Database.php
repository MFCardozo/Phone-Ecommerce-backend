<?php
class Database
{

    private $host='localhost';
    private $db_name='products';
    private $user='postgres';
    private $password='1234';
    private $conn;

    public function connect(){

        $this->conn=null;

        try{
            $this->conn=new PDO(
                'pgsql:host='. $this->host .';dbname='. $this->db_name,$this->user,$this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


        }catch(PDOException $e){

            echo 'Connection Error: '. $e->getMessage();



        }

        return $this->conn;
    
    }


}



?>