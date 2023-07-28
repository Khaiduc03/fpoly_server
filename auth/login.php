<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->username = $data->username;
$user->password = $data->password;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Get the form data
  $user->username = $_POST["username"];
  $user->password = $_POST["password"];
} else {
  http_response_code(400);
  echo json_encode(
      array("message" => "Invalid request method")
  );
  exit;
}
// query user

// check if more than 0 record found
if($userData = $user->login()){
  // User authentication is successful
  // Generate JWT token
  $secret_key = "khai"; // Đặt giá trị này bằng khóa bí mật của bạn
  $issued_at = time();
  $expiration_time = $issued_at + 60 * 60; // Thời gian hết hạn của token: 1 giờ

  $payload = array(
      "iss" => "your_website_name", // Người phát hành token
      "iat" => $issued_at, // Thời gian phát hành token
      "exp" => $expiration_time, // Thời gian hết hạn token
      "data" => array(
          "id" => $userData['id'], // Lấy ID người dùng từ kết quả trả về của hàm login()
          "username" => $userData['username']
          // Các thông tin người dùng khác mà bạn muốn bao gồm trong token
      )
  );

  $jwt = JWT::encode($payload, $secret_key, 'HS256');

  http_response_code(200);
  echo json_encode(
      array(
          
          "access_token" => $jwt // Trả về JWT cho client
      )
  );
}
else{
    http_response_code(400);
    echo json_encode(
        array("message" => "login fail")
    );
}


?>