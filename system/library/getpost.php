<?php
// chỉ được nhúng code không được gọi từ URL tránh hacker đọc file thông qua url
if (!defined('IN_SITE')) die ('Đường dẫn hợp lệ nhưng thực chất không hợp lệ bạn ơi c');
?>
<?php

// Hàm lấy value từ $_POST
function input_post($key) {
    return isset($_POST[$key]) ? trim($_POST[$key]) : false;
}

// Hàm lấy value từ $_POST default null
function input_postdf($key) {
    return isset($_POST[$key]) ? trim($_POST[$key]) : "";
}

// Hàm lấy value từ $_GET
function input_get($key) {
    return isset($_GET[$key]) ? trim($_GET[$key]) : false;
}

// Hàm tạo URL
function create_url_site($uri = '') {
    return 'http://localhost/jina/' . $uri;
}

function create_url_admin($uri = '') {
    return 'http://localhost/jina/' . $uri;
}

// Hàm redirect
function location($url) {
    header("Location:{$url}");
    exit();
}

?>
