<?php
include 'lib/session.php';
Session::init();
?>

<?php
include_once 'lib/database.php';
include_once 'helper/format.php';

spl_autoload_register(function ($className) {
    include_once "classes/" . $className . ".php";
});

$db = new Database();
$fm = new Format();
$cart = new cart();
$product = new product();
$cat = new category();
$cus = new customer();
?>

<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html lang="vn">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Đậu Hủ Non - Cửa hàng đồ ăn vặt Hàn Quốc</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- C:\xampp\htdocs\dauhunon\css\style.css
    C:\xampp\htdocs\dauhunon\includes\header.php -->

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images/dauhunon.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">Về chúng tôi</a></li>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Sản phẩm</a>
                            <ul class="dropdown-menu">
                                <?php
                                $category = $cat->show_category();
                                if ($category) {
                                    while ($result = $category->fetch_assoc()) {
                                ?>
                                        <li><a href="shop.php?catid=<?php echo $result['catID']; ?>"><?php echo $result['catName']; ?></a></li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact-us.php">Liên hệ</a></li>
                    </ul>
                </div>
                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        <li class="cart"><a href="cart.php">
                                <i class="fa fa-shopping-cart"></i>
                            </a></li>
                        <li class="account">
                            <?php
                            $login_check = Session::get('customer_login');
                            if ($login_check == false) {
                                echo '<a href="login.php"><i class="fas fa-user"></i></a>';
                            } else {
                            ?>
                                <!-- // echo '<a href=my-account.php?cusid=' . Session::get('customer_id') . ' ">Đăng xuất
                                // </a>'; -->

                                <a href="my-account.php?id=<?php echo Session::get('customer_user'); ?>">
                                    <strong><?php echo Session::get('customer_name'); ?></strong>
                                </a>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <form class="input-group" method="GET" action="search.php">
                <a href="search.php"><button class=" input-group-addon" type="submit" name="search"><i class="fa fa-search"></i></button></a>
                <input name="search" type="text" class="form-control" placeholder="Tìm kiếm">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </form>
        </div>
    </div>
    <!-- End Top Search -->