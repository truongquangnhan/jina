
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';

function printdetailcart($idtk) {
    $stt = 1;
    foreach (user_viewgiohang($idtk) as $value) {
        echo ' <div class="row">            
                        <div class="col-lg-5 col-sm-12 col-12 ">
                            <div class="row">
                                <div class="col-10 offset-1 ">
                                    <img class="img-thumbnail col-sm-11 col-10 img  img-responsive  rounded mx-auto d-block" src="' . $value['hinhanh'] . '" alt=""/>
                                </div>                       
                            </div>                  
                        </div>
                        <div class="col-lg-7 col-sm-12 col-12 text-sm ">
                            <table class="table ">
                                <tr class="bg-warning text-white">
                                    <th ><p class="h6">' . $value['tendt'] . '</p></th>
                                    <td class="h6">' . number_format($value['giaban']) . '<sup>đ </sup>[' . $value['loaimay'] . ']</td>
                                </tr>
                                <tr>
                                    <th scope="row">Thương hiệu:</th>
                                    <td>' . $value['hangdt'] . '</td>
                                </tr>
                                <tr>
                                    <th scope="row">Hệ điều hành:</th>
                                    <td>' . $value['hedieuhanh'] . '</td>
                                </tr>
                                <tr>
                                    <th scope="row">Phiên bản:</th>
                                    <td>' . $value['phienban'] . '</td>
                                </tr>

                                <tr>
                                    <th scope="row" >
                                        Số lượng
                                    </th>
                                    <td class="text-center">
                                        <div class="input-group container" >
                                            <div class="row " style="min-width: 150px; ">
                                                <span class="input-group-btn"> 
                                                    <button type="button" class="btn btn-sm btn-danger btn-number" data-type="minus" id="giam' . $stt . '"> 
                                                        <span class="fa fa-chevron-left"></span> 
                                                    </button>
                                                </span>
                                                <p id="load' . $stt . '" class="h6 " style="min-width: 40px;min-height:30px; line-height:30px">' . $value['soluong'] . '</p>
                                                
                                                <span class="input-group-btn">    
                                                    <button type="button" class="btn btn-sm btn-success btn-number" data-type="plus" id="tang' . $stt . '"> 
                                                        <span class="fa fa-chevron-right"></span> 
                                                    </button>
                                                </span>                                         
                                            </div>
                                        </div> 
                                    </td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                    </div>';
        echo ' <script >
                                        $(document).ready(function () {
                                            var iddt = ' . $value['iddt'] . ';
                                            var iddh = ' . $value['iddh'] . ';
                                            $("#tang' . $stt . '").click(function () {
                                                $("#load' . $stt . '").load("site/controller/ajaxtang.php", {
                                                    madh: iddh,
                                                    madt: iddt

                                                });
                                            });
                                        });
                                        $(document).ready(function () {
                                            var iddt = ' . $value['iddt'] . ';
                                            var iddh = ' . $value['iddh'] . ';
                                            $("#giam' . $stt . '").click(function () {
                                                $("#load' . $stt . '").load("site/controller/ajaxgiam.php", {
                                                    madh: iddh,
                                                    madt: iddt

                                                });
                                            });
                                        });
                                        </script>';
        $stt = $stt + 1;
    }
}

