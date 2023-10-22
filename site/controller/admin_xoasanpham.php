<?php define("IN_SITE", true); ?>
<?php

require '../../system/library/getpost.php';
require '../../system/library/session.php';
require '../model/model_db.php';
if (!empty(input_get('iddt'))) {
    $iddt = addslashes(input_get('iddt'));
    delete_admin_xoasanpham($iddt);
    location(create_url_site('admin-list-product'));
    //location("http://localhost/jina/site/view/admin_all_sanpham.php");
} else {
    location(create_url_site('admin-list-product'));
}
location(create_url_site('admin-list-product'));
