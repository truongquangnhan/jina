<?php

ob_start();
require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../../system/config/config.php';
require_once '../model/model_db.php';

function db_get_list1($sql) {
    db_connect();
    global $con;
    $data = array();
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

function db_get_list2($sql1) {
    db_connect();
    global $con;
    $data1 = array();
    $result1 = mysqli_query($con, $sql1);
    while ($row = mysqli_fetch_assoc($result1)) {
        $data1[] = $row;
    }
    return $data1;
}

function getiddtandsoluong1($dh) {
    return db_get_list1("call viewsoluongvadienthoaimua($dh);");
}
function getiddtandsoluong2($dh) {
    return db_get_list2("call viewsoluongvadienthoaimua($dh);");
}

$next = true;
$isfinish = FALSE;
var_dump(getiddtandsoluong1(6));
var_dump(getiddtandsoluong2(6));

/*
foreach (getiddtandsoluong(6) as $value) {
    $dt = 0;
    $sl = 0;
    $dt = $value['iddt']*1;
    $sl = $value['soluong']*1;
    db_connect();
    global $con;
    if (checksoluong( $dt,$sl ) == 1) {
        $next = true;
    } else {
        $next = FALSE;
        break;
    }
}
echo $next;
     
     */
?>
<?php

require_once '../../system/library/getpost.php';
require_once '../../system/library/session.php';
require_once '../model/model_db.php';

function printdetailcart1($idtk) {
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
                                        <div class="input-group container">
                                            <div class="row" style="min-width: 150px;">
                                                <span class="input-group-btn"> 
                                                    <button type="button" class="btn btn-sm btn-danger btn-number" data-type="minus" data-field="quant[' . $stt . ']"> 
                                                        <span class="fa fa-chevron-left"></span> 
                                                    </button>
                                                </span>
                                                <input name="quant[' . $stt . ']" class="form-control input-number btn btn-sm" style="max-width: 40px" value="' . $value['soluong'] . '" min="1" max="10" type="text">
                                                <span class="input-group-btn">    
                                                    <button type="button" class="btn btn-sm btn-success btn-number" data-type="plus" data-field="quant[' . $stt . ']"> 
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
        $stt = $stt + 1;
    }
    // code ajax tăng giảm số lượng
    echo '<script>
            // code get so luong tu input
            var value = 0;
            var commentCount = 0;
            function gettext() {
                var stringiput = document.getElementById("valueinput").value;
                return stringiput;
            }          
            $(document).ready(function () {                
                // #updatenow là id của button
                //var commentCount = value;
                $("#updatenow").click(function () {
                    commentCount = gettext();
                    // #comments id của thẻ cần load dữ liệu vào                    
                    // load(url,data)
                    $("#soluong").load("load-soluong.php", {
                        commentNewCount: commentCount
                    });
                });
            });

        </script>';
}

?>