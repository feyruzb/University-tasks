<?php
// checks if session is already started and if not starts it
require_once "check_login.php";
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

//get poll id and vote from form
$pollid = $_POST['pollid'];
$vote = $_POST['vote'];

//query to select poll by id
$pollQuery = "SELECT * FROM polls WHERE id = :pollid";
$pollStmt = $conn->prepare($pollQuery);
$pollStmt->bindParam(':pollid', $pollid);
$pollStmt->execute();
$poll = $pollStmt->fetch();

//decode existing voted data
$voted = json_decode($poll['voted'], true);

//initialize as empty array if null
if ($voted == null) {
    $voted = array();
    }
    
    //check if user already voted
    if (in_array($_SESSION['username'], $voted)) {
        echo "<script>alert('You have already voted in this poll. You can only vote once.');</script>";
        header("Refresh: 0; url=index.php");
        exit();
    }
    
    //decode existing answers data
    $answers = json_decode($poll['answers'], true);
    
    //increment the count for the voted option
    if(isset($answers[$vote])){
    $answers[$vote] +=1;
    } else {
    $answers[$vote] = 1;
    }
    
    //add new vote to existing data
    array_push($voted, $_SESSION['username']);
    
    //encode data and update poll's answers and voted fields
    $updateQuery = "UPDATE polls SET answers = :answers, voted = :voted WHERE id = :pollid";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindValue(':answers', json_encode($answers));
    $updateStmt->bindValue(':voted', json_encode($voted));
    $updateStmt->bindParam(':pollid', $pollid);
    $updateStmt->execute();
    
    header("Location: index.php");
    ?>
    
    
