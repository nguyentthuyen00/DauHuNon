<?php include "includes/header.php" ?>

<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $cusUserName = Session::get('customer_user');
    $insertOrder = $cart->insert_Order($cusUserName);
    $delCart = $cart->del_all_data_cart();
    echo "<script> window.location = 'success.php' </script>";
}
?>
<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="checkout-address">
                            <div class="title-left">
                                <h3>Thông tin giao hàng</h3>
                            </div>
                            <?php
                            $id = Session::get('customer_user');
                            $getCustomer = $cus->get_customer($id);
                            if ($getCustomer) {
                                while ($result = $getCustomer->fetch_assoc()) {
                            ?>
                                    <form action="">
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label class="labels">Họ</label>
                                                <input type="text" class="form-control" value="<?php echo $result['cusFirstName']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="labels">Tên</label>
                                                <input type="text" class="form-control" value="<?php echo $result['cusLastName']; ?>">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels">Số điện thoại</label>
                                                <input type="text" class="form-control" value="<?php echo $result['cusPhone']; ?>">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Địa chỉ</label>
                                                <input type="text" class="form-control" value="<?php echo $result['cusAddress']; ?>">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Email</label>
                                                <input type="text" class="form-control" value="<?php echo $result['cusEmail']; ?>">
                                            </div>
                                        </div>
                                    </form>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        </br>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="shipping-method-box">
                            <div class="title-left">
                                <h3>Phương thức giao hàng</h3>
                            </div>
                            <div class="mb-4">
                                <div class="custom-control custom-radio">
                                    <input id="shippingOption1" name="shipping-option" class="custom-control-input" checked="checked" type="radio">
                                    <label class="custom-control-label" for="shippingOption1">Ship COD</label> <span class="float-right font-weight-bold">15.000 VND</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="order-box">
                            <div class="title-left">
                                <h3>Đơn hàng</h3>
                            </div>
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
                                                            $subtotal += $total;
                                                            $qty = $qty + $result['quantity'];
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <?php
                        $check_cart = $cart->check_cart();
                        if ($check_cart) {
                        ?>
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
                                    <h4>Ship</h4>
                                    <div class="ml-auto font-weight-bold"> 15.000 VND </div>
                                </div>
                                <div class="d-flex gr-total">
                                    <h5>Tổng tiền</h5>
                                    <div class="ml-auto h5">
                                        <?php
                                        $total = $subtotal + 15000;
                                        echo $fm->format_currency($total) . " VND";
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12 d-flex shopping-box">
                                    <a href="?orderid=order" class="ml-auto btn hvr-hover">Đặt hàng</a>
                                </div>
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
<!-- End Cart -->

<?php include "includes/footer.php" ?>