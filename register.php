<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
    

  require_once('../private/initialize.php');
  require_once('../private/functions.php');
  require_once('../private/validation_functions.php');
  require_once('../private/database.php');

  // Set default values for all variables the page needs.
  $first_name = $last_name = $email = $username = " ";

  function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }

  // if this is a POST request, process the form
  // Hint: private/functions.php can help
  if (is_post_request()){

    // Confirm that POST values are present before accessing them.
    if(isset($_POST["firstname"])){
      $first_name = test_input($_POST["firstname"]);
    }
    if(isset($_POST["lastname"])){
      $last_name = test_input($_POST["lastname"]);
    }
    if(isset($_POST["email"])){
      $email = test_input($_POST["email"]);
    }
    if(isset($_POST["username"])){
      $username = test_input($_POST["username"]);
    }
    // Perform Validations
    // Hint: Write these in private/validation_functions.php
    $errors = [];
    if (is_blank($first_name)) {
      $errors[] = "First name cannot be blank.";
    } 
    if (!has_length($first_name, ['min' => 2, 'max' => 255])) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }
    if (is_blank($last_name)) {
      $errors[] = "Last name cannot be blank.";
    } 
    if (!has_length($last_name, ['min' => 2, 'max' => 255])) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }
    if (is_blank($email)) {
      $errors[] = "Email cannot be blank.";
    } 
    if (!has_length($email, ['min' => 2, 'max' => 255])) {
      $errors[] = "Email must be between 2 and 255 characters.";
    }
    if (is_blank($username)) {
      $errors[] = "username cannot be blank.";
    } 
    if (!has_length($username, ['min' => 8, 'max' => 255])) {
      $errors[] = "username must be between 8 and 255 characters.";
    }

    // if there were no errors, submit data to database
    if(count($errors) == 0){
      // Write SQL INSERT statement
      $created_at = date("Y-m-d H:i:s");
       $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `username`, `created_at`) VALUES ('$first_name', '$last_name', '$email', '$username', '$created_at');";
        $db = db_connect();
      // For INSERT statments, $result is just true/false
       $result = db_query($db, $sql);
       if($result) {
         db_close($db); 

      //   TODO redirect user to success page
         $location = 'registration_success.php';
         redirect_to($location);

       } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
          echo db_error($db);
          db_close($db);
          exit;
       }
    }
    else
    {
    echo display_errors($errors); 
    echo '<form action = "register.php" method = "post">';
    echo 'First name:<br>';
    echo '<input type = "text" name = "firstname" value = "'.$_POST["firstname"].' " /><br/> ';
    echo 'Last name: <br/>';
    echo '<input type = "text" name = "lastname" value = " '.$_POST["lastname"].'  " /><br/>';
    echo 'Email: <br/>';
    echo '<input type = "text" name = "email" value = " '.$_POST["email"].'" /><br/>';
    echo 'Username: <br/>';
    echo '<input type = "text" name = "username" value = "'.$_POST["username"].' " /><br/>';
    '<br/>';
    echo '<input type="submit" name = "submit" value="Submit"></form>';
    }
  }
  else
  {
    echo '<form action = "register.php" method = "post">
    First name:<br>
    <input type = "text" name = "firstname" value = " " /><br/>
    Last name: <br/>
    <input type = "text" name = "lastname" value = " " /><br/>
    Email: <br/>
    <input type = "text" name = "email" value = " " /><br/>
    Username: <br/>
    <input type = "text" name = "username" value = " " /><br/>
    <br/>
    <input type="submit" name = "submit" value="Submit">
  </form>'
  ;
  }
  
?>





  <!-- TODO: HTML form goes here -->





</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
