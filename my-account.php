<?php include "includes/header.php" ?>

<?php
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    echo "<script> window.location = 'index.php' </script>";
} else {
    $id = $_GET['id']; // Lấy catid trên host
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // The request is using the POST method
    $updateCustomer = $cus->update_customer($_POST, $id);
}
?>

<!-- Start My Account  -->
<div class="container">
    <div class="row">
        <div class="col-lg-6 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right"><strong>Thông tin tài khoản</strong></h4>
                </div>
                <?php
                if (isset($updateCustomer)) {
                    echo $updateCustomer;
                }
                ?>
                <?php
                $getCustomer = $cus->get_customer($id);
                if ($getCustomer) {
                    while ($result = $getCustomer->fetch_assoc()) {
                ?>
                        <form action="" method="POST">
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Họ</label>
                                    <input name="firstname" type="text" class="form-control" value="<?php echo $result['cusFirstName']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Tên</label>
                                    <input name="lastname" type="text" class="form-control" value="<?php echo $result['cusLastName']; ?>">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Số điện thoại</label>
                                    <input name="phone" type="text" class="form-control" value="<?php echo $result['cusPhone']; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Địa chỉ</label>
                                    <input name="address" type="text" class="form-control" value="<?php echo $result['cusAddress']; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Email</label>
                                    <input name="email" type="text" class="form-control" value="<?php echo $result['cusEmail']; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Tên đăng nhập</label>
                                    <input name="username" type="text" class="form-control" value="<?php echo $result['cusUserName']; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Mật khẩu</label>
                                    <input name="password" type="text" class="form-control" value="<?php echo $result['cusPassword']; ?>">
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <button type="submit" name="submit" class="btn btn-primary profile-button">Cập nhật</button>
                                <a href="?action=logout"><button class="btn btn-primary profile-button" type="button">Đăng xuất</button></a>
                                <?php
                                if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                                    $delCart = $cart->del_all_data_cart();
                                    Session::destroy_user();
                                }
                                ?>
                            </div>
                        </form>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience">
                    <a href="cart.php"><strong>Giỏ hàng</strong></a>
                </div>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-main table-responsive">
                                <table class="table">
                                    <?php
                                    if (isset($update_Quantity_Cart)) {
                                        echo $update_Quantity_Cart;
                                    }
                                    ?>

                                    <?php
                                    if (isset($del_Product_Cart)) {
                                        echo $del_Product_Cart;
                                    }
                                    ?>

                                    <tbody>
                                        <?php
                                        $get_product_cart = $cart->getProductCart();
                                        if ($get_product_cart) {
                                            while ($result = $get_product_cart->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td class="thumbnail-img">
                                                        <img class="img-fluid" src="admin/uploads/<?php echo $result['image']; ?>" alt="">
                                                    </td>
                                                    <td style="text-align: left;" class="name-pr">
                                                        <?php echo $result['name']; ?>
                                                    </td>
                                                    <td class="quantity-box">
                                                        <?php echo $result['quantity'] ?>
                                                    </td>
                                                    <td class="total-pr">
                                                        <?php
                                                        $total = $result['price'] * $result['quantity'];
                                                        echo $fm->format_currency($total) . " VND";
                                                        ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <hr>
                                <?php
                                $check_cart = $cart->check_cart();
                                if ($check_cart) {
                                ?>
                                    <div class="mt-5 text-center">
                                        <a href="checkout.php"><button class="btn btn-primary profile-button" type="button">Thanh toán</button></a>
                                    </div>
                                <?php
                                } else {
                                    echo "Giỏ hàng của bạn đang trống !!!";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- End My Account -->

<?php include "includes/footer.php" ?>