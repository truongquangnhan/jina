<?php define("IN_SITE", true); ?>
<?php
require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';
$us = addslashes(input_post('username'));
$ps = addslashes(input_post('password'));

foreach (db_logintaikhoan($us) as $value) {
    if ($value['psword'] == md5($ps) && $value['usname'] == $us) {
//đăng nhập đúng 
// gán session       
        session_set('ssidtk', $value['idtk']);
        session_set('ssislogin', true);
        session_set('sstaikhoan', $us);
        session_set('ssfullname', $value['hovaten']);
        session_set('sstrangthai', $value['trangthai']);
        session_set('ssquyen', $value['quyen']);
        location(create_url_site());
    } else {
        location(create_url_site('login?islogin=false'));
    }
}
location(create_url_site('login?islogin=false'));
?>