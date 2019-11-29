<?php

require('pdo.php');

$fname= filter_input(INPUT_POST, 'fname');
$lname= filter_input(INPUT_POST, 'lname');
$birthday=filter_input(INPUT_POST, 'birthday');
$email= filter_input(INPUT_POST, 'email');
$password= filter_input(INPUT_POST, 'new password');
$doubleCheck=strpos($email,'a');

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $Validate=true;
    if (empty($fname)) {
        $firstNameError = "Must provide your first name.";
        $Validate=false;
    }
    if (empty($lname)) {
        $lastNameError = "Must provide your last name.";
        $Validate=false;
    }
    if (empty($birthday)) {
        $birthdayError = "Must provide your birthday.";
        $Validate=false;
    }
    if (empty($email)) {
        $emailError = "Must type in a valid email.";
        $Validate=false;
    } elseif ($doubleCheck == false) {
        $emailError = "Email is not valid.";
        $Validate=false;
    }
    if (empty($password)) {
        $passwordError = "Must type in a valid password.";
        $Validate=false;
    } elseif (strlen($password) <= 8) {
        $passwordError = "Password must be at least 8 characters long.";
        $Validate=false;
    }




    if($Validate==true)
    {
        $query = 'INSERT INTO accounts
                     (email, fname, lname, birthday, password)
                VALUES 
                    (:email, :fname, :lname, :birthday, :password)';


        $statement = $db->prepare($query);

        $statement->bindValue(':email',$email);
        $statement->bindValue(':fName',$fname);
        $statement->bindValue(':lName',$lname);
        $statement->bindValue(':birthday',$birthday);
        $statement->bindValue(':password',$password);

        $statement->execute();
        $statement->closeCursor();

        header('Location: ../login.html');

    }

}
?>

<html lang="en">

<head><title> Registration Form </title></head>
<body>

<h2> Registration Information </h2>

<div>
    First Name: <?php echo $fname; ?>
    <span <span class="error"> <?php echo $firstNameError; ?> </span>
</div>
<div>
    Last Name: <?php echo $lname; ?>
    <span <span class="error"> <?php echo $lastNameError; ?> </span>
</div>
<div>
    Birthday: <?php echo $birthday; ?>
    <span <span class="error"> <?php echo $birthdayError; ?> </span>
</div>
<div>
    Email: <?php echo $email; ?>
    <span <span class="error"> <?php echo $emailError;?></span>
</div>
<div>
    Password: <?php if (!$password) echo $password; ?>
    <span <span class="error"> <?php echo $passwordError;?></span>
</div>
</body>
</html>


