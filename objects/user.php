<?php
class User{
  private $conn;
  private $table_name = "user";
  public $id;
  public $username;
  public $email;
  public $password;
  public $phone;
  public $dob;
  public $class_id;

  public function __construct($db){
    $this->conn = $db;
  }
  
  //login 
  public function login() {
    if (empty($this->username) || empty($this->password)) {
        return false;
    }
    
    // Query to find the user with the provided username
    $query = "SELECT * FROM " . $this->table_name . " WHERE username = ?";
    $stmt = $this->conn->prepare($query);
   
    $stmt->bindParam(1, $this->username);
    $stmt->execute();
    
    // Check if the user exists
    if ($stmt->rowCount() > 0) {
        // Fetch the user data from the database
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if (password_verify($this->password, $row['password'])) {
            // Password is correct, login successful
            
            return $row;
        } else {
            // Password is incorrect
            return false;
        }
    } else {
        // User does not exist
        return false;
    }
}


public function register(){
  // Check if the required fields are set (username and password)
  if (empty($this->username) || empty($this->password)) {
      return false;
  }

  $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? OR email = ?";    
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->username);
  $stmt->bindParam(2, $this->username); // Since email is optional, use username again
  $stmt->execute();
  $num = $stmt->rowCount();
  
  if ($num > 0) {
      return false;
  } else {
      // Prepare the INSERT query for only username and password
      $query = "INSERT INTO " . $this->table_name . " SET username = ?, password = ?";
      $stmt = $this->conn->prepare($query);

      // Sanitize and bind only username and password parameters
      $this->username = htmlspecialchars(strip_tags($this->username));
      $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
    
      $stmt->bindParam(1, $this->username);
      $stmt->bindParam(2, $hashed_password);
   
      if ($stmt->execute()) {
          return true;
      } else {
          return false;
      }
  }
}

}

?>