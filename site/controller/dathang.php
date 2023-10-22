<?php define("IN_SITE", true); ?>
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';
//1 kiểm tra số lượng còn hàng hay k
//1 nếu còn hàng
//  2 tiến hành đặt hàng 
//  2 nếu đặt hàng thành công
//      3 trừ số lượng sản phẩm
//      3 trừ thành công => thông báo đặt hàng thành công
//      3 trừ thất bại => thông báo đặt hàng không thành công
//  2 đặt hàng thất bại => thông báo đơn hàng không thành công
//1 hết hàng => thông báo hết hàng
$idtk = session_get("ssidtk");
$iddh = addslashes(input_get('iddh'));
$next = true;
$isfinish = false;
//1 kiểm tra số lượng còn hàng hay k
foreach (getiddtandsoluong($iddh) as $value) {
    if (checksoluong((int)$value['iddt'], (int)$value['soluong'])['conhang'] == "1") {
        $next = true;
    } else {
        $next = false;
        break;
    }
}
// sau khi kiểm tra thấy còn hàng
if ($next) {
    // kiểm tra có tồn tại đơn hàng nào đang chờ hay không
    $chektontai = 0;

    foreach (checkdonhang($iddh, $idtk) as $vl) {
        $chektontai = $vl['xx'];
    }
    if ($chektontai == 1) {
        // tiến hành đặt hàng
        $isfinish = datdonhang($iddh, $idtk);
        // nếu đặt hàng thành công
        if ($isfinish == 1) {
            foreach (getiddtandsoluong($iddh) as $value) {
                // tiến hành trừ số lượng
                trusoluong($value['iddt'], $value['soluong']);
            }
            location(create_url_site('result-status-order?isfinish=gg'));
            //location("http://localhost/jina/site/view/user_thongbaodonhangthanhcong.php?isfinish=gg");
        } else {
            location(create_url_site('result-status-order?isfinish=fail'));
        }
    } else {
        // thông báo đã tồn tại 1 đơn hàng bạn chưa nhận
        // nhận đơn hàng đó rồi mới có thể đặt hàng tiếp
        location(create_url_site('result-status-order?isfinish=no'));
    }
}
// sau khi kiểm tra thấy hết hàng
else {
    location(create_url_site('result-status-order?isfinish=hh'));
}
// mọi lỗi phát sinh thông báo đặt hàng thất bại lỗi hệ thống
location(create_url_site('result-status-order?isfinish=gg'));
// request 
// gg: đơn hàng thành công
// fail: đơn hàng thất bại lỗi hệ thống
// no: đã tồn tại 1 đơn hàng vui lòng nhận đơn sau đó đặt lại
// hh: số lượng sản phẩm tạm hết vui lòng đặt lại sau
?>