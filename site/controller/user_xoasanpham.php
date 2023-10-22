<?php define("IN_SITE", true); ?>
<?php
require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';
$dh = addslashes(input_get('donhang'));
$dt = addslashes(input_get('dienthoai'));
user_xoasanphamtrongdanhsach($dh,$dt);
location(create_url_site('sum-product'));

?>