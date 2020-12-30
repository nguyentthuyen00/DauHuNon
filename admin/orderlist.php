<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/cart.php'; ?>
<?php include_once '../helper/format.php'; ?>

<?php
$cart = new cart();
// gọi class product
// if (!isset($_GET['adminid']) || $_GET['adminid'] == NULL) {
//     // echo "<script> window.location = 'adminlist.php' </script>";

// } else {
//     $id = $_GET['adminid']; // Lấy catid trên host
//     $delAdmin = $admin->del_admin($id); // hàm check delete Name khi submit lên
// }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách đơn hàng</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên đăng nhập</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $show_order = $cart->show_order();
                    if ($show_order) {
                        $i = 0;
                        while ($result = $show_order->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr class="odd gradeX" texta>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['cusUserName']; ?></td>
                                <td><?php echo $result['productID']; ?></td>
                                <td><?php echo $result['productName']; ?></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td><?php echo $result['price']; ?></td>
                                <td><?php echo $result['orderTime']; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>