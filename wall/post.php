<?php
function getifpost($user="") {
    include "database.php";
    $posts = array();
    if($user == "") $result = $conn->query("SELECT * FROM post ORDER BY RAND() LIMIT 15");
    else $result = $conn->query("SELECT * FROM post WHERE username = '$user' ORDER BY postdate DESC LIMIT 10");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $post = new mypost($row["postid"], $row["content"], $row["postdate"], $row["username"],$row['tittle']);
            $posts[] = $post;
        }
    } 
    return $posts;
}

class mypost {
    public $post_id;
    public $content;
    public $post_time;
    public $tittle;
    public $user;
  
    // Constructor
    function __construct($post_id, $content, $post_time, $user, $tittle) {
        $this->post_id = $post_id;
        $this->content = $content;
        $this->post_time = $post_time;
        $this->user = $user;
        $this->tittle = $tittle;
    }

    function info_user(){
        return $this->user;
    }
    function info_content(){
        return $this->content;
    }
    function info_tittle(){
        return $this->tittle;
    }
    function info_posttime(){
        return $this->post_time;
    }
    function changecontent($newcontent){
        $this->content=$newcontent;
    }
}

function auth_id($str){
    include "database.php";
    $usr = $_SESSION["user_session"];
    $result = $conn->query("SELECT * FROM manager WHERE binary(admin) = '$usr'");
    if($result->num_rows == 1) return true;
    if($str == $usr) return true;
    return false;
}

function generatePostsHtml($arrpost) {
    $html = '';
    foreach ($arrpost as $post) {
        $html .= '<div class="post-container">';
        $html .= '<div class="post">';
        if (auth_id($post->user)) {
            $html .= '<form method="post">';
            $html .= '<button type="submit" name="setting" value="' . $post->post_id . '">Setting</button>';
            $html .= '</form>';
        }
        $html .= '<div class="post-user">' . $post->user . '</div>';
        $html .= '<div class="post-time">Time: ' . $post->post_time . '</div>';
        $html .= '<div class="post-tittle">' . $post->tittle . '</div>';
        $html .= '---------------------------------';
        $html .= '<div class="post-content">';
        $html .= '<p>' . $post->content . '</p>';
        $html .= '</div>';                
        $html .= '</div>';
        $html .= '</div>';
    }
    echo $html;
}

?>