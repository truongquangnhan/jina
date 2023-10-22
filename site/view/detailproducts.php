<?php
define("IN_SITE", true);
ob_start();
?>
<!DOCTYPE html>
<html>
<?php include_once '../../system/widgets/header.php'; ?>

    <body>
        <?php
        include_once '../../system/widgets/nav.php';
        require_once '../../system/library/getpost.php';
        require_once '../../system/library/session.php';
        ?>
        <!-- Danh sách SP -->
        <div class="container-fluid mrtop">      
            <div class="row">
                <!-- detail -->
                <?php
                if (input_get('product')) {
                    if (!empty(input_get('product'))) {
                        if (is_numeric(input_get('product'))) {
                            $idsp = input_get('product');
                        } else {
                            location(create_url_site());
                        }
                    } else {
                         location(create_url_site());
                    }
                } else {
                     location(create_url_site());
                }
                require_once '../model/model_db.php';
                foreach (user_detailproduct($idsp) as $value) {
                    $hang = $value['hangdt'];
                    echo '<div class=" col-lg-4 col-sm-5 col-6 offset-0" >
                    <div class="row">
                        <div class="col-12 " >
                            <img style="margin:0" class="col-sm-11 col-12 img img-fluid img-responsive  rounded mx-auto d-block" src="' . $value['hinhanh'] . '" alt="jina-' . $value['hinhanh'] . '"/>
                        </div>
                        <div class="col-lg-8 offset-lg-2 col-sm-8  offset-sm-2 col-md-8  offset-md-2 col-12 offset-1 w-100">
                            <div>
                                <p class="col-12 rounded mx-auto d-block  text-center  text-danger"><b>' . $value['tendt'] . '</b></p>
                                <p class="col-12 rounded mx-auto d-block  text-center  text-warning">' . number_format($value['giaban']) . '<sup>đ </sup>[' . $value['loaimay'] . ']</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-sm-8  offset-sm-2 col-8 offset-3 w-100">';
            
            if (session_get('sstaikhoan')) {                
                echo '<a href="'. create_url_site('ctl-add-cart?tk=' . session_get('ssidtk') . '&sp=' . $idsp).'"  title="Mua sản phẩm" class="bg-danger text-white btn btn-sm mx-auto d-block  text-center ';
                    if ($value['soluongcon'] <= 0) {
                        echo 'disabled';
                    } echo ' " >Mua ngay</a>';
            } else {
                echo '<a href="'. create_url_site('login').'"  title="Mua sản phẩm" class="bg-danger text-white btn btn-sm mx-auto d-block  text-center ';
                    if ($value['soluongcon'] <= 0) {
                        echo 'disabled';
                    } echo ' " >Mua ngay</a>';
            }
            echo '      
                        </div>
                    </div>
                </div>
                <div class=" col-lg-5 col-sm-7 col-6 text-sm">
                    <table class="table  table-sm">
                        <thead>  
                            <tr class="bg-warning text-white">
                                <th colspan="2"><p class="h6">Thông số kỹ thuật</p></th>
                        </tr>
                        </thead>
                        <tbody >
                            <tr>
                                <th scope="row">Thương hiệu:</th>
                                <td >' . $value['hangdt'] . '</td>
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
                                <th scope="row">Độ phân giải màn hình:</th>
                                <td>' . $value['dophangiaimh'] . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Camera trước:</th>
                                <td>' . $value['cameratruoc'] . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Camera sau:</th>
                                <td>' . $value['camerasau'] . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Sim:</th>
                                <td>' . $value['sim'] . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Wifi:</th>
                                <td>' . $value['wifi'] . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Bluetoolh</th>
                                <td>' . $value['bluetoolh'] . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Pin:</th>
                                <td>' . $value['pin'] . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Bảo mật:</th>
                                <td>' . $value['baomat'] . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Ram:</th>
                                <td>' . $value['ram'] . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Bộ nhớ trong:</th>
                                <td>' . $value['bonhotrong'] . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Khác:</th>
                                <td>' . $value['thongtinkhac'] . '</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="height:50px;"></div>
                </div>';
                }
                ?>
                <!-- end detail -->
                <div class=" col-lg-3  col-sm-12 col-12 ">
                    <table class="table border table-sm">
                        <thead> 
                            <tr class="bg-warning text-white">
                                <td >
                                    <p class="h6" >Chế độ bảo hành</p>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">1 đổi 1, 15 ngày
                                    Bảo hành 6 tháng
                                    Xử lý trong 30 ngày</td>

                            </tr>
                            <tr>
                                <td scope="row">
                                    <img class="img img-thumbnail"  src="site/image/product/baohanhjina.png" alt=""/>
                                    Bảo hành phần cứng mặc định, không bao gồm nguồn, màn hình, vân tay, rơi móp, vào nước
                                </td>

                            </tr>
                            <tr>
                                <td scope="row">Lỗi là đổi mới trong 1 tháng tại hơn 50 cửa hàng toàn quốc</td>

                            </tr>
                            <tr>
                                <td>Bảo hành chính hãng 12 tháng.</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="container">
                <div>
                    <?php
                    require_once '../model/model_db_view_index.php';
                    index_viewproduct2($hang);
                    ?>
                </div>

                <div class="row mt-4 text-dark">
                    <div class="row"><p class="h4">Thông tin bảo hành</p></div>
                    <div class="row border">
                        <div class="m-3">
                            <p class="h6">1. Lời cảm ơn!</p>
                            <p> Cảm ơn quý khách đã tin tưởng và mua hàng tại <span class="text-warning">jina</span>. Trong quá trình hình thành và phát triển, <span class="text-warning">jina</span> luôn lấy bảo hành, hậu mãi làm gốc rễ. Ngoài những sản phẩm được phân phối chính hãng tại Việt Nam được bảo hành theo chính sách chung của từng hãng, các sản phẩm do <span class="text-warning">jina</span> nhập khẩu, các sản phẩm qua sử dụng sẽ được bảo hành theo chính sách riêng của <span class="text-warning">jina</span>.
                            </p>
                            <p class="h6">2. Điều khoản bảo hành:</p>
                            <p>

                            <ul class="ml-4 ">
                                <li>Để được đổi mới trong thời hạn quý khách cần giữ gìn máy, phụ kiện không xước, móp, hộp không rách, dán băng keo. Tham khảo chính sách đổi trả</li>
                                <li>Máy trong thời hạn bảo hành, tem, phiếu bảo hành còn nguyên vẹn và hợp lệ, không có dấu hiệu tẩy xóa.</li>
                                <li>Công ty không chịu trách nhiệm về hình thức máy, thiếu phụ kiện, dính tài khoản icloud, google account sau khi khách rời cửa hàng.                        </li>
                                <li>Khách hàng muốn trả lại máy trong thời gian đổi trả sẽ bị chiết khấu từ 10-20% tùy sản phẩm, hỗ trợ nhập lại máy theo giá thỏa thuận để lên đời.</li>
                                <li>Thời gian đổi mới phụ kiện lỗi do nhà sản xuất (pin, sạc, cable, tai nghe): dCare: 30 ngày, dCare+: 60 ngày, dCareS: 90 ngày</li>
                                <li>Nếu quá thời hạn mà không xử lý được, hoặc máy bị bảo hành lại quá 2 lần: Quý khách sẽ được đổi main hoặc đổi máy tương đương.</li>
                                <li>Quý khách được hỗ trợ cài đặt phần mềm, tải game/app, vệ sinh, lau bụi cho máy trọn đời.</li>
                                <li>Không bảo hành các lỗi phát sinh do già hóa linh kiện: điểm chết, đốm sáng, sọc kẻ màn hình, ố vàng ngoài thời gian đổi mới quy định của từng gói bảo hành.</li>
                                <li>Không bảo hành màn hình đối với trường hợp màn hình có dưới 5 điểm chết</li>
                                <li>Không bảo hành đối với lỗi màn chảy mực. Dấu hiệu nhận biết màn chảy mực: có các vệt loang màu tím ở các góc, đốm đen màn, màn sọc đen hoặc tím, có loang dầu khi nhìn nghiêng.</li>
                                <li>Không bảo hành với máy vào nước với cả sản phẩm có khả năng chống nước, vui lòng không lạm dụng tính năng này.</li>
                                <li>Cách kiểm tra máy móp máy, vào nước:</li>
                                <li>Máy móp vỏ ngoài bị lõm, biến dạng so với hình dạng chuẩn sẽ bị từ chối bảo hành với dCare, dCare+</li>
                                <li>Máy vào nước nhận định dựa trên giấy quỳ bị đỏ, main mốc, rỉ sét hoặc có hơi nước được kiểm tra ngay trước mặt khách hàng.</li>
                                <li>Gói bảo hành dCare, cung cấp chế độ bảo hành căn bản:</li>
                                <li>Với máy cũ thời gian bảo hành là 6 tháng, với máy mới là 12 tháng</li>
                                <li>Thời gian đổi trả sản phẩm bao gồm tất cả mọi lỗi phần cứng 15 ngày</li>
                                <li>Sau thời gian 15 ngày, ngoài các lỗi phần cứng nhạy cảm (hiếm gặp) như lỗi nguồn, màn hình, vân tay, và đủ điều kiện bảo hành (máy không rơi móp, thấm nước), khách hàng sẽ được bảo hành sửa chữa trong vòng tối đa 21 ngày. Nếu quá 21 ngày khách hàng sẽ được đổi main hoặc máy tương đương. </li>
                            </ul>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ------- -->
        </div>

<?php include_once '../../system/widgets/footer.php'; ?>

    </body>
</html>
