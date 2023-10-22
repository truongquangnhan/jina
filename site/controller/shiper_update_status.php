<?php define("IN_SITE", true); ?>
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';
if (session_get('ssidtk') != FALSE) {
    $tk = session_get('ssidtk');
    $dh = input_post('iddh');
    $tt = input_post('trangthai');
    // B C D F
    try {
        switch ($tt) {
            case 'B':
            case 'C':
            case 'D':
                shiper_update_donhang($dh, $tt);

                break;
            case 'F':
                foreach (getiddtandsoluong($dh) as $value) {
                    // tiến hành cộng lại số lượng cho từng sản phẩm khách đặt
                    congsoluong($value['iddt'], $value['soluong']);
                }
                shiper_update_donhang($dh, $tt);
                break;
            default:
                break;
        }
    } catch (Exception $exc) {
        
    }
} else {
  
}
location(create_url_site('shiper-product'));
