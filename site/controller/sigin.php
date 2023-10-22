<?php define("IN_SITE", true); ?>
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';
// usname,psword,sdt,anhnen,hovaten,diachi,email
$us = addslashes(input_post('username'));
$ps = addslashes(input_post('password'));
$fname = addslashes(input_post('fname'));
$dc = addslashes(input_post('diachi'));
$sdt = addslashes(input_post('sdt'));
$email = addslashes(input_post('email'));
$img = '';
if (empty(db_sigintaikhoan($us))) {
    dangki($us, $ps, $sdt, $fname, $dc, $email);
    location(create_url_site('login'));
} else {
    location(create_url_site('sigin?isSigin=usnamefail'));
}
location(create_url_site('sigin?isSigin=fail'));
?>