<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET"); // Để ví dụ, mình chỉ bảo vệ endpoint GET
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
require_once '../vendor/autoload.php';
require_once '../core/guard.php';

// Authenticate the user using JWT before proceeding to other operations
$userData = authenticate();
// var_export($userData -> user_id);
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();


// initialize object
$category = new Category($db);

// query categorys
$stmt = $category->readAll();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    // products array
    $categories_arr = array();
    // $categories_arr["user"] = array();
    // array_push($categories_arr["user"], $userData);
    $categories_arr["status"] = 200;
    $categories_arr["message"] = "Categories found";
    $categories_arr["data"] = array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $category_item = array(
            "id" => $id,
            "name" => $name,
        );

        array_push($categories_arr["data"], $category_item);
    }

    http_response_code(200);
    echo json_encode($categories_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>