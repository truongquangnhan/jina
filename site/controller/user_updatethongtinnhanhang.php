<?php define("IN_SITE", true); ?>
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';
// input_post('uname') && input_post('diachi') && input_post('sdt')
if (input_post('idtk') && input_post('uname') && input_post('diachi') && input_post('sdt')) {
    $tk = addslashes(input_post('idtk'));
    $ten = addslashes(input_post('uname'));
    $diachi = addslashes(input_post('diachi'));
    $sdt = addslashes(input_post('sdt'));
    user_capnhapthongtinnhanhang($tk, $ten, $diachi, $sdt);
    location(create_url_site('sum-product'));
} else {
    location(create_url_site('update-detail-order'));
}
?>