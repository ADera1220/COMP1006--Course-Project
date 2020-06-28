<?php ob_start(); //turns on output buffering
try{
    //grab the user id and store it in a variable
    $user_id = filter_input(INPUT_GET, 'id');

    //connect to the db and set up the query
    require_once('connect.php');
    $sql = "DELETE FROM tbl_app_users WHERE user_id = :user_id;";

    //prepare,bind and execute the statement
    $statement = $db->prepare($sql);
    $statement->bindParam(':user_id', $user_id);
    $statement->execute();

    //close connection to db and return user to result.php
    $statement->closeCursor();
    header('location:result.php');
}
//catch the exceptions in the PDO object
catch (PDOException $e) {
    $err_msg = $e->getMessage();
    echo "<h1>$err_msg</h1>";
}

ob_flush(); // turns off output buffering
?>