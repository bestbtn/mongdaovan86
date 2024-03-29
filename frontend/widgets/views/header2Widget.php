<?php

use yii\helpers\Url;

?>
<header class="main-header_area-2">
    <div class="header-top_area d-none d-lg-block">
        <div class="container">
            <div class="header-top_nav">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ht-menu">
                            <ul>
                                <li><a href="javascript:void(0)">Currency<i class="ion-chevron-down"></i></a>
                                    <ul class="ht-dropdown ht-currency">
                                        <li><a href="javascript:void(0)">€ EUR</a></li>
                                        <li class="active"><a href="javascript:void(0)">£ Pound Sterling</a></li>
                                        <li><a href="javascript:void(0)">$ Us Dollar</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">Language <i class="ion-chevron-down"></i></a>
                                    <ul class="ht-dropdown">
                                        <li class="active"><a href="javascript:void(0)"><img
                                                        src="/images/menu/icon/1.jpg" alt="Kenne Language Icon">English</a>
                                        </li>
                                        <li><a href="javascript:void(0)"><img src="/images/menu/icon/2.jpg"
                                                                              alt="Kenne Language Icon">Français</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header-top_right">
                            <ul>
                                <?php if (!Yii::$app->user->isGuest) { ?>
                                    <li>
                                        <a href="<?= Url::toRoute('/account') ?>">My Account</a>
                                    </li>
                                    <li>
                                        <a href="<?= Url::toRoute('/wishlist') ?>">Wishlist</a>
                                    </li>
                                    <li>
                                        <a href="<?= Url::toRoute('/checkout') ?>">Checkout</a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?= Url::toRoute('/checkout') ?>">Checkout</a>
                                    </li>
                                    <li>
                                        <a href="<?= Url::toRoute('/site/singup') ?>">Register</a>
                                    </li>
                                    <li>
                                        <a href="<?= Url::toRoute('/site/login') ?>">Sign in</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-middle_nav">
                        <div class="header-logo_area">
                            <a href="<?= Url::home() ?>">
                                <img src="/images/menu/logo/1.png" alt="Header Logo">
                            </a>
                        </div>
                        <div class="header-contact d-none d-md-flex">
                            <i class="fa fa-headphones-alt"></i>
                            <div class="contact-content">
                                <p>
                                    Gọi cho chúng tôi
                                    <br>
                                    Hỗ trợ miễn phí: (0938) 800 456
                                </p>
                            </div>
                        </div>
                        <div class="header-search_area d-none d-lg-block">
                            <form class="search-form" action="<?= Url::toRoute(['/shop']) ?>">
                                <input type="text" placeholder="Search" name="key">
                                <button class="search-button"><i class="ion-ios-search"></i></button>
                            </form>
                        </div>
                        <div class="header-right_area d-none d-lg-inline-block">
                            <ul>
                                <li class="mobile-menu_wrap d-flex d-lg-none">
                                    <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                        <i class="ion-android-menu"></i>
                                    </a>
                                </li>
                                <li class="minicart-wrap">
                                    <a href="#miniCart" class="minicart-btn toolbar-btn">
                                        <div class="minicart-count_area">
                                            <?php if (isset($total)) { ?>
                                                <span class="item-count"><?= $total ?></span>
                                            <?php } else { ?>
                                                <span class="item-count">0</span>
                                            <?php } ?>
                                            <i class="ion-bag"></i>
                                        </div>
                                        <div class="minicart-front_text">
                                            <span>Cart:</span>
                                            <span class="total-price">
                                        <?= isset($totalPrice) ? number_format($totalPrice, 0, ',', '.') : '0' ?> đ
                                                    </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="header-right_area header-right_area-2 d-inline-block d-lg-none">
                            <ul>
                                <li class="mobile-menu_wrap d-inline-block d-lg-none">
                                    <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                        <i class="ion-android-menu"></i>
                                    </a>
                                </li>
                                <li class="minicart-wrap">
                                    <a href="#miniCart" class="minicart-btn toolbar-btn">
                                        <div class="minicart-count_area">
                                            <span class="item-count">03</span>
                                            <i class="ion-bag"></i>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#searchBar" class="search-btn toolbar-btn">
                                        <i class="pe-7s-search"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#offcanvasMenu"
                                       class="menu-btn toolbar-btn color--white d-none d-lg-block">
                                        <i class="ion-android-menu"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom_area d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu_area position-relative">
                        <nav class="main-nav d-flex justify-content-center">
                            <ul>
                                <li class="dropdown-holder"><a href="<?= Url::home() ?>">Home</a>
                                </li>
                                <li class="dropdown-holder">
                                    <a href="<?= Url::toRoute(['/shop']) ?>">Shop
                                        <i class="ion-chevron-down"></i>
                                    </a>
                                    <ul class="kenne-dropdown">
                                        <?php if (isset($data)) { ?>
                                            <?php foreach ($data as $item) { ?>
                                                <li>
                                                    <a href="<?= Url::toRoute(['/shop/', 'slug' => $item['cat_slug']]) ?>"> <?= $item['cat_name'] ?></a>
                                                </li>
                                            <?php }
                                        } ?>

                                    </ul>
                                </li>
                                <li><a href="<?= Url::toRoute(['/blog']) ?>">Blog</a>
                                    <!--<li><a href="blog-details.html">Blog Details</a></li>-->
                                </li>
                                <li><a href="<?= Url::toRoute('/contact-us') ?>">Contact Us</a></li>
                                <li><a href="<?= Url::toRoute(['/about-us']) ?>">About Us</a></li>
                                <li><a href="<?php Url::toRoute('/account') ?>">My Account <i
                                                class="ion-chevron-down"></i></a>
                                    <ul class="kenne-dropdown">
                                        <?php if (!Yii::$app->user->isGuest) { ?>
                                            <li><a href="<?= Url::toRoute(['/account']) ?>">My Account</a></li>
                                            <li><a href="<?= Url::toRoute(['/wishlist']) ?>">Wishlist</a></li>
                                            <li><a href="<?= Url::toRoute(['/cart']) ?>">Cart</a></li>
                                            <li><a href="<?= Url::toRoute(['/checkout']) ?>">Checkout</a></li>
                                        <?php } else { ?>
                                            <li><a href="<?= Url::toRoute(['/site/login']) ?>">Login</a></li>
                                            <li><a href="<?= Url::toRoute(['/site/signup']) ?>">Register</a></li>
                                            <li><a href="<?= Url::toRoute(['/cart']) ?>">Cart</a></li>
                                            <li><a href="<?= Url::toRoute(['/checkout']) ?>">Checkout</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sticky-header_nav position-relative">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-2 col-sm-6">
                                <div class="header-logo_area">
                                    <a href="<?= Url::home() ?>">
                                        <img src="/images/menu/logo/1.png" alt="Header Logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-7 d-none d-lg-block position-static">
                                <div class="main-menu_area">
                                    <nav class="main-nav d-flex justify-content-center">
                                        <ul>
                                            <li class="dropdown-holder"><a href="<?= Url::home() ?>">Home</a>
                                            <li class="dropdown-holder">
                                                <a href="<?= Url::toRoute(['/shop']) ?>">Shop
                                                    <i class="ion-chevron-down"></i>
                                                </a>
                                                <ul class="kenne-dropdown">
                                                    <?php foreach ($data as $item) { ?>
                                                        <li>
                                                            <a href="<?= Url::toRoute(['/shop/', 'slug' => $item->cat_slug]) ?>"> <?= $item['cat_name'] ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                            <li><a href="<?= Url::toRoute(['/blog']) ?>">Blog</a>
                                                <!--<li><a href="blog-details.html">Blog Details</a></li>-->
                                            </li>
                                            <li><a href="<?= Url::toRoute('/contact-us') ?>">Contact Us</a></li>
                                            <!--<li><a href="<? /*= Url::toRoute(['/about-us']) */ ?>">About Us</a></li>-->
                                            <li><a href="">My Account <i class="ion-chevron-down"></i></a>
                                                <ul class="kenne-dropdown">
                                                    <?php if (!Yii::$app->user->isGuest) { ?>
                                                        <li><a href="<?= Url::toRoute(['/account']) ?>">My Account</a>
                                                        </li>
                                                        <li><a href="<?= Url::toRoute(['/wishlist']) ?>">Wishlist</a>
                                                        </li>
                                                        <li><a href="<?= Url::toRoute(['/cart']) ?>">Cart</a></li>
                                                        <li><a href="<?= Url::toRoute(['/checkout']) ?>">Checkout</a>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li><a href="<?= Url::toRoute(['/site/login']) ?>">Login</a>
                                                        </li>
                                                        <li><a href="<?= Url::toRoute(['/site/signup']) ?>">Register</a>
                                                        </li>
                                                        <li><a href="<?= Url::toRoute(['/cart']) ?>">Cart</a></li>
                                                        <li><a href="<?= Url::toRoute(['/checkout']) ?>">Checkout</a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="header-right_area header-right_area-2">
                                    <ul>
                                        <li class="mobile-menu_wrap d-inline-block d-lg-none">
                                            <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                                <i class="ion-android-menu"></i>
                                            </a>
                                        </li>
                                        <li class="minicart-wrap">
                                            <a href="#miniCart" class="minicart-btn toolbar-btn">
                                                <div class="minicart-count_area">
                                                    <?php if (isset($total)) { ?>
                                                        <span class="item-count"><?= $total ?></span>
                                                    <?php } ?>
                                                    <i class="ion-bag"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#searchBar" class="search-btn toolbar-btn">
                                                <i class="ion-ios-search"></i>
                                            </a>
                                        </li>
                                        <li class="d-none d-lg-inline-block">
                                            <a href="#offcanvasMenu" class="menu-btn toolbar-btn color--white">
                                                <i class="ion-android-menu"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= \frontend\widgets\MinicartWidget::widget() ?>

    <div class="mobile-menu_wrapper" id="mobileMenu">
        <div class="offcanvas-menu-inner">
            <div class="container">
                <a href="#" class="btn-close white-close_btn"><i class="ion-android-close"></i></a>
                <div class="offcanvas-inner_logo">
                    <a href="index.html">
                        <img src="/images/menu/logo/1.png" alt="Header Logo">
                    </a>
                </div>
                <nav class="offcanvas-navigation">
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children active"><a href="#"><span
                                        class="mm-text">Home</span></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="index.html">
                                        <span class="mm-text">Home One</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index-2.html">
                                        <span class="mm-text">Home Two</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index-3.html">
                                        <span class="mm-text">Home Three</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">
                                <span class="mm-text">Shop</span>
                            </a>
                            <ul class="sub-menu">
                                <li class="menu-item-has-children">
                                    <a href="#">
                                        <span class="mm-text">Grid View</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="shop-fullwidth.html">
                                                <span class="mm-text">Grid Fullwidth</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-left-sidebar.html">
                                                <span class="mm-text">Left Sidebar</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-right-sidebar.html">
                                                <span class="mm-text">Right Sidebar</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">
                                        <span class="mm-text">Shop List</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="shop-list-fullwidth.html">
                                                <span class="mm-text">Full Width</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-list-left-sidebar.html">
                                                <span class="mm-text">Left Sidebar</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-list-right-sidebar.html">
                                                <span class="mm-text">Right Sidebar</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">
                                        <span class="mm-text">Single Product Style</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="single-product-gallery-left.html">
                                                <span class="mm-text">Gallery Left</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="single-product-gallery-right.html">
                                                <span class="mm-text">Gallery Right</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="single-product-tab-style-left.html">
                                                <span class="mm-text">Tab Style Left</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="single-product-tab-style-right.html">
                                                <span class="mm-text">Tab Style Right</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="single-product-sticky-left.html">
                                                <span class="mm-text">Sticky Left</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="single-product-sticky-right.html">
                                                <span class="mm-text">Sticky Right</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">
                                        <span class="mm-text">Single Product Type</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="single-product.html">
                                                <span class="mm-text">Single Product</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="single-product-sale.html">
                                                <span class="mm-text">Single Product Sale</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="single-product-group.html">
                                                <span class="mm-text">Single Product Group</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="single-product-variable.html">
                                                <span class="mm-text">Single Product Variable</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="single-product-affiliate.html">
                                                <span class="mm-text">Single Product Affiliate</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="single-product-slider.html">
                                                <span class="mm-text">Single Product Slider</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">
                                <span class="mm-text">Blog</span>
                            </a>
                            <ul class="sub-menu">
                                <li class="menu-item-has-children has-children">
                                    <a href="blog-grid_view.html">
                                        <span class="mm-text">Grid View</span>
                                    </a>
                                </li>
                                <li class="menu-item-has-children has-children">
                                    <a href="blog-list_view.html">
                                        <span class="mm-text">List View</span>
                                    </a>
                                </li>
                                <li class="menu-item-has-children has-children">
                                    <a href="blog-details.html">
                                        <span class="mm-text">Blog Details</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">
                                <span class="mm-text">Pages</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="my-account.html">
                                        <span class="mm-text">About Us</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="my-account.html">
                                        <span class="mm-text">Contact</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="my-account.html">
                                        <span class="mm-text">My Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="login-register.html">
                                        <span class="mm-text">Login | Register</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="wishlist.html">
                                        <span class="mm-text">Wishlist</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="cart.html">
                                        <span class="mm-text">Cart</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="checkout.html">
                                        <span class="mm-text">Checkout</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="compare.html">
                                        <span class="mm-text">Compare</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="faq.html">
                                        <span class="mm-text">FAQ</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="404.html">
                                        <span class="mm-text">Error 404</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <nav class="offcanvas-navigation user-setting_area">
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children active">
                            <a href="#">
                                        <span class="mm-text">User
                                        Setting
                                        </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="my-account.html">
                                        <span class="mm-text">My Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="login-register.html">
                                        <span class="mm-text">Login | Register</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#"><span class="mm-text">Currency</span></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="javascript:void(0)">
                                        <span class="mm-text">EUR €</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span class="mm-text">USD $</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#"><span class="mm-text">Language</span></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="javascript:void(0)">
                                        <span class="mm-text">English</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span class="mm-text">Français</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span class="mm-text">Romanian</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span class="mm-text">Japanese</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="offcanvas-menu_wrapper" id="offcanvasMenu">
        <div class="offcanvas-menu-inner">
            <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
            <div class="offcanvas-inner_logo">
                <a href="shop-left-sidebar.html">
                    <img src="/images/menu/logo/1.png" alt="Munoz's Offcanvas Logo">
                </a>
            </div>
            <div class="short-desc">
                <p>We are a team of designers and developers that create high quality HTML Template &
                    Woocommerce,
                    Shopify Themes.
                </p>
            </div>
            <div class="offcanvas-component first-child">
                <span class="offcanvas-component_title">Currency</span>
                <ul class="offcanvas-component_menu">
                    <li><a href="javascript:void(0)">EUR</a></li>
                    <li><a href="javascript:void(0)">GBP</a></li>
                    <li class="active"><a href="javascript:void(0)">USD</a></li>
                </ul>
            </div>
            <div class="offcanvas-component">
                <span class="offcanvas-component_title">Language</span>
                <ul class="offcanvas-component_menu">
                    <li class="active"><a href="javascript:void(0)">English</a></li>
                    <li><a href="javascript:void(0)">French</a></li>
                </ul>
            </div>
            <div class="offcanvas-component">
                <span class="offcanvas-component_title">My Account</span>
                <ul class="offcanvas-component_menu">
                    <li><a href="my-account.html">Register</a></li>
                    <li><a href="login-register.html">Login</a></li>
                </ul>
            </div>
            <div class="offcanvas-inner-social_link">
                <div class="kenne-social_link">
                    <ul>
                        <li class="facebook">
                            <a href="https://www.facebook.com" data-toggle="tooltip" target="_blank" title="Facebook">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li class="twitter">
                            <a href="https://twitter.com" data-toggle="tooltip" target="_blank" title="Twitter">
                                <i class="fab fa-twitter-square"></i>
                            </a>
                        </li>
                        <li class="youtube">
                            <a href="https://www.youtube.com" data-toggle="tooltip" target="_blank" title="Youtube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li class="google-plus">
                            <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank"
                               title="Google Plus">
                                <i class="fab fa-google-plus"></i>
                            </a>
                        </li>
                        <li class="instagram">
                            <a href="https://rss.com" data-toggle="tooltip" target="_blank" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-search_wrapper" id="searchBar">
        <div class="offcanvas-menu-inner">
            <div class="container">
                <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                <!-- Begin Offcanvas Search Area -->
                <div class="offcanvas-search">
                    <form action="#" class="hm-searchbox">
                        <input type="text" placeholder="Search for item...">
                        <button class="search_btn" type="submit"><i
                                    class="ion-ios-search-strong"></i></button>
                    </form>
                </div>
                <!-- Offcanvas Search Area End Here -->
            </div>
        </div>
    </div>
    <div class="global-overlay"></div>
</header>