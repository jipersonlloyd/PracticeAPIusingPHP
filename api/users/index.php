<?php

include_once("../header.php");
include_once("../db.php");
include_once("../../model/users.php");

$database = new Database();
$user = new Users($database->getConnection());

$stmt = $user->read();
$users_arr = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $user_item = [
        "id" => $row["id"],
        "username" => $row["username"],
        "email" => $row["email"],
        "pass" => $row["pass"],
        "created_at" => $row["created_at"]
    ];
    array_push($users_arr, $user_item);
}

$method = $_SERVER["REQUEST_METHOD"];

if($method == 'GET') {
    echo json_encode($users_arr);
}
else {
    http_response_code(404);
}
