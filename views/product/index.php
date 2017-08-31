<?php //require_once '/views/index/header.php'; ?>
<!-- <link rel="stylesheet" href="/static/css/catalog.min.css"> -->


<?php require_once '/views/catalog/header.php'; ?>
<!-- <link rel="stylesheet" href="/static/css/product.min.css">
 -->

<div class="container">
    <div class="product-area">
        <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="current-item">
                <div class="row">
                    <div class="col-md-6">
                         <div class="product-image">
                            <img src="/static/img/8.jpg" alt="">
                        </div>                       
                    </div>
                    <div class="col-md-6">
                        <div class="product-content">
                            <div class="product-name">
                                <h2 class="product-title">Платье, Vaide</h2>
                                <h2 class="product-article">ART 1457</h2>
                            </div>
                            <div class="availability">
                                Наличие: <span class="is_availability_yes">Есть в наличии</span>
                            </div>
                            <div class="product-price">
                                <div class="old-price">
                                    <p>1 299 руб.</p>
                                </div>
                                <div class="price">
                                    <p>1 119 руб.</p>
                                </div>
                            </div>
                            <div class="product-info">
                                <p class="article">454577</p>
                                <p class="color">черный</p>
                                <p class="composition">полиэстер 52%,нейлон 23%,акрил 17%,шерсть 8%</p>
                            </div>
                        </div>              
                    </div>
                </div>
                
            </div>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="product-title">
                <h2>Последние товары</h2>
            </div>
            <div class="category-products">
                <?php foreach ($lastProducts as $key): ?>
                    <div class="last-items">
                        <div class="last-items-image">
                            <a href="#">
                                <img alt="" src="/static/img/7777.jpg">
                            </a>
                        </div>
                        <div class="last-items-text">
                            <div class="last-items-name">
                                <a href="#"><?=$key['name']." ".$key['article']?></a>
                            </div>
                            <div class="last-items-price">
                                <?php if ($key['is_sale'] == 1): ?>
                                    <p class="old-price"><?=$key['price']; ?></p>
                                    <p class="price">&nbsp;<?=$key['sale_price']; ?></p>
                                <?php else: ?>
                                    <p class="price">&nbsp;<?=$key['price']; ?></p>
                                <?php endif ?>
                            </div>                                            
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="related-products-name">
                <h2>Похожие товары</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="related-products">

            <?php foreach ($relatedProducts as $key): ?>
                <div class="col-md-2">
                    <div class="related-product">
                        <div class="related-image">
                            <a href="#">
                                <img src="/static/img/7777.jpg" alt="">
                            </a>
                        </div>
                        <p class="related-name"><?=$key['name']; ?> <?=$key['article']; ?></p>
                        <div class="related-price">
                            <?php if ($key['is_sale'] == 1): ?>
                                <p class="old-price"><?=$key['price']; ?></p>
                                <p class="price">&nbsp;<?=$key['sale_price']; ?></p>
                            <?php else: ?>
                                <p class="price">&nbsp;<?=$key['price']; ?></p>
                            <?php endif ?>
                        </div>                   
                    </div>
                </div>
            <?php endforeach ?>

            </div>    
        </div>
    </div>
	
</div>
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="footer_menu">
                    <p>Информация</p>
                    <ul>
                        <li><a href="#main">Главная</a></li>
                        <li><a href="#">Контакты</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="footer_menu">
                    <p>Каталог</p>
                    <ul>
                        <li><a href="#">Перейти к каталогу</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-md-offset-5 col-sm-6 col-xs-4">
                <div class="credit_card">
                    <p>Принимаем к оплате:</p>
                    <div class="card_item">
                        <img src="../static/img/maestro.png" alt="">
                    </div>
                    <div class="card_item">
                        <img src="../static/img/maestro.png" alt="">
                    </div>
                    <div class="card_item">
                        <img src="../static/img/maestro.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="copyright">
                    <div class="logo">
                        <img src="../static/img/logo.png" alt="">
                    </div>
                    <span>
                        Авторские права © 2017 "Магазин"
                    </span>
                </div>  
            </div>
            <div class="col-md-6">
                <div class="contact">
                    <div class="telephone">
                        <p>7-(963)-040-25-19</p>
                    </div>
                    <div class="adress">
                        <p>г. Санкт Петербург, Скобелевский пр.,</p>
                        <p>ТЦ Президентский, 2 этаж</p>
                        <p>nt-nt@mail.ru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>