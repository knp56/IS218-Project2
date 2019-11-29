<?php

require("pdo.php");
require("task.php");


$questionName=filter_input(INPUT_POST,'questionName');
$questionBody=filter_input(INPUT_POST,'questionBody');
$questionSkills=filter_input(INPUT_POST,'questionSkills');

session_start();
$userid=$_SESSION['userid'];
$doubleCheckSkills=explode(',',$questionSkills);


if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $Validate=true;
    if (empty($questionName))
    {
        $NameError = "Must provide a Question Name.";
        $Validate=false;
    }
    elseif(strlen($questionName) < 3)
    {
        $NameError= "Question Name must be 3 characters or more.";
        $Validate=false;
    }
    if (empty($questionBody))
    {
        $bodyError = "Must provide a Question Body.";
        $Validate=false;
    }
    elseif(strlen($questionBody) >= 500)
    {
        $bodyError= "Question Body cannot be more than 500 characters.";
        $Validate=false;
    }
    if (empty($questionSkills))
    {
        $skillError = "Must provide skills.";
        $Validate=false;
    }
    elseif(count($doubleCheckSkills) < 2)
    {
        $skillError= "Must provide 2 or more skills.";
        $Validate=false;
    }


    if($Validate==true)
    {
        $query = 'INSERT INTO questions
                    (ownerid,title,body,skills)
                VALUES
                (:ownerid,:title,:body,:skills)';

        $statement = $db->prepare($query);

        $statement->bindValue('ownerid',$userid);
        $statement->bindValue('questionName',$questionName);
        $statement->bindValue('questionBody',$questionBody);
        $statement->bindValue('questionSkills',$questionSkills);

        $statement->execute();
        $statement->closeCursor();


    }

}
?>


<html lang="en">

<head><title> Question Form</title></head>

<h1> Questionnaire </h1>
<div>
    Question Name = <?php if(!$NameError) echo $questionName; ?>
    <span <span class="error"><?php echo $NameError; ?></span>
</div>
<div>
    Question Body = <?php if(!$bodyError) echo $questionBody; ?>
    <span <span class="error"><?php echo $bodyError; ?></span>
</div>
<div>
    Question Skills = <?php if (!$skillError) echo $questionSkills; ?>
    <span <span class="error"><?php echo $skillError; ?></span>
</div>

</html>
