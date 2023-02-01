<!DOCTYPE html>
<html>

<head>
	<title>Polls App</title>
</head>

<body>
	
	<h1>Try number 45</h1>
	<p>Polls.</p>
	<button style="position: absolute; top: 10px; right: 10px;">
	<a href="createpoll.php">Create Poll</a>
	<br><a href="logout.php">Logout</a></br>
	</button>
	<?php
	//check if user is logged in
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
	//query to select polls with deadline not yet expired
	$activePollsQuery = "SELECT * FROM polls WHERE deadline > CURDATE() ORDER BY createdAt DESC";
	$activePolls = $conn->query($activePollsQuery);

	//display active polls
	echo "<h2>Active Polls:</h2>";
	while ($poll = $activePolls->fetch()) {
		echo "<h3>Poll ID: " . $poll['id'] . "</h3>";
		echo "<p>Question: " . $poll['question'] . "</p>";
		echo "<p>Options: " . $poll['options'] . "</p>";
		echo "<p>Created at: " . $poll['createdAt'] . "</p>";
		echo "<p>Deadline: " . $poll['deadline'] . "</p>";
		echo "<a href='vote.php?pollid=" . $poll['id'] . "'>Vote</a>";
	}

	//query to select polls with deadline already expired
	$closedPollsQuery = "SELECT * FROM polls WHERE deadline < CURDATE() ORDER BY createdAt DESC";
	$closedPolls = $conn->query($closedPollsQuery);

	//display closed polls
	echo "<h2>Closed Polls:</h2>";
	while ($poll = $closedPolls->fetch()) {
		echo "<h3>Poll ID: " . $poll['id'] . "</h3>";
		echo "<p>Question: " . $poll['question'] . "</p>";
		echo "<p>Options: " . $poll['options'] . "</p>";
		echo "<p>Created at: " . $poll['createdAt'] . "</p>";
		echo "<p>Deadline: " . $poll['deadline'] . "</p>";
		echo "<p>Answers: " . $poll['answers'] . "</p>";
	}
	?>
</body>

</html>
