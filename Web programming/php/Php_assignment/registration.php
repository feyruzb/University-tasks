<?php
//connect to database
$host = "sql11.freesqldatabase.com";
$dbname = "sql11591031";
$user = "sql11591031";
$pass = "KPA1mi79sI";
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

//check if form is submitted
if(isset($_POST['submit'])){
    //get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    //check for errors
    if(empty($username) || empty($email) || empty($password) || empty($password_confirm)){
        $error = "All fields are required";
    }elseif($password != $password_confirm){
        $error = "Passwords do not match";
    }else{
        //check if email is already in use
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result){
            $error = "Email is already in use";
        }else{

            //insert data into database
            $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            echo "<script>alert('You have succesfully registered.');</script>";
            header('Location:login.php');
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Registration</h1>
    <form method="post" action="">
    <div align="center">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username"><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>
        <label for="password_confirm">Confirm Password:</label>
        <input type="password" name="password_confirm" id="password_confirm"><br>
        <input class="button" type="submit" name="submit" value="Register">
        <br><a class="button" href="login.php">back to login</a>
        <?php if(isset($error)){echo "<p>$error</p>";}?>
    </div>
    </form>

</body>
</html>