<?php
/**
 * Created by PhpStorm.
 * User: big94
 * Date: 2018-08-22
 * Time: 오전 7:29
 */
    require_once __DIR__ .'/config_db.php';
    require_once __DIR__ .'/connect_inner_ip.php';

    $ip = $_SERVER['REMOTE_ADDR'];

    $query_add_device = "DELETE FROM PRODUCT_INFO WHERE INNER_IP = $ip";
    $result = $conn->query($query_add_device);

    if($result) {
        echo "<script>location.replace('/main.php');</script>";
    }
    else{
        echo "<script>alert('삭제할 수 없습니다.');</script>";
        echo "<script>location.replace('/main.php');</script>";
}
?>