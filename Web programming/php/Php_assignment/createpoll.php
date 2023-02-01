<!DOCTYPE html>
<html>

<head>
    <title>Create Poll</title>
</head>

<body>
    <button style="position: absolute; top: 10px; right: 10px;">
        <a href="index.php">Back</a>
    </button>
    <h1>Create a new poll</h1>
    <?php
    //check if user is logged in
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
    //form submission
    if (isset($_POST['question']) && isset($_POST['options']) && isset($_POST['isMultiple']) && isset($_POST['deadline'])) {
        //get form data
        $question = $_POST['question'];
        $options = $_POST['options'];
        $isMultiple = $_POST['isMultiple'];
        $deadline = $_POST['deadline'];
        $createdAt = date('Y-m-d');

        //insert poll into database
        $insertQuery = "INSERT INTO polls (question, options, isMultiple, createdAt, deadline) VALUES (:question, :options, :isMultiple, :createdAt, :deadline)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bindParam(':question', $question);
        $insertStmt->bindParam(':options', $options);
        $insertStmt->bindParam(':isMultiple', $isMultiple);
        $insertStmt->bindParam(':createdAt', $createdAt);
        $insertStmt->bindParam(':deadline', $deadline);
        $insertStmt->execute();

        echo "<p>Poll created successfully!</p>";
    }
    ?>
    <form action='createpoll.php' method='post'>
        <p>Poll question:</p>
        <input type='text' name='question'>
        <p>Poll options:</p>
        <p>They should be presented in form like ["chouce1", "choice2"] for beinge readable for program</p>
        <textarea name='options'></textarea>
        <br>
        <p>Allow multiple options:</p>
        <input type='radio' name='isMultiple' value='1'>Yes
        <input type='radio' name='isMultiple' value='0'>No
        <p>Voting deadline:</p>
        <input type='date' name='deadline'>
        <br>
        <input type='submit' value='Create Poll'>
    </form>
</body>

</html>