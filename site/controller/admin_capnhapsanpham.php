<?php define("IN_SITE", true); ?>
<?php

require '../../system/library/getpost.php';
require '../../system/library/session.php';
require '../model/model_db.php';
$iddt = input_post("iddt");
$tensp = input_postdf("tensp");
$hangsp = input_postdf("hangsp");
$loaisp = input_postdf("loaisp");
$kho = input_postdf("kho");
$gianhap = input_postdf("gianhap");
$giaban = input_postdf("giaban");
$soluongnhap = input_postdf("soluongnhap");
$hedieuhanh = input_postdf("hedieuhanh");
$phienban = input_postdf("phienban");
$dophangiaimanhinh = input_postdf("dophangiaimanhinh");
$cameratruoc = input_postdf("cameratruoc");
$camerasau = input_postdf("camerasau");
$sim = input_postdf("sim");
$wifi = input_postdf("wifi");
$bluetoolh = input_postdf("bluetoolh");
$pin = input_postdf("pin");
$baomat = input_postdf("baomat");
$ram = input_postdf("ram");
$bonhotrong = input_postdf("bonhotrong");
$hinhanh = input_postdf("hinhanh");
$thongtinkhac = input_postdf("thongtinkhac");
// upload hình ảnh từ user lên
$statusupload;
if (isset($_FILES['hinhanh'])) {
    $errors = array();
    $file_name = addslashes($_FILES['hinhanh']['name']);
    $file_size = $_FILES['hinhanh']['size'];
    $file_tmp = $_FILES['hinhanh']['tmp_name'];
    $file_type = $_FILES['hinhanh']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['hinhanh']['name'])));
    $expensions = array("jpeg", "jpg", "png");
    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
    }
    if ($file_size > 2097152) {
        $errors[] = 'Kích thước file không được lớn hơn 2MB';
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, create_url_site('site/image/product/'). $file_name);
        $hinhanh = create_url_site('site/image/product/'). $file_name;
        $statusupload = "true";
        //echo "Success";
    } else {
        foreach ($errors as $value) {
            $statusupload = $statusupload . $value;
        }
        location(create_url_site("admin-detail-product/?iddt=" . $iddt));
        //location('http://localhost/jina/site/view/admin_chitietsanpham.php?iddt='.$iddt);
        // print_r($errors);
    }
}

// end upload hình ảnh
if (empty($iddt) || empty($tensp) || empty($hangsp) || empty($loaisp) || empty($kho) || empty($giaban) || empty($gianhap) || empty($soluongnhap) || empty($hedieuhanh)) {
    location(create_url_site("admin-detail-product/?iddt=" . $iddt));
} else {
    if ($giaban <= 0 || $gianhap <= 0 || $soluongnhap <= 0) {
        location(create_url_site("admin-detail-product/?iddt=" . $iddt));
    }
    // check tới đây thì đã thỏa mãn tất cả các điều kiện
    admin_capnhapsanpham($iddt, $kho, $tensp, $loaisp, $soluongnhap, $hangsp, $giaban, $gianhap, $hedieuhanh, $phienban, $dophangiaimanhinh, $cameratruoc, $camerasau, $sim, $wifi, $bluetoolh, $pin, $baomat, $ram, $bonhotrong, $hinhanh, $thongtinkhac);
    location(create_url_site("admin-detail-product/?iddt=" . $iddt));
}
location(create_url_site("admin-detail-product/?iddt=" . $iddt));
