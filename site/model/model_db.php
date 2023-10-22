<?php

ob_start();
require_once '../../system/config/config.php';

// hàm này lấy thông tin tài khoản đăng nhập sang controller so sánh
function db_logintaikhoan($usname) {
    return db_get_list("SELECT usname, psword,hovaten,trangthai,quyen,idtk FROM taikhoan where usname='$usname'");
}

// hàm này lấy thông tin tài khoản đăng kí sang controller so sánh
function db_sigintaikhoan($usname) {
    return db_get_list("SELECT usname FROM taikhoan where usname='$usname'");
}

// hàm đăng kí tài khoản
function dangki($us, $pw, $sdt, $hvt, $dc, $email) {
    db_execute_procedure("call dangkitaikhoan('$us','$pw','$sdt','$hvt','$dc,','$email');");
}

// hàm này lấy các đơn hàng đang chờ
function view_index_admin() {
    return db_get_list("call admin_hienthidonhang()");
}

// hàm này update đơn hàng đã xong 100%
function update_hoangtatdonhang_admin($madonhang) {
    db_execute("call admin_hoangtatdonhang($madonhang)");
}

// hàm này lấy tất cả row trong table dienthoai
function view_admin_sanpham() {
    return db_get_list("call admin_viewsanpham()");
}

// hàm lấy thông tin chi tiết sản phẩm có đầu vào là id sản phẩm
function view_admin_chitietsanpham($iddt) {
    return db_get_list("call admin_viewchitietsanpham($iddt)");
}

function admin_themsanpham($kho, $tensp, $loaisp, $soluongnhap, $hangsp, $giaban, $gianhap, $hedieuhanh, $phienban, $dophangiaimanhinh, $cameratruoc, $camerasau, $sim, $wifi, $bluetoolh, $pin, $baomat, $ram, $bonhotrong, $hinhanh, $thongtinkhac) {
    db_execute("call admin_themsanpham($kho,'$tensp','$loaisp',$soluongnhap,'$hangsp',$giaban,$gianhap,'$hedieuhanh','$phienban','$dophangiaimanhinh','$cameratruoc','$camerasau','$sim','$wifi','$bluetoolh','$pin','$baomat','$ram','$bonhotrong','$hinhanh','$thongtinkhac')");
}

// hàm xóa sản phẩm theo ID
function delete_admin_xoasanpham($iddt) {
    db_execute("call admin_xoasanpham($iddt)");
}

// hàm cập nhập sản phẩm
function admin_capnhapsanpham($iddt, $kho, $tensp, $loaisp, $soluongnhap, $hangsp, $giaban, $gianhap, $hedieuhanh, $phienban, $dophangiaimanhinh, $cameratruoc, $camerasau, $sim, $wifi, $bluetoolh, $pin, $baomat, $ram, $bonhotrong, $hinhanh, $thongtinkhac) {
    db_execute("call admin_updatesanpham($iddt,$kho,'$tensp','$loaisp',$soluongnhap,'$hangsp',$giaban,$gianhap,'$hedieuhanh','$phienban','$dophangiaimanhinh','$cameratruoc','$camerasau','$sim','$wifi','$bluetoolh','$pin','$baomat','$ram','$bonhotrong','$hinhanh','$thongtinkhac')");
}

// hàm xem chi tiết đơn hàng từ admin
function admin_chitietdonhang($iddh) {
    return db_get_list("Call admin_xemchitietdonhang($iddh)");
}

// hàm view all tài khoản trừ tài khoản admin
function admin_viewtaikhoan() {
    return db_get_list("call admin_quanlytaikhoan()");
}

// hàm view sản phẩm theo loại sản phẩm
function index_viewsanpham($loai) {
    return db_get_list("call index_viewsanpham('$loai');");
}

//-----------------------------------------------------------------------------------------------------------------------------------------
// user xem chi tiết sản phẩm
function user_detailproduct($id) {
    return db_get_list("call user_detailproduct($id);");
}

// user hiển thị số chỗ giỏ hàng
function countproduct($idtk) {
    $count = 0;
    db_connect();
    global $con;
    $query = "select user_numberproduct($idtk) as 'countproduct'";
    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($user_numberproduct);
        while ($stmt->fetch()) {
            $count = $user_numberproduct;
        }
        $stmt->close();
    }
    return $count;
}

