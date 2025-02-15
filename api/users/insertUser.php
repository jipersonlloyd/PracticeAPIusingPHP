<?php

include_once("../header.php");
include_once("../db.php");
include_once("../../model/users.php");

$database = new Database();

$user = new Users($database->getConnection());

$data = json_decode(file_get_contents("php://input"));
$user->username = $data->username;
$user->email = $data->email;
$user->password = $data->pass;

$method = $_SERVER["REQUEST_METHOD"];

if ($method == 'POST') {
    if ($user->isUserExist()) {
        echo json_encode([
            "result" => true,
            "message" => "Account already exist",
        ]);
        return;
    }

    if ($user->create()) {
        echo json_encode([
            "result" => true,
            "message" => "Account created successfully",
        ]);
        return;
    }

    echo json_encode(["message" => "Unable to create user."]);
} else {
    http_response_code(404);
}
