<?php

include_once("../header.php");
include_once("../db.php");
include_once("../../model/users.php");

$database = new Database();

$user = new Users($database->getConnection());

$data = json_decode(file_get_contents("php://input"));

$user->id = $data->id;

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'DELETE') {
    if ($user->delete()) {
        echo json_encode([
            "result" => true,
            "message" => "Account deleted successfully",
        ]);
        return;
    }

    echo json_encode(["message" => "Unable to delete user."]);
} else {
    http_response_code(404);
}