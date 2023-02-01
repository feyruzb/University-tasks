<?php
$places = [
	'Írottkő',
	'Sárvár',
	'Sümeg',
	'Keszthely',
	'Tapolca',
	'Badacsonytördemic',
	'Nagyvázsony',
	'Városlőd',
	'Zirc',
	'Bodajk',
	'Szárliget',
	'Dorog',
	'Piliscsaba',
	'Hűvösvölgy',
	'Rozália téglagyár',
	'Dobogókő',
	'Visegrád',
	'Nagymaros',
	'Nógrád',
	'Becske',
	'Mátraverebély',
	'Mátraháza',
	'Sirok',
	'Szarvaskő',
	'Putnok',
	'Aggtelek',
	'Bódvaszilas',
	'Boldogkőváralja',
	'Sátoraljaújhely',
	'Hollóháza'
];

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$trackname = $_GET["trackname"];
	$from = $_GET["from"];
	$to = $_GET["to"];
	$distance = $_GET["distance"];
	$time = $_GET["time"];


	if (empty($trackname)) {
		$errors["trackname"] = "The trackname field is required.";
	}

	if (empty($distance)) {
		$errors["distance"] = "The distance field is required.";
	} elseif (!is_numeric($distance)) {
		$errors["distance"] = "The distance field must be a number.";
	}
	//validate from and to "start"
	if (empty($from)) {
		$errors["from"] = "The from field is required.";
	} elseif (!in_array($from, $places)) {
		$errors["from"] = "Invalid settlement name in the from field.";
	}
	if (empty($to)) {
		$errors["to"] = "The to field is required.";
	} elseif (!in_array($to, $places)) {
		$errors["to"] = "Invalid settlement name in the to field.";
	} elseif ($from == $to) {
		$errors["to"] = "The from and to fields cannot match.";
	}
	//validate from and to "end"
	if (empty($time)) {
		$errors["time"] = "The time field is required.";
	} else {
		$time_parts = explode(':', $time);
		if (count($time_parts) != 2 || !is_numeric($time_parts[0]) || !is_numeric($time_parts[1]) || $time_parts[0] > 7 || $time_parts[1] >= 60) {
			$errors["time"] = "The time field must be in the format X:XX where the Xs are digits. The highest allowed value before the colon (:) is 7, and the value after it must be less than 60.";
		}
	}
	if (empty($errors)) {
		$success = true;
	}
}		
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Task 2</title>
</head>
<body>
    <h1>Task 2: Trip registration</h1>
    <form action="index.php" method="get" novalidate>
        <label for="i1">Track name:</label> <input type="text" name="trackname" id="i1" value="<?= $trackname ?>"> 
        <?php if(isset($errors["trackname"])): ?>
            <span style="color:red;">* <?= $errors["trackname"] ?></span>
        <?php endif; ?>
        <br>
        <label for="i2">From:</label> <input type="text" name="from" id="i2" value="<?= $from ?>"> 
        <?php if(isset($errors["from"])): ?>
            <span style="color:red;">* <?= $errors["from"] ?></span>
        <?php endif; ?>
        <br>
        <label for="i3">To:</label> <input type="text" name="to" id="i3" value="<?= $to ?>"> 
        <?php if(isset($errors["to"])): ?>
            <span style="color:red;">* <?= $errors["to"] ?></span>
        <?php endif; ?>
        <br>
        <label for="i4">Distance:</label> <input type="text" name="distance" id="i4" value="<?= $distance ?>"> 
        <?php if(isset($errors["distance"])): ?>
            <span style="color:red;">* <?= $errors["distance"] ?></span>
        <?php endif; ?>
        <br>
        <label for="i5">Time:</label> <input type="text" name="time" id="i5" value="<?= $time ?>"> 
        <?php if(isset($errors["time"])): ?>
            <span style="color:red;">* <?= $errors["time"] ?></span>
        <?php endif; ?>
        <br>
        <button type="submit">Register</button>
    </form>
    <?php if($success): ?>
        <div id="success">
            <h2>Trip data saved!</h2>
        </div>
    <?php endif; ?>


    <h2>Hyperlinks for testing</h2>
    <a href="index.php?trackname=&from=&to=&distance=&time=">trackname=&from=&to=&distance=&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=&to=&distance=&time=">trackname=10.sz.+túra&from=&to=&distance=&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Budapest&to=&distance=&time=">trackname=10.sz.+túra&from=Budapest&to=&distance=&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=&distance=&time=">trackname=10.sz.+túra&from=Sárvár&to=&distance=&time=</a><br>
	<a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Sárvár&distance=&time=">trackname=10.sz.+túra&from=Sárvár&to=Sárvár&distance=&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=&time=">trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=ezer&time=">trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=ezer&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=">trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=10">trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=10</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=10%3A60">trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=10%3A60</a><br>
    <a href="index.php?trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=4%3A10"><span style="color: green">Correct input: </span>trackname=10.sz.+túra&from=Sárvár&to=Dobogókő&distance=1000&time=4%3A10</a><br>

    </body>
</html>
