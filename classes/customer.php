<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helper/format.php');
?>

<?php
class customer
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_customer($data)
    {
        $fname = mysqli_real_escape_string($this->db->link, $data['firstname']);
        $lname = mysqli_real_escape_string($this->db->link, $data['lastname']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $userName = mysqli_real_escape_string($this->db->link, $data['username']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);

        if ($fname == "" || $lname == "" || $phone == "" || $address == "" || $email == "" || $password == "" || $userName == "") {
            $alert = "<span class='error'>Vui lòng điền thông tin còn trống</span>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM customer WHERE cusEmail='$email' LIMIT 1";
            $result_check_mail = $this->db->select($check_email);

            $check_user = "SELECT * FROM customer WHERE cusUserName='$userName' LIMIT 1";
            $result_check_user = $this->db->select($check_user);

            if ($result_check_mail || $result_check_user) {
                $alert = "<span class='error'>Email hoặc tên đăng nhập đã tồn tại</span>";
                return $alert;
            } else {
                $query = "INSERT INTO customer(cusFirstName, cusLastName, cusPhone, cusAddress, cusEmail, cusUserName, cusPassword) VALUES('$fname', '$lname', '$phone','$address','$email', '$userName', '$password') ";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='success'>Tạo tài khoản thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Tạo tài khoản không thành công</span>";
                    return $alert;
                }
            }
        }
    }

    public function show_customer()
    {
        $query = "SELECT * FROM customer";
        $result = $this->db->select($query);
        return $result;
    }

    public function login_customer($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);
        if (empty($email) || empty($password)) {
            $alert = "<span class='error'>Email hoặc mật khẩu không được để trống</span>";
            return $alert;
        } else {
            $check_login = "SELECT * FROM customer WHERE cusEmail='$email' AND cusPassword='$password'";
            $result_check = $this->db->select($check_login);
            if ($result_check) {
                $value = $result_check->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['cusID']);
                Session::set('customer_user', $value['cusUserName']);
                Session::set('customer_name', $value['cusLastName']);
                return "<script> window.location = 'index.php' </script>";
            } else {
                $alert = "<span class='error'>Email và mật khẩu không trùng khớp</span>";
                return $alert;
            }
        }
    }

    public function get_customer($user)
    {
        $query = "SELECT * FROM customer WHERE cusUserName='$user' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_customer($data, $id)
    {
        $fname = mysqli_real_escape_string($this->db->link, $data['firstname']);
        $lname = mysqli_real_escape_string($this->db->link, $data['lastname']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);

        if ($fname == "" || $lname == "" || $phone == "" || $address == "" || $password == "") {
            $alert = "<span class='error'>Trương dữ liệu không được để trống</span>";
            return $alert;
        } else {
            $query = "UPDATE customer SET cusFirstName = '$fname', cusLastName = '$lname', cusPhone = '$phone',
            cusAddress = '$address', cusPassword = '$password'
            WHERE cusUserName ='$id'";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Cập nhật thông tin thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Cập nhật thông tin không thành công</span>";
                return $alert;
            }
        }
    }
}
