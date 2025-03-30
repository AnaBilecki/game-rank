<?php

    $db_name = "games";
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $ex) {
        $error = $ex->getMessage();
        echo "Error: $error";
    } 