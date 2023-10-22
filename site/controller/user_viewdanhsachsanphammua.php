<?php define("IN_SITE", true); ?>
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';

function user_print_allcart($idtk) {
    $idtk2 = '';
    $iddh = '';
    $iddt = '';
    $hoten = '';
    $diachi = '';
    $sdt = '';
    $tongtien = 0;
    echo '<div class="col-lg-10 offset-lg-1 col-12 offset-0 ">';
    echo ' <div class="row bg-warning">
                                <div class="col-3">Product</div>
                                <div class="col-2">P-type</div>
                                <div class="col-2">Amount</div>
                                <div class="col-3">Price</div>
                                <div class="col-2">Manipu..</div>
          </div>';
    foreach (user_viewdanhsachspmua($idtk) as $value) {
        // tendt,dt.loaimay,ctdh.soluong,ctdh.giaxuathoadon
        $hoten = $value['tennguoinhan'];
        $diachi = $value['diachinhan'];
        $sdt = $value['sdtnhan'];
        echo ' <div class="row ">
                                <div class="col-3">' . $value['tendt'] . '</div>
                                <div class="col-2">' . $value['loaimay'] . '</div>
                                <div class="col-2">' . $value['soluong'] . '</div>
                                <div class="col-3">' . $value['giaxuathoadon'] . '<sup>đ</sup></div>
                                <div class="col-2">                                   
                                    <a class="btn btn-sm btn-secondary" href="#"><i class="far fa-trash-alt"></i></a>
                                </div>
           </div> ';
        $tongtien = $tongtien + $value['soluong'] * $value['giaxuathoadon'];
    }

    echo '"<div class="row ">
                                <div class="col-3"> </div>
                                <div class="col-2"> </div>
                                <div class="col-2 bg-warning">Tổng:</div>
                                <div class="col-3 bg-warning">' . number_format($tongtien) . '<sup>đ</sup></div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row bg-warning " style="margin-top: 20px">
                                <div class="col-12"> Thông tin giao hàng <a class="btn btn-sm text-success" href="'. create_url_site('update-detail-order').'">[Thay đổi thông tin giao hàng]<i class="fas fa-edit"></i></a></div>                                
                            </div>
                            <div class="row">
                                <div class="col-3">Người nhận:</div>
                                <div class="col-8">' . $hoten . '</div>
                                <div class="col-3">Địa chỉ:</div>
                                <div class="col-8">' . $diachi . '</div> 
                                <div class="col-3">Số điện thoại:</div>
                                <div class="col-8">' . $sdt . '</div>


                            </div>
                            <div class="row bg-warning">
                                <div class="col-lg-2 offset-lg-5 col-4 offset-4  ">                                    
                                        <a class="btn btn-sm btn-dark text-center" href=""><i class="fas fa-arrow-alt-circle-right text-warning"></i> Đặt Hàng <i class="fas fa-arrow-alt-circle-right text-warning"></i></a>                                    
                                </div>
                            </div>';
 
    echo '</div>';
}

?>