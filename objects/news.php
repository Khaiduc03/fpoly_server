<?php
class News{
  private $conn;
  private $table_name = "news";
  public $id;
  public $title;
  public $body;
  public $image;
  public $category_id;
  public $created_date;
  
  public function __construct($db){
    $this->conn = $db;
  }

  function readAll(){
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            ORDER BY
                created_date DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // execute query
    $stmt->execute();
  
    return $stmt;
  }

  // create news
  function create(){
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                title=:title, body=:body, image=:image, category_id=:category_id, created_date=:created_date";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->body=htmlspecialchars(strip_tags($this->body));
    $this->image=htmlspecialchars(strip_tags($this->image));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    $this->created_date=htmlspecialchars(strip_tags($this->created_date));
  
    // bind values
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":body", $this->body);
    $stmt->bindParam(":image", $this->image);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":created_date", $this->created_date);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
  }
  



  
}
?>