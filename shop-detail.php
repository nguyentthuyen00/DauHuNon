<?php include "includes/header.php"; ?>

<?php
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
    echo "<script> window.location = '404.php' </script>";
} else {
    $id = $_GET['productid']; // Lấy productid trên host
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // The request is using the POST method
    $quantity = $_POST['quantity'];
    $addtocart = $cart->addToCart($quantity, $id);

    // $get_product_cart = $cart->getProductCart();
    // $result = $get_product_cart->fetch_assoc();
    // echo $result['productID'];

    // if ($id == $result['productID']) {
    //     echo "Sản phẩm đã tồn tại trong giỏ hàng";
    // } else {
    //     $addtocart = $cart->addToCart($quantity, $id);
    // }
}
?>

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <?php
            $getproductdetail = $product->getProductDetail($id);
            if ($getproductdetail) {
                while ($result = $getproductdetail->fetch_assoc()) {
            ?>
                    <div class="col-xl-5 col-lg-5 col-md-6">
                        <img class="d-block w-100 img-fluid" src="admin/uploads/<?php echo $result['productImage']; ?>" alt="">
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-6">
                        <div class="single-product-details">
                            <h2><?php echo $result['productName']; ?></h2></br>
                            <h5>Giá: <?php echo $fm->format_currency($result['productPrice']) . " VND"; ?></h5></br>
                            <h4>Danh mục sản phẩm: <?php echo $result['catName']; ?></h4>
                            <hr>
                            <p> <?php echo $result['productDesc']; ?></p>
                            <form action="#" method="POST">
                                <span>Số lượng: </span>
                                <input type="number" name="quantity" value="1" min="1" max="" style="width:80px; text-align: center;">
                                </br>
                                <div class="price-box-bar">
                                    <button class="btn hvr-hover" data-fancybox-close="" type="submit" name="submit">Chọn mua</button>
                                </div>
                            </form>
                        </div>
                <?php
                }
            }
                ?>
                    </div>
        </div>
    </div>
</div>
<!-- End Cart -->

<?php include "includes/footer.php" ?>