<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['city']) && isset($_POST['town'])&&isset($_POST['road'])&&isset($_POST['latitude'])&&isset($_POST['longitude'])) {
    if ($db->dbConnect()) {
        if ($db->locaion("location", $_POST['city'], $_POST['town'], $_POST['road'], $_POST['latitude'], $_POST['longitude'])) {
            echo "Add Location Success";
        } else echo "Add Location Failed";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>