// thủ tục xem giỏ hàng
function user_viewgiohang($idtk) {
    return db_get_list("call user_detailcart($idtk);");
}

// thủ tục tăng số lượng
function user_tangsl($dh, $dt) {
    db_execute("call user_updatetangsoluong($dh,$dt);");
}

// thủ tục tăng số lượng
function user_giamsl($dh, $dt) {
    db_execute("call user_updategiamsoluong($dh,$dt);");
}

// thủ tục view số lượng
function user_viewsl($dh, $dt) {
    return db_get_row("call user_viewsoluong($dh,$dt);");
}

// test var_dump(user_viewsl(1, 1)) ;
//db_execute("call user_updatetangsoluong(1,1);");
//user_tangsl(1, 1);
// thủ tục add sản phẩm vào giỏ hàng
function user_addsanphamvaogiohang($tk, $sp) {
    db_execute("call user_addcart($tk,$sp);");
}

// thủ tục update thông tin nhận hàng
function user_capnhapthongtinnhanhang($tk, $ten, $dc, $sdt) {
    db_execute("call user_updatethongtinnhanhang($tk,'$ten','$dc','$sdt');");
}

// thủ tục xem danh sách sản phẩm trong giỏ hàng trước khi đặt hàng user_viewdanhsachsanphammuadadathang
function user_viewdanhsachspmua($tk) {
    return db_get_list("call user_viewdanhsachsanphammua($tk);");
}

// thủ tục xem sản phẩm đơn hàng đã đặt
function user_viewdanhsachspdadat($tk) {
    return db_get_list_procedure("call user_viewdanhsachsanphammuadadathang($tk);");
}

// var_dump(user_viewdanhsachspmua(6));
// thủ tục xóa 1 sản phẩm trong danh sách sản phẩm đã chọn trong giỏ hàng
function user_xoasanphamtrongdanhsach($dh, $dt) {
    db_execute_procedure("call user_deletesanphamtrongdanhsach($dh,$dt);");
}

// hàm chuyển trạng thái đơn hàng khi khách nhấn đặt hàng
function datdonhang($dh, $tk) {
    return db_execute_procedure("call user_dahang($dh,$tk);");
}

// hàm add feedback
function addfeed($s) {
    db_execute_procedure("insert into feedback(noidung) values('$s');");
}

// hàm trả về iddt và só lượng khách mua 
function getiddtandsoluong($dh) {
    return db_get_list_procedure("call viewsoluongvadienthoaimua($dh);");
}

// hàm check số lượng đặt có còn hay không 
function checksoluong($dt, $sldat) {
    return db_get_row_procedure("select viewsoluongcon($dt,$sldat) as conhang; ");
}

// hàm trừ số lượng khách đặt hàng
function trusoluong($dt, $sl) {
    db_execute_procedure("call trusoluongdienthoai($dt,$sl);");
}
// hàm trừ số lượng khách đặt hàng
function congsoluong($dt, $sl) {
    db_execute_procedure("call congsoluongdienthoai($dt,$sl);");
}
// thủ tục xem đã tồn tại đơn hàng chưa hoàng tất hay chưa
function checkdonhang($dh, $tk) {
    return db_execute_procedure("select user_checkdathang($dh,$tk) as 'xx';");
}

// thủ tục xem trang thái đơn hàng đã đặt gần nhất
function gettrangthaidonhang($tk) {
    return db_get_list_procedure("call gettrangthaimoinhat($tk);");
}

// thu tuc hien thi cac don hang cho shiper chon 
function viewproductforshiper() {
    return db_get_list_procedure("call view_donhang_shiper();");
}

// thủ tục add đơn hàng cần ship vào list
function addproductforshiper($dh, $tk) {
    db_execute_procedure("call add_donhang_shiper($dh,$tk)");
}

// thủ tục shiper xem những đơn cần ship của mình
function viewofshiper($tk) {
    return db_get_list_procedure("call view_donhang_of_shiper($tk);");
}
// thủ tục update trang thai don hang cua shiper
function shiper_update_donhang($dh,$tt) {
    db_execute_procedure("call update_donhang_of_shiper($dh,'$tt');");
}
?>
