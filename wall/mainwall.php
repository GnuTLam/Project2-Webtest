<?php
    session_start();
    if(!isset($_SESSION["user_session"])){
        header("location:login.php");
        exit();
    }
    include "database.php";
    include "post.php";
    $arrpost = getifpost();
    if(isset($_POST["setting"])){ 
        $id=$_POST["setting"];
        header("Location: wall/setting.php?post_id=$id");
        exit(); 
    }
?>

<?php
    if(isset($_POST["search"])) {
        $keyword = $_POST["keyword"];
        if(!empty($keyword)) {
            $sql = "SELECT * FROM post WHERE tittle LIKE '%$keyword%'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $datatemmp = new mypost($row["postid"], $row["content"], $row["postdate"], $row["username"],$row['tittle']);
                    $data[] = $datatemmp;
                }
                generatePostsHtml($data);
            } 
            else {
                echo "No posts found.";
            }
        } 
    } 
?>


<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php if(!isset($_POST["search"]) || empty($_POST["keyword"])) generatePostsHtml($arrpost); ?>
</body>
</html>
