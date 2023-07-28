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
  public $user_id;
  
  public function __construct($db){
    $this->conn = $db;
  }

  function getAll(){
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            ORDER BY
            create_date DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // execute query
    $stmt->execute();
   
    return $stmt;
  }


public function create(){
  $query = "INSERT INTO
                " . $this->table_name . "
            SET
                title= ?, body= ?, image= ?, category_id= ?, user_id= ?, create_date=now(); ";
  $stmt = $this->conn->prepare($query);

  // Bind giá trị
  $stmt->bindValue(1, $this->title);
  $stmt->bindValue(2, $this->body);
  $stmt->bindValue(3, $this->image);
  $stmt->bindValue(4, $this->category_id);
  $stmt->bindValue(5, $this->user_id);
  // Thực thi câu truy vấn
  if ($stmt->execute()) {
    return true;
} 

return false;
}
}
?>