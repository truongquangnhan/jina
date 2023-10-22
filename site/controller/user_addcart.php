<?php define("IN_SITE", true); ?>
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';
if (input_get('tk') && input_get('sp')) {
    $tk = addslashes(input_get('tk'));
    $sp = addslashes(input_get('sp'));
    // gọi hàm add sản phẩm vào giỏ hàng
    user_addsanphamvaogiohang($tk, $sp);
    location(create_url_site());
} else {
    location(create_url_site());
}
?>