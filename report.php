<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['username']) && isset($_POST['report'])) {
    if ($db->dbConnect()) {
        if ($db->rePort("report", $_POST['report'], $_POST['username'])) {
            echo "Report Success";
        } else echo "Report Failed";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>