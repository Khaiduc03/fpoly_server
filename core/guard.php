<?php
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

function authenticate() {
    $secret_key = "khai"; // Đặt giá trị này bằng khóa bí mật của bạn
    $jwt = null;

    // Lấy JWT từ header Authorization
    $headers = apache_request_headers();
    if (isset($headers['Authorization'])) {
        $authHeader = $headers['Authorization'];
        $jwt = substr($authHeader, 7); // Bỏ đi phần "Bearer " trong Authorization header
    }

    if ($jwt) {
        try {
            // Giải mã JWT
           
            $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
            // Trích xuất thông tin người dùng từ JWT
            $userData = $decoded->data;
          
            // Trả về thông tin người dùng để sử dụng trong xử lý tiếp theo
            return $userData;
        } catch (Exception $e) {
            // JWT không hợp lệ
            http_response_code(401);
            echo json_encode(array("message" => "Access denied."));
            exit();
        }
    } else {
        // JWT không tồn tại trong header Authorization
        http_response_code(401);
        echo json_encode(array("message" => "Access denied."));
        exit();
    }
}

?>