function user_print_allcart($idtk) {
    $idtk2 = '';
    $iddh = '';
    $iddt = '';
    $hoten = '';
    $diachi = '';
    $sdt = '';
    $tongtien = 0;
    $stt = 1;
    echo '<div class="col-lg-10 offset-lg-1 col-12 offset-0 ">';
    echo ' <div class="row bg-warning">
                                <div class="col-3">Product</div>
                                <div class="col-2">P-type</div>
                                <div class="col-2">Amount</div>
                                <div class="col-4 text-center">Price</div>
                                <div class="col-1 text-center">#</div>
          </div>';
    foreach (user_viewdanhsachspmua($idtk) as $value) {
        // tendt,dt.loaimay,ctdh.soluong,ctdh.giaxuathoadon
        $hoten = $value['tennguoinhan'];
        $diachi = $value['diachinhan'];
        $sdt = $value['sdtnhan'];
        $iddh = $value['iddh'];
        echo ' <div class="row"';
        if ($stt % 2 == 0) {
            echo 'style="background-color: #ccffcc;"';
        } echo '>
                                <div class="col-3">' . $value['tendt'] . '</div>
                                <div class="col-2">' . $value['loaimay'] . '</div>
                                <div class="col-2">' . $value['soluong'] . '</div>
                                <div class="col-4 text-center w-100">' . number_format($value['giaxuathoadon']) . '<sup>đ</sup>
                                    = ' . number_format($value['giaxuathoadon'] * $value['soluong']) . '
                                </div>
                                <div class="col-1 text-center">                                   
                                    <a class="btn btn-sm btn-secondary" href="'. create_url_site('ctl-view-list-product-order?donhang=' . $value['iddh'] . '&dienthoai=' . $value['iddt']).'"><i class="far fa-trash-alt"></i></a>
                                </div>
           </div> ';
        $tongtien = $tongtien + $value['soluong'] * $value['giaxuathoadon'];
        $stt++;
    }

    echo '<div class="row ">
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
                                        <a class="btn btn-sm btn-dark text-center" href="'. create_url_site('ctl-order?iddh=' . $iddh).'"><i class="fas fa-arrow-alt-circle-right text-warning"></i> Đặt Hàng <i class="fas fa-arrow-alt-circle-right text-warning"></i></a>                                    
                                </div>
                            </div>';






    echo '</div>';
}

// view danh sách sản phẩm thông tin đươn hàng đã mua
function user_print_allcart_detail($idtk) {
    $idtk2 = '';
    $iddh = '';
    $iddt = '';
    $hoten = '';
    $diachi = '';
    $sdt = '';
    $tongtien = 0;
    echo '<div class="col-lg-10 offset-lg-1 col-12 offset-0 ">';
    echo ' <div class="row bg-info">
                                <div class="col-3 text-center">Product</div>
                                <div class="col-2">P-type</div>
                                <div class="col-1 text-center">Amount</div>
                                <div class="col-3 text-center">Price</div>
                                <div class="col-3 w-100 text-center">Into money</div>
          </div>';
    foreach (user_viewdanhsachspdadat($idtk) as $value) {
        // tendt,dt.loaimay,ctdh.soluong,ctdh.giaxuathoadon
        $hoten = $value['tennguoinhan'];
        $diachi = $value['diachinhan'];
        $sdt = $value['sdtnhan'];
        $iddh = $value['iddh'];
        echo ' <div class="row ">
                                <div class="col-3 ">' . $value['tendt'] . '</div>
                                <div class="col-2">' . $value['loaimay'] . '</div>
                                <div class="col-1">' . $value['soluong'] . '</div>
                                <div class="col-3 text-center">' . number_format($value['giaxuathoadon']) . '<sup>đ</sup></div>
                                <div class="col-3 text-center">                                   
                                    ' . number_format($value['giaxuathoadon'] * $value['soluong']) . '<sup>đ</sup>
                                </div>
           </div> ';
        $tongtien = $tongtien + $value['soluong'] * $value['giaxuathoadon'];
    }

    echo '<div class="row " style="margin-top: 10px">
                                <div class="col-3"> </div>
                                <div class="col-2"> </div>
                                <div class="col-2 bg-info">Tổng:</div>
                                <div class="col-3 bg-info">' . number_format($tongtien) . '<sup>đ</sup></div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row bg-info " style="margin-top: 20px">
                                <div class="col-12"> Thông tin giao hàng  </div>                                
                            </div>
                            <div class="row">
                                <div class="col-3">Người nhận:</div>
                                <div class="col-8">' . $hoten . '</div>
                                <div class="col-3">Địa chỉ:</div>
                                <div class="col-8">' . $diachi . '</div> 
                                <div class="col-3">Số điện thoại:</div>
                                <div class="col-8">' . $sdt . '</div>


                            </div>
                            ';






    echo '</div>';
}

