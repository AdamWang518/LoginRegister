<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['name']) && isset($_POST['city'])&& isset($_POST['town'])&& isset($_POST['road'])) {
    if ($db->dbConnect()) {
        if ($db->HA("hospital_opendata", $_POST['name'], $_POST['city'], $_POST['town'], $_POST['road'])) {
            echo "Add Success";
        } else echo "Add Failed";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>