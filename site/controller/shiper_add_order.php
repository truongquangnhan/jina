<?php define("IN_SITE", true); ?>
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';
if (session_get('ssidtk')) {
    if (input_get('dh')) {
        $dh = input_get('dh');
        $tk = session_get('ssidtk');
        addproductforshiper($dh, $tk);
        location(create_url_site('shiper-index'));
    }
}
location(create_url_site('shiper-index'));



