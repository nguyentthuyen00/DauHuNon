<?php
include "./includes/header.php"
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="search-result table-main table-responsive">
                <table class="table">
                    <?php
                    if (isset($_REQUEST['search'])) {
                        $search = addslashes($_GET['search']);
                        if (empty($search)) {
                            $msg = "<span class='erorr'>Vui lòng nhập từ khóa cần tìm</span> ";
                            echo $msg;
                        } else {
                            $search_pro = $product->searchProduct($search);
                            if ($search_pro) {
                                $msg = "<span style = '' class='success'>Kết quả tìm thấy</span> ";
                                echo $msg;
                                $i = 0;
                                while ($result = $search_pro->fetch_assoc()) {
                                    $i++;
                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td class="thumbnail-img">
                                            <a href="shop-detail.php?productid=<?php echo $result['productID']; ?>"><img class="img-fluid" src="admin/uploads/<?php echo $result['productImage']; ?>" alt=""></a>
                                        </td>
                                        <td>
                                            <a class="cart" href="shop-detail.php?productid=<?php echo $result['productID']; ?>">
                                                <?php echo $result['productName'] ?>
                                        </td>
                                        <td>
                                            <a href="shop.php?catid=<?php echo $result['productCate']; ?>"><?php echo $result['productCate']; ?></a>
                                        </td>
                                        <td> <?php echo $fm->format_currency($result['productPrice']) . " VND"; ?></td>
                                    </tr>
                    <?php
                                }
                            } else {
                                $msg = "<span class='erorr'>Không tìm thấy kết quả!!</span> ";
                                echo $msg;
                            }
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include "./includes/footer.php"
?>