function result($rs) {
    if ($rs == 'gg') {
        echo '<div class="col-lg-10 align-self-end">
                                        <h1 class="text-uppercase text-white font-weight-bold" style="margin-top: 20px">Đơn Hàng Của Bạn Đã Được Ghi Nhận Thành Công</h1>
                                        <hr class="divider my-4">
                                    </div>
                                    <div class="col-lg-8 align-self-baseline text-white">
                                        <p class="text-white-75 font-weight-light mb-5">Chúng tôi sẽ gửi hàng cho bạn vào ngày mai!. Sau 3-4 ngày bạn sẽ nhận được hàng. <span class="text-warning">jina</span> chân thành cảm ơn bạn đã tin tưởng và mua hàng tại <span class="text-warning">jina</span>! Love you <3</p>
                                        <p class="text-white-75 font-weight-light mb-5">Bạn có thể theo dõi đơn hàng của bạn<a href="'. create_url_site('status-order').'" class=" ">
                                                tại đây <i class="fas fa-list-ul"></i></a></p>
                                    </div>';
    } elseif ($rs == 'no') {
        echo '<div class="col-lg-10 align-self-end">
                                        <h1 class="text-uppercase text-danger font-weight-bold" style="margin-top: 20px">Đặt hàng thất bại !</h1>
                                        <hr class="divider my-4">
                                    </div>
                                    <div class="col-lg-8 align-self-baseline text-white">
                                        <p class="text-white-75 font-weight-light mb-5">Đã tồn tại 1 đơn hàng. Đơn hàng bạn đặt trước đó vẫn chưa hoàn tất. Sau khi nhận hàng đơn hàng trước bạn có thể tiếp tục đặt hàng. <span class="text-warning">jina</span> chân thành xin lỗi quý khách hàng về sự bất tiện này</p>
                                        <p class="text-white-75 font-weight-light mb-5">Bạn có thể theo dõi đơn hàng trước đó của bạn<a href="'. create_url_site('status-order').'" class=" ">
                                                tại đây <i class="fas fa-list-ul"></i></a></p>
                                    </div>';
    } elseif ($rs == 'hh') {
        echo '<div class="col-lg-10 align-self-end">
                                        <h1 class="text-uppercase text-danger font-weight-bold" style="margin-top: 20px">Đặt hàng thất bại !</h1>
                                        <hr class="divider my-4">
                                    </div>
                                    <div class="col-lg-8 align-self-baseline text-white">
                                        <p class="text-white-75 font-weight-light mb-5">Rất tiết 1 số sản phẩm trong giỏ hàng của bạn tạm thời hết hàng. Vui lòng đặt lại sau hoặc đặt sản phẩm tương tự khác. <span class="text-warning">jina</span> chân thành xin lỗi quý khách hàng về sự bất tiện này</p>
                                        <p class="text-white-75 font-weight-light mb-5">Bạn có thể theo dõi đơn hàng trước đó của bạn<a href="'. create_url_site('status-order').'" class=" ">
                                                tại đây <i class="fas fa-list-ul"></i></a></p>
                                    </div>';
    } elseif ($rs == 'fail') {
        echo '<div class="col-lg-10 align-self-end">
                                        <h1 class="text-uppercase text-danger font-weight-bold" style="margin-top: 20px">Đặt hàng thất bại !</h1>
                                        <hr class="divider my-4">
                                    </div>
                                    <div class="col-lg-8 align-self-baseline text-white">
                                        <p class="text-white-75 font-weight-light mb-5">Rất tiết đơn hàng của bạn không thể thực hiện được vì lỗi của hệ thống bạn có thể <a class="link" href="https://www.facebook.com/QuangNhan299"> liên hệ với quản trị viên web</a> hoặc có thể quay lại sau. <span class="text-warning">jina</span> chân thành xin lỗi quý khách hàng về sự bất tiện này</p>
                                        <p class="text-white-75 font-weight-light mb-5"></p>
                                    </div>';
    } else {
        location(create_url_site());
    }
}

?>