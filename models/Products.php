<?php

class Products
{

    private $conn;
    private $table = 'phones';

    // products Properties
    public $id;
    public $title;
    public $img;
    public $price;
    public $company;
    public $information;


    public function __construct($db)
    {

        $this->conn = $db;
    }


    //Get Products
    public function read()
    {

        $query = "SELECT * FROM  $this->table ;";



        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    //get product

    public function read_one($id)
    {

        $query = "SELECT * FROM  $this->table WHERE id= ? ;";



        $stmt = $this->conn->prepare($query);

        $stmt->execute([$id]);

        return $stmt;
    }
}
