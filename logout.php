<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache,must-revalidate");
?>

<?php
/**
 * Created by PhpStorm.
 * User: big94
 * Date: 2018-07-20
 * Time: 오전 2:20
 */

session_start();
$res = session_destroy();
if($res){
    echo "<script> document.location.href='/login.php'; </script>";
}
?>