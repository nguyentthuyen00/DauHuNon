<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/customer.php'; ?>
<?php include_once '../helper/format.php'; ?>

<?php
$cus = new customer();
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
        <h2>Danh sách tài khoản khách hàng</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ</th>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Tên đăng nhập</th>
                        <th>Mật khẩu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $show_cus = $cus->show_customer();
                    if ($show_cus) {
                        $i = 0;
                        while ($result = $show_cus->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr class="odd gradeX" texta>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['cusFirstName']; ?></td>
                                <td><?php echo $result['cusLastName']; ?></td>
                                <td><?php echo $result['cusPhone']; ?></td>
                                <td><?php echo $result['cusEmail']; ?></td>
                                <td><?php echo $result['cusUserName']; ?></td>
                                <td><?php echo $result['cusPassword']; ?></td>
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