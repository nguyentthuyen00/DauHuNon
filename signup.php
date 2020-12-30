<?php
include 'includes/header.php';
// include 'inc/slider.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // The request is using the POST method
    $insertCustomer = $cus->insert_customer($_POST);
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Đăng ký</h5>
                    <div style="text-align: center;">
                        <?php
                        if (isset($insertCustomer)) {
                            echo $insertCustomer;
                        }
                        ?>
                    </div>
                    <form class="form-signin" action="" method="POST">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Họ</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required data-error="Vui lòng nhập họ của bạn">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required data-error="Vui lòng nhập tên của bạn">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone" required data-error="Vui lòng nhập số điện thoại của bạn">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" id="address" class="form-control" name="address" required data-error="Vui lòng nhập địa chỉ nhận hàng">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mail">Email</label>
                                <input type="text" id="email" class="form-control" name="email" required data-error="Vui lòng nhập tên của email">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mail">Tên đăng nhập</label>
                                <input type="text" id="username" class="form-control" name="username" required data-error="Vui lòng nhập tên đăng nhâp">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="text" id="password" class="form-control" name="password" required data-error="Vui lòng nhập mật khẩu">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <input class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit" style="background-color: #d0a772; border: 1px solid black;" value="Đăng ký">
                        <p>Bạn đã có tài khoản, hãy <a href="login.php">Đăng nhập</a></p>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>