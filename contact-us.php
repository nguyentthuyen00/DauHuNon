<?php include "includes/header.php" ?>

<!-- Start Contact Us  -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <div class="contact-info-left">
                    <h2>THÔNG TIN LIÊN HỆ</h2>
                    </br>
                    <p style="text-align:justify;">Bắt đầu từ đam mê tất tần tật về Hàn Quốc, xe bánh gạo cay đầu tiên được đẩy ra lề đường Sài Gòn
                        để các bạn cùng yêu thích món ăn này có thể tạt ngang mua một cách tiện lợi và vừa túi tiền nhất.</p>
                    <ul>
                        <li>
                            <p><i class="fas fa-map-marker-alt"></i>Địa chỉ: Khu phố 6, Linh Trung, Thủ Đức, Hồ Chí Minh </p>
                        </li>
                        <li>
                            <p><i class="fas fa-phone-square"></i>Số điện thoaị: <a href="tel:+1-888705770">+84 968 294 003</a></p>
                        </li>
                        <li>
                            <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">
                    <h2>LIÊN HỆ</h2>
                    </br>
                    <p>Nếu cần hỗ trợ hãy nhắn cho chúng mình ngay nhé !!!</p>
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên" required data-error="Vui lòng nhập tên của bạn">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Email" id="email" class="form-control" name="name" required data-error="Vui lòng nhập tên của email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subject" name="name" placeholder="Chủ đề" required data-error="Vui lòng nhập chủ đề">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="message" placeholder="Lời nhắn" rows="4" data-error="Nhớ để lại lời nhắn nhé" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" id="submit" type="submit">Gửi</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Cart -->

<?php include "includes/footer.php" ?>