<?php define("IN_SITE", true); ?>
<!DOCTYPE html>
<html>
    <?php include_once '../../system/widgets/header.php'; ?>

    <body>
        <?php
        include_once '../../system/widgets/nav.php';
        if (session_get('ssidtk')) {
            
        } else {
            location(create_url_site('login'));
        }
        ?>
        <div class="container-fluid mrtop">      
            <div class="row">                               
                <div class="col-lg-6 offset-lg-3 col-10 offset-1 bg-dark text-white">
                    <h4 class="text-center text-success">Thông tin giao hàng mới</h4>
                    <p>Chúng tôi sẽ gửi hàng theo thông tin bạn nhập bên dưới. Vì thế bạn nên nhập đầy đủ và chi tiết nhất có thể để chúng tôi dễ dàng gửi hàng cho bạn một cách nhanh nhất.</p>
                    <form action="site/controller/user_updatethongtinnhanhang.php" method="POST" class="needs-validation" novalidate>
                        <input type="text" value="<?php echo session_get('ssidtk'); ?>" name="idtk" class="" style="display: none;">
                        <div class="form-group">
                            <label for="uname">Tên người nhận:</label>
                            <input type="text" class="form-control" id="uname" maxlength="30" placeholder="Nhập tên" name="uname" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="diachi">Địa chỉ nhận hàng:</label>
                            <input type="text" class="form-control" id="diachi" minlength="15" maxlength="100" placeholder="Nhập địa chỉ" name="diachi" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="sdt">Số điện thoại nhận hàng:</label>
                            <input type="text" class="form-control" id="sdt" maxlength="10" minlength="10" placeholder="Nhập số điện thoại" name="sdt" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>                        
                        <input type="submit" class="btn btn-success text-center col-4 offset-4"  value="Submit">
                    </form>
                </div>

                <script>
                    // Disable form submissions if there are invalid fields
                    (function () {
                        'use strict';
                        window.addEventListener('load', function () {
                            // Get the forms we want to add validation styles to
                            var forms = document.getElementsByClassName('needs-validation');
                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function (form) {
                                form.addEventListener('submit', function (event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
                                }, false);
                            });
                        }, false);
                    })();
                </script>
            </div>


        </div>
        <!-- ---end container-fluid---- -->
















<?php include_once '../../system/widgets/footer.php'; ?>

    </body>
</html>
