<?php define("IN_SITE", true); ?>
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';
$dh = addslashes(input_post('madh'));
$dt = addslashes(input_post('madt'));
user_tangsl($dh, $dt);
foreach (user_viewsl($dh, $dt) as $value) {
    echo $value;
}
?>
