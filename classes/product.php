<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helper/format.php');
?>
<?php
class product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {
        $productID = mysqli_real_escape_string($this->db->link, $data['productID']);
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $productCate = mysqli_real_escape_string($this->db->link, $data['productCate']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $productPrice = mysqli_real_escape_string($this->db->link, $data['productPrice']);
        $productType = mysqli_real_escape_string($this->db->link, $data['productType']);
        // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['productImage']['name'];
        $file_size = $_FILES['productImage']['size'];
        $file_temp = $_FILES['productImage']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productID == "" || $productName == "" || $productCate == "" || $productDesc == "" || $productPrice == "" || $productType == "" || $file_name == "") {
            $alert = "<span class = 'fail'>Trường dữ liệu không được để trống </span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);

            $query = "INSERT INTO product(productID, productName, productCate, productDesc, productPrice, productImage, productType)
                        VALUES ('$productID', '$productName', '$productCate', '$productDesc', '$productPrice', '$unique_image', '$productType')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class = 'success'> Thêm sản phẩm thành công </span> ";
                return $alert;
            } else {
                $alert = "<span class = 'fail'> Thêm sản phẩm không thành công </span> ";
                return $alert;
            }
        }
    }

    public function show_product()
    {
        $query = "SELECT * FROM product ORDER BY productName ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $files, $id)
    {
        $productID = mysqli_real_escape_string($this->db->link, $data['productID']);
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $productCate = mysqli_real_escape_string($this->db->link, $data['productCate']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $productPrice = mysqli_real_escape_string($this->db->link, $data['productPrice']);
        $productType = mysqli_real_escape_string($this->db->link, $data['productType']);
        //Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['productImage']['name'];
        $file_size = $_FILES['productImage']['size'];
        $file_temp = $_FILES['productImage']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        // $file_current = strtolower(current($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;


        if ($productID == "" || $productName == "" || $productCate == "" || $productDesc == "" || $productPrice == "" || $productType == "") {
            $alert = "<span class = 'fail'> Trường dữ liệu không được để trống </span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                //Nếu người dùng chọn ảnh
                if ($file_size > 102400) {
                    $alert = "<span class='success'>Kích cỡ ảnh nhỏ hơn 10MB</span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) === false) {
                    // echo "<span class='error'>Chỉ có thể cập nhật ảnh:".implode(', ', $permited)."</span>";	
                    $alert = "<span class='success'>Bạn chỉ có thể update ảnh: " . implode(', ', $permited) . "</span>";
                    return $alert;
                }
                $query = "UPDATE product SET
                productID = '$productID',
                productName = '$productName',
                productCate = '$productCate',
                productDesc = '$productDesc',
                productPrice = '$productPrice',
                productImage = '$unique_image',
                productType = '$productType'
                WHERE productID == '$id';";
            } else {
                //Nếu người dùng không chọn ảnh
                $query = "UPDATE product SET
                productID = '$productID',
                productName = '$productName',
                productCate = '$productCate',
                productDesc = '$productDesc',
                productPrice = '$productPrice',
                productType = '$productType'
                WHERE productID = '$id'";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Cập nhật không sản phẩm thành công</span>";
                return $alert;
            }
        }
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM product WHERE productID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_product($id)
    {
        $query = "DELETE FROM product where productID = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Xóa sản phẩm thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Xóa sản phẩm không thành công</span>";
            return $alert;
        }
    }

    public function getProductFeature()
    {
        $query = "SELECT * FROM product WHERE productType = '1'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProductDetail($id)
    {
        $query = "SELECT product.*, category.catName
			 FROM product INNER JOIN category ON product.productCate = category.catID
			 WHERE product.productID = '$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function searchProduct($keyword)
    {
        $query = "SELECT *FROM product WHERE productID LIKE '%$keyword%' OR productName LIKE '%$keyword%'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>
