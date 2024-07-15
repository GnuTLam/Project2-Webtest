<html>
<head>
    <title>GnutLam</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php session_start(); ?>

<body>
    <h1>Hello, Welcome to my website </h1>
    <h2>This is the first time I'm creating a website</h2>
    <h2>I may encounter many problems while building this website, but I'll learn and overcome them.</h2>
    <input type="button" value="Login" onclick="window.location.href = 'login.php'" class="<?php if(isset($_SESSION["user_session"])) echo 'hidden'; else echo ''; ?>">
    <input type="button" value="Sign in" onclick="window.location.href = 'signin.php'" class="<?php if(isset($_SESSION["user_session"])) echo 'hidden'; else echo ''; ?>">
    <input type="button" value="Main Page" onclick="window.location.href = 'main.php'" class="<?php if(!isset($_SESSION["user_session"])) echo 'hidden'; else echo ''; ?>">
    <input type="button" value="Logout" onclick="window.location.href = 'logout.php'" class="<?php if(!isset($_SESSION["user_session"])) echo 'hidden'; else echo ''; ?>">
</body>
</html>
