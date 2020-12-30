<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helper/format.php');
?>

<?php
class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addToCart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sessionID = session_id();

        $query = "SELECT * FROM product WHERE productID = '$id'";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result['productImage'];
        $name = $result['productName'];
        $price = $result['productPrice'];

        $query_insert_cart = "INSERT INTO cart(productID, quantity, sessionID, image, name, price)
                        VALUES ('$id', '$quantity', '$sessionID', '$image', '$name', '$price')";
        $result_insert_cart = $this->db->insert($query_insert_cart);
        if ($result_insert_cart) {
            echo "<script> window.location = 'cart.php' </script>";
        } else {
            echo "<script> window.location = '404.php' </script>";
        }
    }
    public function getProductCart()
    {
        $sessionID = session_id();
        $query = "SELECT * FROM cart WHERE sessionID = '$sessionID'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_Quantity_Cart($cartid, $quantity)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $query = "UPDATE cart SET quantity = '$quantity' WHERE cartID = '$cartid'";

        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='success'> Số lượng sản phẩm cập nhật thành công</span> ";
            return $msg;
        } else {
            $msg = "<span class='erorr'> Số lượng sản phẩm cập nhật không thành công</span> ";
            return $msg;
        }
    }

    public function del_product_cart($cartid)
    {
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $query = "DELETE FROM cart where cartID = '$cartid'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "<script> window.location = 'cart.php' </script>";
            return $msg;
        } else {
            $msg = "<span class='erorr'>Xóa sản phẩm không thành công</span> ";
            return $msg;
        }
    }
    public function check_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM cart WHERE sessionID = '$sId' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_all_data_cart()
    {
        $sID = session_id();
        $query = "DELETE FROM cart WHERE sessionID = '$sID' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_Order($cusUserName)
    {
        $sID = session_id();
        $query = "SELECT * FROM cart WHERE sessionID = '$sID'";
        $get_product = $this->db->select($query);
        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productID = $result['productID'];
                $productName = $result['name'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $cusUserName = $cusUserName;
                $query_order = "INSERT INTO orderproduct(cusUserName, productID, productName, quantity, price, image) VALUES('$cusUserName', '$productID','$productName', '$quantity', '$price', '$image')";
                $insert_order = $this->db->insert($query_order);
            }
        }
    }
    public function show_order()
    {
        $query = "SELECT * FROM orderproduct ORDER BY orderTime DESC";
        $result = $this->db->select($query);
        return $result;
    }
}
?>