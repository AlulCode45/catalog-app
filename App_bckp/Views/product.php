<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.0/dist/css/splide.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js' integrity='sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==' crossorigin='anonymous'></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        <?php $no = 1; ?><?php foreach ($products as $product) : ?>
        .section-products #product-<?= $no++ ?> .part-1::before {
            background: url("<?= $product['product_image'] ?>") no-repeat center;
            background-size: cover;
            transition: all 0.3s;
        }

        <?php endforeach; ?>
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="<?= base_url('/img/mentahan Logo BELANJA BUNGA.png') ?>" alt="Logo" class="d-block" width="64" height="64">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <img src="<?= base_url('/img/menu.png') ?>" width="25" height="25">
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto text-center">
                    <a class="nav-link navbar-active" aria-current="page" href="#">Home</a>
                    <a class="nav-link" href="#tentang">Tetang</a>
                    <a class="nav-link" href="#produk">Produk</a>
                    <a class="nav-link" href="#hub-kami">Hubungi kami</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="splide mx-3" role="group" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <ul class="splide__list slider-image">
                <li class="splide__slide">
                    <img src="https://www.orchid-florist.com/uploads/desktop/fd21988efd1b0b6d60879c061f04b883816a385c.jpg" alt="Corporate " class="slider-image">
                </li>
                <li class="splide__slide">
                    <img src="https://www.orchid-florist.com/uploads/desktop/299cb868809dc07fbc93aaae5e3157e7b9cb39cd.jpg" alt="Wedding " class="slider-image">
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <hr class="content-line">
        <section class="section-products" id="produk">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="header">
                            <h3>Featured Product</h3>
                            <h2>All Products</h2>
                        </div>
                    </div>
                </div>
                <div class="w-100 d-flex">
                    <form class="ms-auto">
                        <input type="text" name='search' value='<?= $search ?>' class="form-control rounded rounded-pill" placeholder="Find Product">
                    </form>
                </div>
                <?php if($products == null): ?>
                    <script>
                        alert('Produk tidak ada !!');
                    </script>
                <?php endif ?>
                <div class="row" id="cart-result">
                    <?php $no = 1; ?>
                    <?php foreach ($products as $product) : ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                            <div id="product-<?= $no++ ?>" class="single-product">
                                <div class="part-1">
                                    <?php if ($product['product_discount']) : ?>
                                    <?php $discount = $discountModel->find($product['product_discount']); ?>
                                        <span class="discount"><?= $discount['discount_percent'] ?>% off</span>
                                    <?php endif ?>
                                    <ul>
                                        <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                                <div class="part-2">
                                    <h3 class="product-title"><?= $product['product_name'] ?></h3>
                                    <?php if ($product['product_discount']) : ?>
                                    <?php $discount = $discountModel->find($product['product_discount']); ?>
                                    <?php $price = $product['product_price'] - ($product['product_price'] * $discount['discount_percent'] / 100); ?>
                                    <div class="row">
                                        <div class="col-5">
                                            <h6 class="product-price"><s>Rp <?= $product['product_price'] ?></s></h6>
                                        </div>
                                        <div class="col-7">
                                            <h4 class="product-price text-pink">Rp <?= $price ?></h4>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="w-100 d-flex">
                <div class="ms-auto">
                    <?= $pager->links('page', 'bootstrap_pagination') ?>
                </div>
            </div>
        </section>
    </div>
    <!-- Site footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h6>About</h6>
                    <p class="text-justify">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis temporibus
                        sunt porro iure reiciendis magni alias facilis expedita dolorum, cupiditate commodi
                        exercitationem dolorem harum aspernatur quas necessitatibus delectus saepe veritatis?</p>
                </div>

                <div class="col-xs-6 col-md-3">
                    <h6>Categories</h6>
                    <ul class="footer-links">
                        <?php foreach ($categories as $category) { ?>
                            <li><a href=""><?= $category['category_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="col-xs-6 col-md-5">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.645042434485!2d112.0367740311271!3d-7.166968259643877!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7786234fde8261%3A0x93366a78cf4c0f98!2sSPBU%20Pertamina%2054.621.02!5e0!3m2!1sid!2sid!4v1650023286555!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-100 h-100"></iframe>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p class="copyright-text">Copyright &copy; 2017 All Rights Reserved by
                        <a href="#">Scanfcode</a>.
                    </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="social-icons">
                        <li><a class="facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a class="dribbble" href="#"><i class="fab fa-dribbble"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.0/dist/js/splide.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.4.2/dist/js/splide-extension-auto-scroll.min.js">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.js' integrity='sha512-TsDUjQW16/G8fz4gmgTOBW2s2Oi6TPUtQ6/hm+TxZZdkQtQrK5xEFIE0rgDuz5Cl1xQU1u3Yer7K5IuuBeiCqw==' crossorigin='anonymous'></script>
    <script>
        AOS.init({
            duration: 1300
        });
        new Splide('.splide', {
            autoScroll: {
                speed: 2
            }
        }).mount();
        document.addEventListener("DOMContentLoaded", function(event) {
            const cartButtons = document.querySelectorAll('.cart-button');
            cartButtons.forEach(button => {
                button.addEventListener('click', cartClick);
            });

            function cartClick() {
                let button = this;
                button.classList.add('clicked');
            }
        });
    </script>
</body>

</html>