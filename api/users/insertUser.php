<?php

include_once("../header.php");
include_once("../db.php");
include_once("../model/users.php");

$database = new Database();

$user = new Users($database->getConnection());

$data = json_decode(file_get_contents("php://input"));
$user->username = $data->username;
$user->email = $data->email;
$user->password = $data->pass;

if ($user->create()) {
    echo json_encode([
        "result" => true,
        "message" => "User was created.",
    ]);
} else {
    echo json_encode(["message" => "Unable to create user."]);
}
