<?php
    include "../database.php";
    include "post.php";
    session_start();
    if(!isset($_SESSION["user_session"])){
        header("location:login.php");
        exit();
    }
    $id=$_GET['post_id'];// này thì thằng nào cũng có thể truy cập và sửa thông tin đc
    if($id == NULL || $id=="") {
        header("location:../main.php");
        exit();
    }
    $result = $conn->query("SELECT * FROM post WHERE postid = '$id'");
    while ($row = $result->fetch_assoc()) {
        $post = new mypost($row["postid"], $row["content"], $row["postdate"], $row["username"],$row['tittle']);
    }
    if(isset($_POST['change'])){
        $b=$_POST['ptittle'];
        $c=$_POST['pcontent'];
        if($conn->query("UPDATE post SET tittle ='$b',content = '$c',postdate =TIME(NOW()) WHERE post.postid = '$id';")===true){
            echo "Update complete";
        }
        else{
            echo "Something was wrong! Please try again.";
        }
    }
    else if(isset($_POST['delete'])){
        if($conn->query("DELETE FROM post WHERE postid = '$id'")===true){
            header("Location: ../main.php");
            exit();
        };
    }
?>

<form method="post">
    <input type="text" name="user" value="<?php echo $post->user; ?>" readonly><br>
    <input type="text" name="pdate" value="<?php echo $post->post_time;?>" readonly><br>
    <textarea name="ptittle" rows="1" cols="50"><?php echo $post->tittle;?></textarea><br>
    <textarea name="pcontent" rows="4" cols="50"><?php echo $post->content;?></textarea><br>
    <button name="delete">Delete</button>
    <button name="change">Change</button>
</form>

<?php
    header("Refresh:1");
    exit();
?>