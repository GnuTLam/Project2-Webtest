<h1>Sign In</h1><br>
<input type="button" value="Login" onclick="window.location.href = 'login.php'">
<form id="signInForm" action="signin.php" method="POST">
    <label>User: </label>
    <input type="text" name="user" id="username"><br>
    <label>Password: </label>
    <input type="password" name="pass" id="password"><br>
    <label>Re-enter Password: </label>
    <input type="password" name="repass" id="repassword"><br>
    <button type="submit" name="signin">Submit</button>
</form>

<script>
document.getElementById("signInForm").addEventListener("submit", function(event) {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var repassword = document.getElementById("repassword").value;

    // Kiểm tra xem các trường nhập liệu có trống không
    if(username === "" || password === "" || repassword === "") {
        alert("Please fill in all the required information.");
        event.preventDefault(); 
    }
    // Kiểm tra xem mật khẩu có ít nhất 8 ký tự hay không
    else if(password.length < 8) {
        alert("Password must be at least 8 characters long.");
        event.preventDefault(); 
    }    
    // Kiểm tra xem mật khẩu đã được nhập đúng hay không
    else if(password !== repassword) {
        alert("Passwords do not match. Please re-enter your password.");
        event.preventDefault(); 
    }
});
</script>

<?php
include "database.php";
if(isset($_SESSION["user_session"])) header('location:main.php');
if(isset($_POST['signin'])){
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    $query = "SELECT * FROM account WHERE username = '$user'";
    $result = $conn->query($query);
    if($result->num_rows > 0) {
        echo "<script>alert('Username already exists. Please choose a different username.')</script>";
    } 
    else {
        $query = "INSERT INTO account (username, password) VALUES ('$user', '$pass')";
        if($conn->query($query) === TRUE) {
            echo "<script>alert('User registered successfully!')</script>";
        } 
        else {
            echo "<script>alert('Error: Unable to register user. Please try again later.')</script>";
        }
    }
}
?>
