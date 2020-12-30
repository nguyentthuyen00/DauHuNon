<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>


<?php
$product = new product();
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
    echo "<script> window.location = 'productlist.php' </script>";
} else {
    $id = $_GET['productid']; // Lấy catid trên host
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // The request is using the POST method
    $updateProduct = $product->update_product($_POST, $_FILES, $id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">
            <?php
            if (isset($updateProduct)) {
                echo $updateProduct;
            }
            ?>
            <?php
            $get_product_by_id = $product->getProductById($id);
            if ($get_product_by_id) {
                while ($result_product = $get_product_by_id->fetch_assoc()) {
            ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Mã sản phẩm</label>
                                </td>
                                <td>
                                    <input type="text" name="productID" value="<?php echo $result_product['productID']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tên sản phẩm</label>
                                </td>
                                <td>
                                    <input type="text" name="productName" value="<?php echo $result_product['productName']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Danh mục sản phẩm</label>
                                </td>
                                <td>
                                    <select id="select" name="productCate">
                                        <option>Chọn danh mục</option>
                                        <?php
                                        $cat = new category();
                                        $catList = $cat->show_category();
                                        if ($catList) {
                                            while ($result = $catList->fetch_assoc()) {
                                        ?>
                                                <option <?php
                                                        if ($result['catID'] == $result_product['productCate']) {
                                                            echo 'selected';
                                                        } ?> value="<?php echo $result['catID'] ?>"><?php echo $result['catName'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Mô tả</label>
                                </td>
                                <td>
                                    <textarea name="productDesc" class="tinymce"><?php echo $result_product['productDesc'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Giá</label>
                                </td>
                                <td>
                                    <input type="text" name="productPrice" value="<?php echo $result_product['productPrice']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Ảnh</label>
                                </td>
                                <td>
                                    <img src="uploads/<?php echo $result_product['productImage']; ?>" alt="" height="300px"> </br>
                                    <input type="file" name="productImage" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Loại sản phẩm</label>
                                </td>
                                <td>
                                    <select id="select" name="productType">
                                        <option>Chọn loại sản phẩm</option>
                                        <?php
                                        if ($result_product['productType'] == 1) {
                                        ?>
                                            <option selected value="1">Nổi bật</option>
                                            <option value="0">Không nổi bật</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="1">Nổi bật</option>
                                            <option selected value="0">Không nổi bật</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Cập nhật" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php
                }
            }
            ?>
            <a href="productlist.php"><input type="submit" name="submit" Value="Quay lại" /></a>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>