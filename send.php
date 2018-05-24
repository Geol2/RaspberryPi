
<?php
// AMQP를 이용하여 아두이노에서 받은 데이터를 받아 서버로 전송하는 코드.
// usercode를 전역, 글로벌 변수로 만들어 한 번만 접근할 수 있게 만들어 보자.
// sfCode를 이용하여 날짜, 시간
// 시간 관련되서 1. 날짜, 데이터 같이 보냄. 2.데이는 일단 받아서 내가 날짜데이터를 추가해서 웹서버로 전송.
// sf

    require_once __DIR__ . '/vendor/autoload.php';
    use PhpAmqpLib\Connection\AMQPStreamConnection;
    use PhpAmqpLib\Message\AMQPMessage;

    define("HOST", "203.250.32.157"); //수정가능성이 있음.
    define("PORT", 5672);
    define("USER", "manager");
    define("PASS", "manager");

    $db_host = "localhost";
    $db_user = "root";
    $db_passwd = "619412";
    $db_name = "water_middle_server";

    $link = mysqli_connect($db_host, $db_user, $db_passwd, $db_name);

    /* check connection */
    if ( mysqli_connect_errno() ) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $query = "SELECT * FROM Sys_info";
    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_array($result, MYSQLI_BOTH);

    $user_code = $row['USER_CODE'];

    date_default_timezone_set('Asia/Seoul'); // 분침 -30분 문제..
    $current_time = date("Y/m/d/H/i"); //날짜 시간 추가..
    //echo $current_time; //시간 출력.
    $year = date("Y"); // 년
    $month = date("m"); // 월
    $day = date("d"); // 일
    $hour = date("H"); // 시
    $minute = date("i"); // 분

    // ampq //
    $connection = new AMQPStreamConnection(HOST, PORT, USER, PASS);

    $channel = $connection->channel();

    //mysql - ampq
    $id = $user_code; //user_code 로 변경.

    $temp = ['id'=> $id, 't'=> $_GET['t'], 'h'=> $_GET['h'], 'wt'=> $_GET['wt'], 'wl'=> $_GET['wl'], 'e'=> $_GET['e'], 'd'=> $current_time];
    //get arduino data..

    $data = json_encode($temp);
    echo $data;

    $msg = new AMQPMessage( $data, [
            'content_type' => 'application/json',
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_NON_PERSISTENT
    ]);

    $channel->basic_publish( $msg, 'amq.direct', 'foo.bar');

    $channel->close();
    $connection->close();

    mysqli_free_result($result);
    mysqli_close($link);

    echo 'OK';
?>
