<?php include "includes/header.php" ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // The request is using the POST method
    $cartid = $_POST['cartid'];
    $quantity = $_POST['quantity'];
    $update_Quantity_Cart = $cart->update_Quantity_Cart($cartid, $quantity);
}
if (isset($_GET['cartid'])) {
    $id = $_GET['cartid']; // Lấy catid trên host
    $del_Product_Cart = $cart->del_product_cart($id); // hàm check delete Name khi submit lên
}
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    echo "<script> window.location = 'login.php' </script>";
}
?>

<!-- Start Cart  -->
<div class="cart-box-main">
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
                                $subtotal = 0;
                                $qty = 0;
                                while ($result = $get_product_cart->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td class="thumbnail-img">
                                            <img class="img-fluid" src="admin/uploads/<?php echo $result['image']; ?>" alt="">
                                        </td>
                                        <td style="text-align: left;" class="name-pr">
                                            <?php echo $result['name']; ?>
                                        </td>
                                        <td class="price-pr">
                                            <?php echo $fm->format_currency($result['price']); ?>
                                        </td>
                                        <td class="quantity-box">
                                            <form action="" method="POST">
                                                <input type="hidden" name="cartid" value="<?php echo $result['cartID'] ?>">
                                                <input type="number" name="quantity" value="<?php echo $result['quantity'] ?>" min="1" step="1" class="c-input-text qty text">
                                                <input type="submit" name="submit" id="" value="Cập nhật">
                                            </form>
                                        </td>
                                        <td class="total-pr">
                                            <?php
                                            $total = $result['price'] * $result['quantity'];
                                            echo $fm->format_currency($total) . " VND";
                                            ?>
                                        </td>
                                        <td class="remove-pr">
                                            <a href="?cartid=<?php echo $result['cartID']; ?>">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                    $subtotal += $total;
                                    $qty = $qty + $result['quantity'];
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
        $check_cart = $cart->check_cart();
        if ($check_cart) {
        ?>
            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <div class="d-flex">
                            <h4>Tạm tính</h4>
                            <div class="ml-auto font-weight-bold">
                                <?php echo $fm->format_currency($subtotal) . " VND";
                                Session::set('sum', $subtotal);
                                Session::set('qty', $qty);
                                ?>
                                </td>
                            </div>
                        </div>
                        <div class="d-flex">
                            <h4>Giảm giá</h4>
                            <div class="ml-auto font-weight-bold"> 0 </div>
                        </div>
                        <div class="d-flex gr-total">
                            <h5>Tổng tiền</h5>
                            <div class="ml-auto h5">
                                <?php
                                $total = $subtotal * (1 - 0);
                                echo $fm->format_currency($total) . " VND";
                                ?>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="checkout.php" class="ml-auto btn hvr-hover">Thanh toán</a> </div>
            </div>
        <?php
        } else {
            echo "Giỏ hàng của bạn đang trống !!!";
        }
        ?>
    </div>
</div>
<!-- End Cart -->

<?php include "includes/footer.php" ?>