<?php

include_once("../header.php");
include_once("../db.php");
include_once("../../model/users.php");

$database = new Database();

$user = new Users($database->getConnection());

$data = json_decode(file_get_contents("php://input"));

$user->id = $data->id;
$user->username = $data->username;
$user->email = $data->email;
$user->password = $data->pass;

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'PATCH') {
    if ($user->update()) {
        echo json_encode([
            "result" => true,
            "message" => "Account updated successfully",
        ]);
        return;
    }

    echo json_encode(["message" => "Unable to update user."]);
} else {
    http_response_code(404);
}
