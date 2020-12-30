<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>
<?php include_once '../helper/format.php'; ?>

<?php
$product = new product();
$format = new Format();
// gọi class product
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
	// echo "<script> window.location = 'catlist.php' </script>";

} else {
	$id = $_GET['productid']; // Lấy catid trên host
	$delProduct = $product->del_product($id); // hàm check delete Name khi submit lên
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách sản phẩm</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Mã SP</th>
						<th>Tên SP</th>
						<th>Giá</th>
						<th>Ảnh</th>
						<th>Danh mục</th>
						<!-- <th>Mô tả</th> -->
						<th>Loại SP</th>
						<th>Xử lý</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$show_product = $product->show_product();
					if ($show_product) {
						$i = 0;
						while ($result = $show_product->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX" texta>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productID']; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><?php echo $result['productPrice']; ?></td>
								<td><img src="uploads/<?php echo $result['productImage']; ?>" alt="" height="50px"></td>
								<td><?php echo $result['productCate']; ?></td>
								<!-- <td><?php echo $format->textShorten($result['productDesc'], 20); ?></td> -->
								<td class="center">
									<?php
									if ($result['productType'] == 1) {
										echo "Nổi bật";
									} else {
										echo "Không nổi bật";
									}
									?>
								</td>
								<td><a href="productedit.php?productid=<?php echo $result['productID']; ?>">Edit</a> || <a onclick="return confirm('Bạn có thực sự muốn xóa?')" href="?productid=<?php echo $result['productID']; ?>">Delete</a></td>
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