<?php define("IN_SITE", true); ?>
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';
 echo session_get('ssidtk');
if (session_get('ssidtk') != FALSE) {
    $tk = session_get('ssidtk');
    $dh = input_post('iddh');
    $tt = input_post('trangthai');
   echo 'đã vào if<br>tk:'.$tk.'<br>dh:'.$dh.'<br>tt:'.$tt.'<br>-------------';
    echo 'đã vào if<br>tk:'.$tk.'<br>dh:'.$_REQUEST['iddh'].'<br>tt:'.$_REQUEST['trangthai'].'<br>';
    // B C D F
  
        switch ($tt) {
            case 'B':
            case 'C':
            case 'D':
                shiper_update_donhang($dh, $tt);
                echo 'thành công';
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
   
} else {
    echo 'ko tìm thấy ssidtk';
}
echo 'ngoài if';
//location(create_url_site('shiper-product'));
