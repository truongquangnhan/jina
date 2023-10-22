<?php define("IN_SITE", true); ?>
<?php

require '../../system/library/getpost.php';
require '../../system/library/session.php';
require '../model/model_db.php';

$stt = 1;
foreach (user_viewgiohang(3) as $value) {
    echo ' <div class="row" id="checkedajax' . $stt . '">
            
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
?>