<?php
session_start();
if(!isset($_SESSION["user_session"])){
    header('location:index.php');
    exit();
}
include "database.php";

if (isset($_POST['buttonPost'])) {
    if (!empty($_POST['content']) && !empty($_POST['tittle'])) {
        $content = $_POST['content'];  
        $tittle = $_POST['tittle'];
        $user = $_SESSION["user_session"];
        $conn->query("INSERT INTO post (username,postid,content,postdate,tittle) VALUES ('$user',UUID(),'$content',TIME(NOW()),'$tittle')");
        echo '<script>alert("You have successfully posted!")</script>';
    } 
}

?>
<html>
    <body>
        <input type="button" value="Log Out" onclick="window.location.href = 'logout.php'" >
        <input type="button" value="Account" onclick="window.location.href = 'account.php'" >  
        <input type="button" value="Manager" onclick="window.location.href = 'signin.php'" >  
        
        <div class = "box">
            <form id="postForm" method="POST">
                <textarea id="tittle" name="tittle" rows="1" cols="50" placeholder="Tiêu Đề" ></textarea><br>
                <textarea id="content" name="content" rows="4" cols="50" placeholder="Viết bài của bạn ở đây..."></textarea><br>
                <button type="submit" name="buttonPost">Post</button>
            </form>
        </div>
        <form method="post">
            <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
            <button type="submit" name="search">Search</button>
        </form>
        <h3 style="margin: 0;">_________________________________________________________________________________________________________________</h3>
        <a href="main.php?page=profilewall">Profile Wall</a>
        <a href="main.php?page=main">Main Wall</a>

    </body>
</html>

<script>
document.getElementById("postForm").addEventListener("submit", function(event) {
    var t = document.getElementById("tittle").value;
    var c = document.getElementById("content").value;

    // Kiểm tra xem các trường nhập liệu có trống không
    if(t === "" || c === "") {
        alert("Please enter content and tittle of the post before posting!");
        event.preventDefault(); 
    }
});
</script>

<?php
    if(isset($_GET['page'])){
        switch ($_GET['page']) {
            case 'profilewall':
                include "./wall/profilewall.php";
                break;
            case 'main':
                include "./wall/mainwall.php";
                break;
        }
    }else{
        include "./wall/mainwall.php";
    }
?>