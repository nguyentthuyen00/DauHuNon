<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helper/format.php');
?>

<?php
class admin
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_admin($data)
    {
        $adminID = mysqli_real_escape_string($this->db->link, $data['adminID']);
        $adminName = mysqli_real_escape_string($this->db->link, $data['adminName']);
        $adminEmail = mysqli_real_escape_string($this->db->link, $data['adminEmail']);
        $adminUser = mysqli_real_escape_string($this->db->link, $data['adminUser']);
        $adminPass = mysqli_real_escape_string($this->db->link, $data['adminPass']);
        $adminLevel = mysqli_real_escape_string($this->db->link, $data['adminLevel']);

        if ($adminID == "" || $adminName == "" || $adminEmail == "" || $adminUser == "" || $adminPass == "" || $adminLevel == "") {
            $alert = "<span class = 'fail'> Trường dữ liệu không được để trống </span>";
            return $alert;
        } else {
            $query = "INSERT INTO admin
                    VALUES ('$adminID', '$adminName', '$adminEmail', '$adminUser', '$adminPass', '$adminLevel')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class = 'success'> Thêm tài khoản thành công </span> ";
                return $alert;
            } else {
                $alert = "<span class = 'fail'> Thêm tài khoản không thành công </span> ";
                return $alert;
            }
        }
    }
    public function show_admin()
    {
        $query = "SELECT * FROM admin ORDER BY adminName ASC";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_admin($data, $id)
    {
        $adminID = mysqli_real_escape_string($this->db->link, $data['adminID']);
        $adminName = mysqli_real_escape_string($this->db->link, $data['adminName']);
        $adminEmail = mysqli_real_escape_string($this->db->link, $data['adminEmail']);
        $adminUser = mysqli_real_escape_string($this->db->link, $data['adminUser']);
        $adminPass = mysqli_real_escape_string($this->db->link, $data['adminPass']);
        $adminLevel = mysqli_real_escape_string($this->db->link, $data['adminLevel']);

        if ($adminID == "" || $adminName == "" || $adminEmail == "" || $adminUser == "" || $adminPass == "" || $adminLevel == "") {
            $alert = "<span class = 'error'> Trường dữ liệu không được để trống </span>";
            return $alert;
        } else {
            $query = "UPDATE admin SET 
            adminID = '$adminID',
            adminName = '$adminName',
            adminEmail = '$adminEmail',
            adminUser = '$adminUser',
            adminPass = '$adminPass', 
            adminLevel = '$adminLevel'
            WHERE adminID = '$id'";
        }
        $result = $this->db->update($query);
        if ($result) {
            $alert = "<span class='success'>Cập nhật tài khoản thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Cập nhật tài khoản không thành công</span>";
            return $alert;
        }
    }

    public function getAdminById($id)
    {
        $query = "SELECT * FROM admin WHERE adminID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_admin($id)
    {
        $query = "DELETE FROM admin where adminID = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Xóa tài khoản thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Xóa tài khoản không thành công</span>";
            return $alert;
        }
    }
}
?>
