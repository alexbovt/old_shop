<?php
require 'db.php';
//$errors = array();
//$produkt = R::load( 'produkty', 1);
//$zdjecie = $produkt->photo;
?>
<html lang="en">
    <head>
        <?php require 'html/head.html'; ?><!--add-head-->  
    </head>
    <body>
        <header id="header"><!--header-->
            <?php
            if (isset($_SESSION['logged_user'])) {
                require 'html/header-middle-top-reg.html';
            } else {
                require 'html/header-middle-top-noreg.html';
            }
            require 'html/header-bottom.html';
            ?> <!--header-middle-->
            <section>
                <div class="container">
                    <div class="row">
                        <?php require 'html/header-category.html'; ?><!--header-category-->
                        <div class="col-sm-9 padding-right">
                            <div class="features_items"><!--features_items-->
                                <h2 class="title text-center">Aktualnosci</h2>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/product1.jpg" alt="" />
                                                <h2>Asus</h2>
                                                <p>$1000</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Kosz</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/product2.jpg" alt="" />
                                                <h2>Sasmung</h2>
                                                <p>$1500</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Kosz</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/product3.jpg" alt="" />
                                                <h2>Acer</h2>
                                                <p>$900</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Kosz</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--features_items-->
                        </div>
                    </div>
                </div>
            </section><!--header-print-produkt-->
        </header>
        <?php require 'html/add-scripts.html'; ?><!--add-scripts--> 
    </body>
</html>