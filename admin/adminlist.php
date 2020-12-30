<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/admin.php'; ?>
<?php include_once '../helper/format.php'; ?>

<?php
$admin = new admin();
$format = new Format();
// gọi class product
if (!isset($_GET['adminid']) || $_GET['adminid'] == NULL) {
    // echo "<script> window.location = 'adminlist.php' </script>";

} else {
    $id = $_GET['adminid']; // Lấy catid trên host
    $delAdmin = $admin->del_admin($id); // hàm check delete Name khi submit lên
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách tài khoản</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Mã admin</th>
                        <th>Tên admin</th>
                        <th>Email</th>
                        <th>Tên đăng nhập</th>
                        <th>Mật khẩu</th>
                        <th>Loại tài khoản</th>
                        <th>Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $show_admin = $admin->show_admin();
                    if ($show_admin) {
                        $i = 0;
                        while ($result = $show_admin->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr class="odd gradeX" texta>
                                <td><?php echo $result['adminID']; ?></td>
                                <td><?php echo $result['adminName']; ?></td>
                                <td><?php echo $format->textShorten($result['adminEmail'], 30); ?></td>
                                <td><?php echo $result['adminUser']; ?></td>
                                <td><?php echo $result['adminPass']; ?></td>
                                <td class="center">
                                    <?php
                                    if ($result['adminLevel'] == 1) {
                                        echo "Quản lý";
                                    } else {
                                        echo "Nhân viên";
                                    }
                                    ?>
                                </td>
                                <td><a href="adminedit.php?adminid=<?php echo $result['adminID']; ?>">Edit</a> || <a onclick="return confirm('Bạn có thực sự muốn xóa?')" href="?adminid=<?php echo $result['adminID']; ?>">Delete</a></td>
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