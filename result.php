<?php require_once('header.php') ?>
<h1>Our Members</h1>
<h2>Delete or Change information here</h2>
<main>
<?php
    //start of try block
    try {
        //connect to the db
        require_once('connect.php');

        //set up the statement
        $sql = "SELECT * FROM tbl_app_users;";

        //prepare and execute the query
        $statement = $db->prepare($sql);
        $statement->execute();

        //use fetchAll() to store the results in an array
        $user_records = $statement->fetchAll();

        //create the markup for the head of the table
        echo "<table class='table'><thead class='table table-dark'><th>First Name</th><th>Last Name</th><th>Location</th><th>Email</th><th>Skills</th><th>Delete</th><th>Edit</th></thead><tbody>";

        //use a foreach loop on tthe $records array to echo out the information into table rows
        foreach($user_records as $user) {
            echo 
            "<tr><td>".$user['first_name'].
            "</td><td>".$user['last_name'].
            "</td><td>".$user['user_location'].
            "</td><td>".$user['email_addr'].
            "</td><td>".$user['skill_set'].
            "</td><td><a class='btn btn-dark' href='delete.php?id=".$user['user_id'].
            "'>Delete</a></td><td><a class='btn btn-dark' href='index.php?id=".
            $user['user_id']."'>Edit</a></td></tr>";
        }

        //close out the table
        echo "</tbody></table>";

        //close the database connection
        $statement->closeCursor();
    }
    //catch statement for the PDO object exceptions that could be thrown
    catch (PDOException $e) {
        //store the message from the error object into a variable
        $err_msg = $e->getMessage();
        //echo the error message in new markup
        echo "<p>Apologies, there was an error: $err_msg</p>";
    }
?>
</main>
<?php require_once('footer.php') ?>