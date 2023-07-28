<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: Get"); // Để ví dụ, mình chỉ bảo vệ endpoint GET
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

$stmt = $news->getAll();  
$num = $stmt->rowCount();



if ($num > 0) {
  $news_arr = array();
  $news_arr["status"] = 200;
  $news_arr["message"] = "Get all news successful";
  $news_arr["data"] = array();


  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $news_item = array(
          "id" => $id,
          "user_id" => $name,
          "title" => $title,
          "body" => $body,
          "create_date" => $create_date,
          'image' => $image,
          'category_id' => $category_id,
      );

      array_push($news_arr["data"], $news_item);
  }

  http_response_code(200);
  echo json_encode($news_arr);
} else {
  http_response_code(404);
  echo json_encode(
      array("message" => "No news found.")
  );
}