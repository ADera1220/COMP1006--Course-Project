<?php require_once('header.php'); ?>
<main>
    <?php

        //create variables to store form data
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $location = filter_input(INPUT_POST, 'location');
        $skills = filter_input(INPUT_POST, 'skills');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        $user_id = null;
        $user_id = filter_input(INPUT_POST, 'user_id');

        //set up a flag variable\
        $ok = true;

        //validate input
        //First and last name
        if(empty($first_name) || empty($last_name)) {
            echo 'Please provide both first and last name';
            echo '<a href="index.php">GO BACK</a>';
            $ok = false;
        }
        //location
        elseif(empty($location)) {
            echo 'Please tell us where you are located';
            echo '<a href="index.php">GO BACK</a>';
            $ok = false;
        }
        //email (check format)
        elseif(empty($email) || $email === false) {
            echo 'Please enter a valid email';
            echo '<a href="index.php">GO BACK</a>';
            $ok = false;
        }
        //skills (check format)
        elseif(empty($skills) || $skills === false) {
            echo 'Please enter a valid skill';
            echo '<a href="index.php">GO BACK</a>';
            $ok = false;
        }

        if ($ok === true) {
            try {
                //open a connection
                require_once('connect.php');

                //if the id variable is not empty, we update the information
                if(!empty($id)) {
                    //create an SQL query for the info UPDATE
                    $sql = "UPDATE tbl_app_users SET first_name = :first_name, last_name = :last_name, user_location = :location, email_addr = :email, skill_set = :skills WHERE user_id = :user_id;";
                }
                else {
                    //set up SQL command to insert data into table
                    $sql = "INSERT INTO tbl_app_users(first_name, last_name, user_location, email_addr, skill_set) VALUES (:first_name, :last_name, :location, :email, :skills);";
                }

                //call the prepare method with the SQL query as a parameter, this returns the PDOStatement object
                $statement = $db->prepare($sql);

                //bind the parameters
                $statement->bindParam(':first_name', $first_name);
                $statement->bindParam(':last_name', $last_name);
                $statement->bindParam(':location', $location);
                $statement->bindParam(':email', $email);
                $statement->bindParam(':skills', $skills);

                //if statement for updates, if the user_id is there, it treats it as an UPDATE
                if(!empty($id)) {
                    $statement->bindParam(':user_id', $id);
                }

                //execute the statement, then close the connection
                $statement->execute();
                echo "<h1> Thanks for sharing! </h1>";
                $statement->closeCursor();
            }
            catch(PDOException $e) {
                $err_msg = $e->getMessage();
                echo "<h1>Sorry, but there was an error: $err_msg</h1>";
            }
        }
    ?>
    <a href="index.php" class="error-btn"> Back to Form </a>
</main>
<?php require_once('footer.php'); ?>