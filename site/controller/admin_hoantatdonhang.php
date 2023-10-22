<?php define("IN_SITE", true); ?>
<?php

require '../../system/library/getpost.php';
require '../../system/library/session.php';
require '../model/model_db.php';
if (input_get('dh')) {
    update_hoangtatdonhang_admin(input_get('dh'));
    location(create_url_site('admin-index'));
} else {
    location(create_url_site('admin-index'));
}
location(create_url_site('admin-index'));

