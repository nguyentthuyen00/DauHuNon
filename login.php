<?php
include 'includes/header.php';
// include 'inc/slider.php';
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check) {
    echo "<script> window.location = 'index.php' </script>";
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // The request is using the POST method
    $loginCustomer = $cus->login_customer($_POST);
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Đăng nhập</h5>
                    <?php
                    if (isset($loginCustomer)) {
                        echo $loginCustomer;
                    } ?>
                    <form class="form-signin" action="" method="POST">
                        <div class="form-label-group">
                            <!-- <label for="inputEmail">Email</label> -->
                            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="" required autofocus>
                        </div>

                        <div class="form-label-group">
                            <!-- <label for="inputPassword">Mật khẩu</label> -->
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="" required>
                        </div>
                        <input class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit" value="Đăng nhập" style="background-color: #d0a772; border: 1px solid black;">
                        <p><a href="">Quên mật khẩu</a> hoặc <a href="signup.php">Đăng ký</a></p>
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