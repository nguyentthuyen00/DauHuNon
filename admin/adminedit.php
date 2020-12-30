<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/admin.php'; ?>

<?php
$admin = new admin();
if (!isset($_GET['adminid']) || $_GET['adminid'] == NULL) {
    echo "<script> window.location = 'adminlist.php' </script>";
} else {
    $id = $_GET['adminid']; // Lấy catid trên host
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // The request is using the POST method
    $updateAdmin = $admin->update_admin($_POST, $id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa tài khoản admin</h2>
        <div class="block copyblock">
            <?php
            if (isset($updateAdmin)) {
                echo $updateAdmin;
            }
            ?>
            <?php
            $get_admin_name = $admin->getAdminById($id);
            if ($get_admin_name) {
                while ($result = $get_admin_name->fetch_assoc()) {
            ?>
                    <form action="" method="POST">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Mã admin</label>
                                </td>
                                <td>
                                    <input type="text" name="adminID" value="<?php echo $result['adminID']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tên admin</label>
                                </td>
                                <td>
                                    <input type="text" name="adminName" value="<?php echo $result['adminName']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" name="adminEmail" value="<?php echo $result['adminEmail']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tên đăng nhập</label>
                                </td>
                                <td>
                                    <input type="text" name="adminUser" value="<?php echo $result['adminUser']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Mật khẩu</label>
                                </td>
                                <td>
                                    <input type="text" name="adminPass" value="<?php echo $result['adminPass']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Loại tài khoản</label>
                                </td>
                                <td>
                                    <select id="select" name="adminLevel">
                                        <option>Chọn loại tài khoản</option>
                                        <?php
                                        if ($result_product['adminLevel'] == 1) {
                                        ?>
                                            <option selected value="1">Quản lý</option>
                                            <option value="0">Nhân viên</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="1">Quản lý</option>
                                            <option selected value="0">Nhân viên</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Lưu" />
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
<?php include 'inc/footer.php'; ?>