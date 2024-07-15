<?php
    session_start();
    if(!isset($_SESSION["user_session"])){
        header('location:index.php');
    }
?>
<h1>Change Password</h1><br>
<input type="button" value="Main Page" onclick="window.location.href = 'main.php'">
<form id="ChangePass" action="account.php" method="POST">
    <label>User: </label>
    <input type="text" name="user" value="<?php echo htmlspecialchars($_SESSION['user_session']); ?>" readonly><br>
    <label>Password: </label>
    <input type="password" name="pass" id="password"><br>
    <label>Re-enter Password: </label>
    <input type="password" name="repass" id="repassword"><br>
    <button type="submit" name="change">Submit</button>
</form>

<script>
document.getElementById("ChangePass").addEventListener("submit", function(event) {
    var password = document.getElementById("password").value;
    var repassword = document.getElementById("repassword").value;

    // Kiểm tra xem các trường nhập liệu có trống không
    if(password === "" || repassword === "") {
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
    if(isset($_POST["change"])){
        $pass = $_POST["pass"];
        $user = $_SESSION["user_session"];
        $query = "UPDATE account SET password = '$pass' WHERE username = '$user'";
        $conn->query($query);
        echo '<script>alert("Password update successful")</script>';
    }
?>