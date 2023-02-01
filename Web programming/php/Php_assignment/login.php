<link rel="stylesheet" type="text/css" href="style.css">
<div class="center">
  <form method="post" action="login.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <br><br>
    <input class="button" type="submit" value="Login">
    <br><a class="button" href="registration.php">Sign Up</a>
  </form> 
</div>
<?php
  //connect to database
  $host = "sql11.freesqldatabase.com";
  $dbname = "sql11591031";
  $user = "sql11591031";
  $pass = "KPA1mi79sI";
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

  if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch();

    // checks if session is already started and if not starts it
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
    
    if($result){
        //login success
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        if($result['is_admin'] == 1){
            $_SESSION['admin'] = true;
        }
        header('Location:index.php');
    }else{
        //login failed
        echo '<div align="center">Invalid username or password</div>';
    }
  }
?>
