<?php define("IN_SITE", true); ?>
<?php
require_once '../../system/library/getpost.php';
session_start();
session_destroy();
location(create_url_site());
?>

