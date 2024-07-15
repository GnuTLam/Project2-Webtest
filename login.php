<h1>Login</h1><br>
<input type="button" value="Sign in" onclick="window.location.href = 'signin.php'">
<form action="login.php" method="POST">
    <label>User: </label>
    <input type="text" name="user"><br>
    <label>Password: </label>
    <input type="password" name="pass"><br>
    <button type="submit" >Submit</button>
</form>

<?php
    session_start();
    include "database.php";
    if(isset($_SESSION["user_session"])) header('location:main.php');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user=$_POST["user"];
        $pass=$_POST["pass"];

        $query = "SELECT * FROM account WHERE binary(username) = '$user' AND binary(password) = '$pass'";
        var_dump($query);
        $result = $conn->query($query);
        if($result->num_rows == 1){
            $_SESSION["user_session"]=$user;
            header('location:main.php');
            var_dump($_SESSION["user_session"]);
            exit();
        }
        else{
            echo 'Username or Password is not correct'.'<br>';
            echo 'If you don\'t have an account, <a href="signin.php">click here</a> to sign in.';
        }
    }
?>
