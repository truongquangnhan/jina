<?php define("IN_SITE", true); ?>
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';
if (isset($_POST['feed'])) {
    $feed = addslashes($_POST['feed']);
    addfeed($feed);
}
location(create_url_site());
?>