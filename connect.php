<?php
    $dsn = 'mysql:host=localhost:3308;dbname=db_web_app';
    $username = 'root';
    $password = ''; 
    $db = new PDO($dsn, $username, $password);
    //set error mode to exception 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>