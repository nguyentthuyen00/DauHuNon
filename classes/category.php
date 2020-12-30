<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helper/format.php');
?>

<?php
class category
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName, $catID)
    {
        $catName = $this->fm->validation($catName);
        $catID = $this->fm->validation($catID);

        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $catID = mysqli_real_escape_string($this->db->link, $catID);

        if (empty($catName) || empty($catID)) {
            $alert = "<span class = 'error'> Không được để trống </span>";
            return $alert;
        } else {
            $query = "INSERT INTO category VALUES ('$catID', '$catName')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class = 'success'> Thêm danh mục sản phẩm thành công </span> ";
                return $alert;
            } else {
                $alert = "<span class = 'error'> Thêm danh mục sản phẩm không thành công </span> ";
                return $alert;
            }
        }
    }

    public function show_category()
    {
        $query = "SELECT * FROM category ORDER BY catID ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($data, $id)
    {
        // $catName = $this->fm->validation($catname);
        // $catID = $this->fm->validation($id);

        $catName = mysqli_real_escape_string($this->db->link, $data['catName']);
        $catID = mysqli_real_escape_string($this->db->link, $data['catID']);

        if ($catName == "" || $catID == "") {
            $alert = "<span class = 'error'> Trường dữ liệu không được để trống </span>";
            return $alert;
        } else {
            $query = "UPDATE category SET catName = '$catName', catID = '$catID' WHERE catID = '$id'";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class = 'success'> Cập nhật danh mục sản phẩm thành công </span> ";
                return $alert;
            } else {
                $alert = "<span class = 'error'> Cập nhật danh mục sản phẩm không thành công </span> ";
                return $alert;
            }
        }
    }

    public function getCatById($id)
    {
        $query = "SELECT * FROM category WHERE catID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getNameByCat($id)
    {
        $query = "SELECT product.* category.catName, category.catID 
					  FROM product, category 
					  WHERE product.productCate = category.catID
					  AND product.productCate='$id' LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function del_category($id)
    {
        $query = "DELETE FROM category where catID = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Xóa danh mục sản phẩm thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Xóa danh mục sản phẩm không thành công</span>";
            return $alert;
        }
    }
    public function get_Product_By_Cate($id)
    {
        $query = "SELECT * FROM product WHERE productCate = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>
