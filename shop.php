<?php
include 'includes/header.php';
// include 'inc/slider.php';
?>
<?php

if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script> window.location = '404.php' </script>";
} else {
    $id = $_GET['catid']; // Lấy catid trên host
}
// gọi class category
// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
//     $catName = $_POST['catName'];
//     $updateCat = $cat -> update_category($catName,$id); // hàm check catName khi submit lên
// }
?>

<div class="shop-box-inner">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                <div class="product-categori">
                    <div class="filter-sidebar-left">
                        <div class="title-left">
                            <h3>Danh mục sản phẩm</h3>
                        </div>
                        <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                            <?php
                            $cate = $cat->show_category();
                            if ($cate) {
                                while ($result = $cate->fetch_assoc()) {
                            ?>
                                    <a href="shop.php?catid=<?php echo $result['catID'] ?>" class="list-group-item list-group-item-action"> <?php echo $result['catName'] ?></a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                <div class="container">
                    <div class="row">
                        <?php
                        $get_product_by_cate = $cat->get_Product_By_Cate($id);
                        if ($get_product_by_cate) {
                            while ($result = $get_product_by_cate->fetch_assoc()) {
                        ?>
                                <div class="col-4 why-text">
                                    <img class="products-single" src="admin/uploads/<?php echo $result['productImage']; ?>" alt="">
                                    <h4><?php echo $result['productName']; ?></h4>
                                    <h5 class="price"><?php echo $fm->format_currency($result['productPrice']) . " VND"; ?></h5>
                                    <a href="shop-detail.php?productid=<?php echo $result['productID']; ?>" class="price-box-bar">
                                        <button class="btn hvr-hover" data-fancybox-close="" type="submit" name="submit">Chi tiết</button>
                                    </a>
                                    <hr>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>