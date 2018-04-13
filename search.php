<?php
	$db_host = "localhost";
	$db_user = "root";
	$db_passwd = "619412";
	$db_name = "water_middle_server";

	$conn = mysqli_connect($db_host, $db_user, $db_passwd, $db_name) or die("Connected Failed!!!!");

	$query = "SELECT INNER_IP FROM product_info ";
	$result = mysqli_query($conn, $query) or die ('Error Querying database.');

	while($row = mysqli_fetch_array($result)) {
		$INNER_IP = $row['INNER_IP'];
	}

?>


<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
	header('Content-Type: application/json');

	$str1 = file_get_contents('/var/www/html/user_code.json');

	$json = json_decode($str1, true);

	$res = 'OK';
	if( array_key_exists("user_code", $json) ){
		 $res = 'FAIL';
	}
	$data = ['state'=> $res ,'ssid' => 'pi3-ap' ,'inner_ip' => ['192.168.4.2' , '192.168.4.3'] ];
	echo json_encode($data);
?>
