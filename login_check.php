<?php
/**
 * Created by PhpStorm.
 * User: big94
 * Date: 2018-07-20
 * Time: 오전 1:43
 */
include("config_db.php");

session_start();

$id = $_POST['id'];
$pwd = md5($_POST['pwd']);

$check = "SELECT * FROM LOGIN_INFO WHERE id='$id'";
$result = $conn->query($check);

if($result -> num_rows == 1){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if($row['userpwd'] == $pwd){
        $_SESSION['userid'] = $id;

        if(isset($_SESSION['userid']))
        {
            header('Location: ./main.php'); //로그인 성공시 페이지 이동.
        }
        else {
            echo "세션 저장 실패";
        }
    }
    else
        {
        echo "틀린 id나 패스워드";
    }
}
else {
    echo "틀린 id나 패스워드1";
}

?>