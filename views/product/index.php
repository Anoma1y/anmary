<?php //require_once '/views/index/header.php'; ?>
<!-- <link rel="stylesheet" href="/static/css/catalog.min.css"> -->


<?php require_once 'views/catalog/header.php'; ?>
<!-- <link rel="stylesheet" href="/static/css/product.min.css">
 -->
<span id="addCart">Добавить</span>
<div class="container">
    <div class="product-area">
        <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="current-item">
                <div class="row">
                    <div class="col-md-6">
                         <div class="product-image">
                            <img src="<?=$data['image']; ?>" alt="">
                        </div>                       
                    </div>
                    <div class="col-md-6">
                        <div class="product-content">
                            <div class="product-name">
                                <h2 class="product-title"><?=$data['name'].", ". $data['brand_name'] ?></h2>
                                <h2 class="product-article"><?=$data['article'] ?></h2>
                            </div>
                            <div class="availability">
                                <?php if ($data['is_availability'] == 1): ?>
                                    Наличие: <span class="is_availability_yes">Есть в наличии</span>
                                <?php else: ?>
                                    Наличие: <span class="is_availability_no">Нет в наличии</span>
                                <?php endif ?>
                            </div>
                            <div class="product-price">
                                <?php if ($data['is_sale'] == 1): ?>
                                    <p class="old-price"><?=$data['price'] ?></p>
                                    <p class="price sale"><?=$data['sale_price'] ?></p>
                                <?php else: ?>
                                    <p class="price"><?=$data['price'] ?></p>
                                <?php endif ?>

                            </div>
                            <div class="product-info">
                                <div class="product-color">
                                    <h3>Цвет</h3> <?=$data['color_name'] ?>
                                </div>
                                <div class="product-size">
                                    <h3>Размер</h3>
                                    <?php foreach ($getSize as $key): ?>
                                        <div class="product-size-item"><?=$key; ?></div>
                                    <?php endforeach ?>
                                </div>
                                
                                <div class="product-composition">
                                    <h3>Состав</h3>
                                    <?php foreach ($getComposition as $key): ?>
                                        <p class="product-composition-item"><?=$key; ?></p>    
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>              
                    </div>
                </div>
                
            </div>
        </div>
    </div>
 