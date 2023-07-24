<?php 
class Category{
  
    // database connection and table name
    private $conn;
    private $table_name = "category_news";
  
    // object properties
    public $id;
    public $name;
  
    // co$category
    public function __construct($db){
        $this->conn = $db;
    }

    public function readAll(){
  
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name ASC";
  
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
  
        // execute query
        $stmt->execute();
  
        return $stmt;
    }

    //read one
    public function readOne(){
  
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    0,1";
  
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
  
        // bind id of category to be updated
        $stmt->bindParam(1, $this->id);
  
        // execute query
        $stmt->execute();
  
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
        // set values to object properties
        $this->name = $row['name'];
        
    }

  }

?>