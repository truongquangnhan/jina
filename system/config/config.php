<?php
// chỉ được nhúng code không được gọi từ URL tránh hacker đọc file thông qua url
if (!defined('IN_SITE')) die ('Đường dẫn hợp lệ nhưng thực chất không hợp lệ!');
?>
<?php

// Biến lưu trữ kết nối toàn bộ project
$con = null;

// Hàm kết nối
function db_connect() {
    global $con;
    if (!$con) {
        $host = "localhost";
        $port = 3306;
        $socket = "";
        $user = "root";
        $password = "";
        $dbname = "jina";
        $con = mysqli_connect($host, $user, $password, $dbname, $port, $socket)
                or die('Could not connect to the database server' . mysqli_connect_error());
//        mysqli_set_charset($con, 'UTF-8');
    }
}

// Hàm ngắt kết nối
function db_close() {
    global $con;
    if ($con) {
        mysqli_close($con);
    }
}

// Hàm lấy danh sách, kết quả trả về danh sách các record trong một mảng  
function db_get_list($sql) {
    db_connect();
    global $con;
    $data = array();
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// Hàm lấy chi tiết, dùng select theo ID vì nó trả về 1 record
function db_get_row($sql) {
    db_connect();
    global $con;
    $result = mysqli_query($con, $sql);
    $row = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
    return $row;
}

// Hàm thực thi câu truy  vấn insert, update, delete
function db_execute($sql) {
    db_connect();
    global $con;
    return mysqli_query($con, $sql);
}

// ==============================================================================
// conect riêng của procedure tránh lỗi Fetch_assoc
// Hàm kết nối
$con2 = null;

function db_connect_procedure() {
    global $con2;
    $host = "localhost";
    $port = 3306;
    $socket = "";
    $user = "root";
    $password = "";
    $dbname = "jina";
    $con2 = mysqli_connect($host, $user, $password, $dbname, $port, $socket)
            or die('Could not connect to the database server' . mysqli_connect_error());
//    mysqli_set_charset($con2, 'UTF-8');
}

// Hàm lấy danh sách, kết quả trả về danh sách các record trong một mảng  
function db_get_list_procedure($sql) {
    global $con2;
    db_connect_procedure();
    $data = array();
    $result = mysqli_query($con2, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// Hàm lấy chi tiết, dùng select theo ID vì nó trả về 1 record
function db_get_row_procedure($sql) {
    global $con2;
    db_connect_procedure();
    $result = mysqli_query($con2, $sql);
    $row = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
    return $row;
}

// Hàm thực thi câu truy  vấn insert, update, delete
function db_execute_procedure($sql) {
    global $con2;
    db_connect_procedure();
    return mysqli_query($con2, $sql);
}

// cứ mỗi lần truy vấn xong là đóng connect lại
db_close();
?>