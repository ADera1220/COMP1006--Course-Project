<?php require_once('header.php') ?>
<h1>Welcome to Social PHP!</h1>
<h2>Where all your PHP friends are!</h2>
<?php

    //initialize variables as null
    $user_id = null;
    $first_name = null;
    $last_name = null;
    $location = null;
    $email = null;
    $skills = null;

    //if statement to check if the user_id is posted in the URL(uses GET method) if it is NOT empty, then the if statement sets the page up for edit mode
    if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
        //pull the user_id from the URL
        $user_id = filter_input(INPUT_GET, 'id');

        //connect to the database
        require_once('connect.php');

        //set up the Query to be executed
        $sql = "SELECT * FROM tbl_app_users WHERE user_id = :user_id;";

        //prepare, bind and execute the statement
        $statement = $db->prepare($sql);
        $statement->bindParam(':user_id', $user_id);
        $statement->execute();

        //use the fetchAll() method of the PDO object to store the records into an array
        $user_list = $statement->fetchAll();

        //use a foreach loop to populate the above variables with the user records information
        foreach($user_list as $user) :
            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
            $location = $user['user_location'];
            $email = $user['email_addr'];
            $skills = $user['skill_set'];
        endforeach;

        //end the connection to the database
        $statement->closeCursor();
    }

?>
<h3> Enter your information to create your account! </h3>
<form action="process.php" method="post">
    <legend>CREATE YOUR ACCOUNT!</legend>
    <!-- add hidden input with user_id if editing -->
    <div class="form-group">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    </div>
    <div class="form-group">
        <label for="first_name"> Your First Name </label>
        <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo $first_name; ?>">
    </div>
    <div class="form-group">
        <label for="last_name"> Your Last Name </label>
        <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo $last_name; ?>">
    </div>
    <div class="form-group">
        <label for="location"> Your Current City </label>
        <input type="text" name="location" class="form-control" id="location" value="<?php echo $location; ?>">
    </div>
    <div class="form-group">
        <label for="email"> Your Email </label>
        <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
    </div>
    <div class="form-group">
        <label for="skills"> Your Skills (please list with commas in between) </label>
        <input type="text" name="skills" class="form-control" id="skills" value="<?php echo $skills; ?>">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-dark" name="submit" value="Send & Share" class="btn">
    </div>
</form>
<?php require_once('footer.php') ?>