<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Electro - HTML Ecommerce Template</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('css/slick.css') ?>" />
    <link type="text/css" rel="stylesheet" href="<?= base_url('css/slick-theme.css') ?>" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('css/nouislider.min.css') ?>" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        footer {
            margin-top: 100px;
        }
    </style>
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('css/style.css') ?>" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
    <!-- HEADER -->
    <header>

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="#" class="logo">
                                <img src="<?= base_url('/img/logo.png') ?> " alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form method="GET">
                                <select name="category" class="input-select">
                                    <option value="">All Categories</option>
                                    <?php
                                    $categories = new \App\Models\CategoryModel();
                                    $no = 1;
                                    foreach ($categories->findAll() as $category) { ?>
                                        <option value="<?= $category['id'] ?>" <?= ($categoryActive == $category['id'] ? 'selected' : '') ?>><?= $category['category_name'] ?></option>
                                    <?php
                                        $no++;
                                    } ?>
                                </select>
                                <input class="input" name='search' placeholder="Search here" value='<?= $search ? $search : '' ?>'>
                                <button type="submit" class="search-btn">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->


    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">List Products</h3>
                        <div class="section-nav">
                            <!-- <ul class="section-tab-nav tab-nav">
                                <?php
                                $no = 1;
                                foreach ($categories->findAll() as $category) { ?>
                                    <li class=" <?= ($no == 1 ? 'active' : '') ?>"><a data-toggle="tab" href="#tab<?= $no ?>"><?= $category['category_name'] ?></a></li>
                                <?php
                                    $no++;
                                } ?>
                            </ul> -->
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <?php if ($products == null) : ?>
                    <script>
                        alert('Produk tidak ada !!');
                    </script>
                <?php endif ?>
                <div class="col-md-12">
                    <div class="row">
                        <?php
                        $categoryModel = new \App\Models\CategoryModel();
                        foreach ($products as $product) {
                            $price = number_format($product['data_product']['product_price'], 0, ",", ".");
                            $image = $product['images'];
                        ?>
                            <!-- product -->
                            <div class="product col-md-3">
                                <div class="product-img">
                                    <img src="<?= $image[0]['image'] ?? '' ?>" alt="" height="200">
                                    <div class="product-label">
                                        <span class="sale">Stock <?= $product['data_product']['product_stock'] ?></span>
                                        <span class="new">NEW</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"><?= $categoryModel->find($product['data_product']['product_category'])['category_name'] ?></p>
                                    <h3 class="product-name"><a href="#"><?= $product['data_product']['product_name'] ?></a></h3>
                                    <h4 class="product-price">Rp. <?= $price ?></h4>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a href="<?= base_url('product/' . $product['data_product']['id']) ?>">
                                        <div class="product-btns">
                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                        </div>
                                    </a>
                                </div>
                                <div class="add-to-cart">
                                    <?php
                                    $whatsapp = new \App\Models\SettingModel();
                                    $whatsapp = $whatsapp->first() ? $whatsapp->first()['whatsapp'] : '';
                                    ?>
                                    <a href="https://wa.me/<?= $whatsapp ?>?text=%23informasi_produk%0D%0ADengan+Nama+%3A+<?= $product['data_product']['product_name'] ?>%0D%0ATanggal+%3A+<?= date('Y-m-d') ?>">
                                        <button class="add-to-cart-btn"><i class="fa fa-whatsapp"></i> WhatsApp</button>
                                    </a>
                                </div>
                            </div>
                            <!-- /product -->
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <div class="w-100 d-flex">
                <div class="ms-auto">
                    <?= $pager->links('page', 'bootstrap_pagination') ?>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


    <!-- FOOTER -->
    <footer id="footer" class="mt-5">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <!-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo error eum </p> -->
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>Dsn Medalem Timur RT/01 RW/03 Ds prayungan Kec Sumberrejo.</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+62 822-4564-5833</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>farisyanuarta123@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li><a href="#">Hot deals</a></li>
                                <li><a href="#">Laptops</a></li>
                                <li><a href="#">Smartphones</a></li>
                                <li><a href="#">Cameras</a></li>
                                <li><a href="#">Accessories</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="<?= base_url('js/jquery.min.js') ?> "></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?> "></script>
    <script src="<?= base_url('js/slick.min.js') ?> "></script>
    <script src="<?= base_url('js/nouislider.min.js') ?> "></script>
    <script src="<?= base_url('js/jquery.zoom.min.js') ?> "></script>
    <script src="<?= base_url('js/main.js') ?> "></script>

</body>

</html>