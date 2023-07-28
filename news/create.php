<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST"); // Để ví dụ, mình chỉ bảo vệ endpoint GET
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/news.php';
require_once '../vendor/autoload.php';
require_once '../core/guard.php';

$userData = authenticate();

$database = new Database();
$db = $database->getConnection();


$news = new News($db);


$data = json_decode(file_get_contents("php://input"));


if(empty($data)) {
    http_response_code(400);
    echo json_encode(['error' => 'No input data']); 
    exit;
  }
  

 
     $news->title = sanitize($data->title); 
     $news->body = sanitize($data->body);
    $news->image = sanitize($data->image);
    $news->category_id = sanitize($data->category_id);
    $news->user_id = $userData->id;
    if (empty($news->title) || empty($news->body) || empty($news->image) || empty($news->category_id)) {
        http_response_code(400);
        echo json_encode(['error' => 'Input data is null']);
        exit;
    }
  
 
  
//  Gọi hàm create
  if($news->create()) {
    
    http_response_code(201);
    echo json_encode(['message' => 'Created']);
  
  } else {
  
    http_response_code(500); 
    echo json_encode(['error' => 'Server error']);
  
  }
  
  // Hàm sanitize
  function sanitize($input) {
    return htmlspecialchars(strip_tags($input));
  }

?>