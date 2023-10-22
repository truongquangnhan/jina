<?php
require_once '../../system/config/config.php';
function index_viewproduct($loai) {
    echo '<div class="row tenhang">
                        <h2 >' . $loai . '</h2>                   
                    </div>
                    <div class="row ">  ';
    db_connect();
    global $con;
    $query = "call index_viewsanpham('$loai');";
    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($iddt, $tendt, $hangdt, $loaimay, $tongsl, $soluongcon, $giaban, $hinhanh);

        while ($stmt->fetch()) {
            echo '<div class="col-lg-3 col-md-4 col-6 mgat bg-white ">
                    <div class=" rounded-lg card testimonial-card mb-4">
                     
                            <img class="img rounded mx-auto d-block" src="' . $hinhanh . '" alt="jina-' . $tendt . '"/>                     
                            <h5>' . $tendt . '</h5>
                            <p class="gia">' . number_format($giaban) . '<sup>đ</sup></p>
                            <div class="row">
                                <div class="col-12 btn-group btn-group-justified">
                                <a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('detail-product?product=' . $iddt) . '" >chi tiết</a>';

            if (session_get('sstaikhoan')) {
                echo '<a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('ctl-add-cart?tk=' . session_get('ssidtk') . '&sp=' . $iddt) . '">thêm giỏ hàng</a>';
            } else {
                echo '<a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('login') . '">thêm giỏ hàng</a>';
            }
            echo '
                                </div>
                            </div>
                         </div>
                        
                    </div>';
        }
        echo '</div>';
        $stmt->close();
    }
}

function index_viewproduct2($loai) {
    echo '<div class="row tenhang">
                        <h2 >' . $loai . '</h2>                   
                    </div>
                    <div class="row ">  ';



    foreach (db_get_list_procedure("call index_viewsanpham('$loai');") as $value) {
        echo '<div class="col-lg-3 col-md-4 col-6 mgat bg-white ">
                    <div class=" rounded-lg card testimonial-card mb-4">
                     
                            <img class="img rounded mx-auto d-block" src="' . $value['hinhanh'] . '" alt="jina-' . $value['tendt'] . '"/>                     
                            <h5>' . $value['tendt'] . '</h5>
                            <p class="gia">' . number_format($value['giaban']) . '<sup>đ</sup></p>
                            <div class="row">
                                <div class="col-12 btn-group btn-group-justified">
                                <a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('detail-product?product=' . $value['iddt']) . '" >chi tiết</a>';

        if (session_get('sstaikhoan')) {
            echo '<a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('ctl-add-cart?tk=' . session_get('ssidtk') . '&sp=' . $value['iddt']) . '">thêm giỏ hàng</a>';
        } else {
            echo '<a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('login') . '">thêm giỏ hàng</a>';
        }
        echo '
                                </div>
                            </div>
                         </div>
                        
                    </div>';
    }
    echo '</div>';
}

function index_viewkey($loai) {
    echo '<div class="row tenhang">
                        <h2 >' . $loai . '</h2>                   
                    </div>
                    <div class="row ">  ';



    foreach (db_get_list_procedure("call viewkey('$loai');") as $value) {
        echo '<div class="col-lg-3 col-md-4 col-6 mgat bg-white ">
                    <div class=" rounded-lg card testimonial-card mb-4">
                     
                            <img class="img rounded mx-auto d-block" src="' . $value['hinhanh'] . '" alt="jina-' . $value['tendt'] . '"/>                     
                            <h5>' . $value['tendt'] . '</h5>
                            <p class="gia">' . number_format($value['giaban']) . '<sup>đ</sup></p>
                            <div class="row">
                                <div class="col-12 btn-group btn-group-justified">
                                <a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('detail-product?product=' . $value['iddt']) . '" >chi tiết</a>';

        if (session_get('sstaikhoan')) {
            echo '<a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('ctl-add-cart?tk=' . session_get('ssidtk') . '&sp=' . $value['iddt']) . '">thêm giỏ hàng</a>';
        } else {
            echo '<a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('login') . '">thêm giỏ hàng</a>';
        }
        echo '
                                </div>
                            </div>
                         </div>
                        
                    </div>';
    }
    echo '</div>';
}

function index_viewprice($tu, $den) {
    echo '<div class="row tenhang">
                        <h2 >Các sản phẩm có giá từ: ' . number_format($tu) . 'vnd đến ' . number_format($den) . 'vnd</h2>                   
                    </div>
                    <div class="row ">  ';



    foreach (db_get_list_procedure("call viewprice($tu,$den);") as $value) {
        echo '<div class="col-lg-3 col-md-4 col-6 mgat bg-white ">
                    <div class=" rounded-lg card testimonial-card mb-4">
                     
                            <img class="img rounded mx-auto d-block" src="' . $value['hinhanh'] . '" alt="jina-' . $value['tendt'] . '"/>                     
                            <h5>' . $value['tendt'] . '</h5>
                            <p class="gia">' . number_format($value['giaban']) . '<sup>đ</sup></p>
                            <div class="row">
                                <div class="col-12 btn-group btn-group-justified">
                                <a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('detail-product?product=' . $value['iddt']) . '" >chi tiết</a>';

        if (session_get('sstaikhoan')) {
            echo '<a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('ctl-add-cart?tk=' . session_get('ssidtk') . '&sp=' . $value['iddt']) . '">thêm giỏ hàng</a>';
        } else {
            echo '<a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('login') . '">thêm giỏ hàng</a>';
        }
        echo '
                                </div>
                            </div>
                         </div>
                        
                    </div>';
    }
    echo '</div>';
}

function index_viewname($loai) {
    echo '<div class="row tenhang">
                        <h2 >Kết quả cho từ khóa: ' . $loai . '</h2>                   
                    </div>
                    <div class="row ">  ';


    $loai = '%' . $loai . '%';
    foreach (db_get_list_procedure("call viewname('$loai');") as $value) {
        echo '<div class="col-lg-3 col-md-4 col-6 mgat bg-white ">
                    <div class=" rounded-lg card testimonial-card mb-4">
                     
                            <img class="img rounded mx-auto d-block" src="' . $value['hinhanh'] . '" alt="jina-' . $value['tendt'] . '"/>                     
                            <h5>' . $value['tendt'] . '</h5>
                            <p class="gia">' . number_format($value['giaban']) . '<sup>đ</sup></p>
                            <div class="row">
                                <div class="col-12 btn-group btn-group-justified">
                                <a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('detail-product?product=' . $value['iddt']) . '" >chi tiết</a>';

        if (session_get('sstaikhoan')) {
            echo '<a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('ctl-add-cart?tk=' . session_get('ssidtk') . '&sp=' . $value['iddt']) . '">thêm giỏ hàng</a>';
        } else {
            echo '<a class="none-decoration btn btn-dark btn-sm text-white" href="' . create_url_site('login') . '">thêm giỏ hàng</a>';
        }
        echo '
                                </div>
                            </div>
                         </div>
                        
                    </div>';
    }
    echo '</div>';
}
