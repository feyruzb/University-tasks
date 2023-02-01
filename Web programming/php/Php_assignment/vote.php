<!DOCTYPE html>
<html>
<head>
    <title>Vote</title>
</head>
<body>
<button style="position: absolute; top: 10px; right: 10px;">
        <a href="index.php">Back</a>
    </button>
<?php
  require_once "check_login.php";
    // checks if session is already started and if not starts it
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
	check_login();
     //connect to database
     $host = "sql11.freesqldatabase.com";
     $dbname = "sql11591031";
     $user = "sql11591031";
     $pass = "KPA1mi79sI";
     $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    //get poll id from url
    $pollid = $_GET['pollid'];

    //query to select poll by id
    $pollQuery = "SELECT * FROM polls WHERE id = :pollid";
    $pollStmt = $conn->prepare($pollQuery);
    $pollStmt->bindParam(':pollid', $pollid);
    $pollStmt->execute();
    $poll = $pollStmt->fetch();

    //display poll information
    echo "<h3>Poll ID: " . $poll['id'] . "</h3>";
    echo "<p>Question: " . $poll['question'] . "</p>";
    echo "<p>Options: " . $poll['options'] . "</p>";
    echo "<p>Created at: " . $poll['createdAt'] . "</p>";
    echo "<p>Deadline: " . $poll['deadline'] . "</p>";
    echo "<p>answers by: " . $poll['answers'] . "</p>";
    echo "<p>Voted count: " . $poll['voted'] . "</p>";
    

    //display vote form
    echo "<form action='submit_vote.php' method='post' onsubmit='return validateForm()'>";
    echo "<p>Select your option:</p>";
    $options = explode(',', $poll['options']);
    $i = 1;
    foreach ($options as $option) {
        $option = str_replace(["\"", "[", "]"], "", $option);
        echo "<input type='radio' name='vote' value='" . $option . "'>" . $option . "<br>" ;
        $i++;
    }
    echo "<input type='hidden' name='pollid' value='" . $pollid . "'>";
    echo "<input type='submit' value='Submit Vote'>";
    echo "</form>";
    ?>
    <script>
    function validateForm() {
        var radios = document.getElementsByName('vote');
        var formValid = false;

        var i = 0;
        while (!formValid && i < radios.length) {
            if (radios[i].checked) formValid = true;
            i++;
        }

        if (!formValid) alert("Please select an option to vote!");
        return formValid;
    }
</script>
</body>
</html>