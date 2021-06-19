<?php
require "DataBase.php";
$db = new DataBase();
$_POST = json_decode(file_get_contents('php://input'), true);
if (isset($_POST['name']) && isset($_POST['city'])&& isset($_POST['town'])&& isset($_POST['road'])) {
    if ($db->dbConnect()) {
        if ($db->HA("hospital_opendata", $_POST['name'], $_POST['city'], $_POST['town'], $_POST['road'])) {
            $json = Array(
                "HttpCode" => 200,
                "message" => "success"
            );   
            echo json_encode($json); 
        } else{
            $json = Array(
                "HttpCode" => 500,
                "message" => "error insert db"
            );   
            echo json_encode($json); 
        }
    } else {
        $json = Array(
            "HttpCode" => 500,
            "message" => "error connection db"
        );   
        echo json_encode($json); 
    }
} else {
    $json = Array(
        "HttpCode" => 500,
        "message" => "error all fields  required"
    );   
    echo json_encode($json); 
}
?>