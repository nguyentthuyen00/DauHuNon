<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/admin.php'; ?>

<?php
$admin = new admin();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // The request is using the POST method
    $insertAdmin = $admin->insert_admin($_POST);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm tài khoản admin</h2>
        <?php
        if (isset($insertAdmin)) {
            echo $insertAdmin;
        }
        ?>
        <div class="block copyblock">
            <form action="adminadd.php" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label>Mã admin</label>
                        </td>
                        <td>
                            <input type="text" name="adminID" placeholder="Mã admin ..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tên admin</label>
                        </td>
                        <td>
                            <input type="text" name="adminName" placeholder="Tên admin ..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="adminEmail" placeholder="Email admin ..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tên đăng nhập</label>
                        </td>
                        <td>
                            <input type="text" name="adminUser" placeholder="Tên đăng nhập ..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Mật khẩu</label>
                        </td>
                        <td>
                            <input type="text" name="adminPass" placeholder="Mật khẩu ..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Level</label>
                        </td>
                        <td>
                            <select id="select" name="adminLevel">
                                <option>Loại tài khoản</option>
                                <option value="1">Quản lý</option>
                                <option value="0">Nhân viên</option>
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
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>