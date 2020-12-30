<?php include "./includes/header.php" ?>
<?php include "./includes/slider.php" ?>

<br>
<br>

<div class="instagram-box">
	<div class="container">
		<div class="row">
			<div class="col-lg-6" style="text-align:justify;">
				<h2 class="noo-sh-title">Chúng mình là <span>Đậu Hủ Non!</span></h2>
				</br>
				<p>Bắt đầu từ đam mê tất tần tật về Hàn Quốc, xe bánh gạo cay đầu tiên được đẩy ra lề đường Sài Gòn
					để các bạn cùng yêu thích món ăn này có thể tạt ngang mua một cách tiện lợi và vừa túi tiền nhất.
				</p>
				<p>Hàn Quốc không chỉ là đất nước của nhân sâm, của môn võ Taekwondo đẹp mắt,
					của làn sóng âm nhạc được coi là phổ biến nhất thế giới,
					mà còn là đất nước của những món ăn ngon.
					Những món ăn Hàn Quốc từ lâu đã rất được thực khách Việt Nam ưa chuộng bởi
					bên ngoài các món ăn này được trang trí đẹp mắt, khiến ta không thể rời mắt,
					cùng với đó ẩm thực Hàn Quốc có nhiều nét tương đồng với ẩm thực Việt Nam nên càng được ưa chuộng.
				</p>
				<p><strong>Đậu Hủ Non</strong> cung cấp những thực phẩm đồ ăn liền đến từ Hàn Quốc, cũng như nguyên liệu để mọi người có thể tự
					chế biến các món ăn ngay tại nhà</p>
				<p>Trải nghiệm cùng <strong>Đậu Hủ Non</strong> ngay nào!!</p>
			</div>
			<div class="col-lg-6">
				<div class="banner-frame"> <img class="img-thumbnail img-fluid" src="images/korean.jpg" alt="" />
				</div>
			</div>
		</div>

		<br>
		<hr>
		<br>

		<!-- Sản phẩm nổi bật -->
		<div class="row">
			<div class="col-lg-12">
				<div class="title-all text-center">
					<h1>Sản phẩm nổi bật</h1>
					<p>
						Đậu Hủ Non - Cửa hàng đồ ăn Hàn Quốc
					</p>
				</div>
			</div>

			<div class="main-instagram owl-carousel owl-theme">
				<?php
				$product_feature = $product->getProductFeature();
				if ($product_feature) {
					while ($result = $product_feature->fetch_assoc()) {
				?>
						<div class="item">
							<div class="products-single">
								<img src="admin/uploads/<?php echo $result['productImage']; ?>" alt="">
								<span>
									<a class="cart" href="shop-detail.php?productid=<?php echo $result['productID']; ?>" style="color: #d0a772; font-weight: bold;">Chi tiết</a>
								</span>
							</div>
							<a class="name" href="shop-detail.php?productid=<?php echo $result['productID']; ?>">
								<h6><?php echo $result['productName']; ?></h6>
							</a>
							<h5 class="price"><?php echo $fm->format_currency($result['productPrice']) . " VND"; ?></h5>
						</div>
				<?php
					}
				}
				?>
			</div>
		</div>

		<br>
		<hr>
		<br>

		<!-- Team  -->
		<div class="row">
			<div class="col-lg-12">
				<div class="title-all text-center">
					<h1>Flames Team</h1>
					<p>
						Đậu Hủ Non - Cửa hàng đồ ăn Hàn Quốc
					</p>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-4">
				<div class="our-team"> <img src="images/_DSC0070.jpg" alt="" />
				</div>
				<div class="team-description">
					<h3>Nguyễn Thị Thu Huyền - 18520863</h3>
				</div>
				<hr class="my-0">
			</div>
			<div class="col-4">
				<div class="our-team"> <img src="images/20201205_101138.jpg" alt="" />
				</div>
				<div class="team-description">
					<h3>Phù Hữu Đạt - 18520863</h3>
				</div>
				<hr class="my-0">
			</div>
		</div>

	</div>
</div>


<?php include "./includes/footer.php" ?>