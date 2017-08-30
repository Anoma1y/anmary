<?php require_once '/views/catalog/header.php'; ?>


        <div class="banner-image-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="category-image"><img alt="women" src="../static/img/13.jpg" width="100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="shop-main-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="sidebar-content">
                            <div class="section-title"><h2>Категории</h2></div>
                            <div class="sidebar-category-list">
                            	<ul id="category_list">
                                    <li id="all_category" class="active">Все</li>
	 								<?php 
	 									foreach ($categoryList as $key) {
	 										echo '<li id='.'category_'.$key['id'].'>'.$key['category_name'].'</li>';
	 									}
									?>                           		
                            	</ul>
                            </div>
                            <div class="section-title border-none"><h2>Цена</h2></div>
                            <div class="sidebar-category-list">
                                <div class="price_filter">
                                    <div id="slider-range"></div>
                                    <div class="price_slider_amount">
                                       <div class="slider-values">
                                            <input type="text"  id="amount_min" value="0">
                                            <input type="text"  id="amount_max" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section-title border-none"><h2>Производитель</h2></div>
                            <div class="sidebar-category-list">
                            	<ul id="brand_list">
                                    <li id="all_brand" class="active">Все</li>
                                    <?php 
                                        foreach ($brandList as $key) {
                                            echo '<li id='.'brand_'.$key['id'].'>'.$key['brand_name'].'</li>';
                                        }
                                    ?>                           		
                            	</ul>
                            </div>
                        </div>
                        <div class="sidebar-content">
                            <div class="banner-box">
                                <a href="#">
                                    <img src="../static/img/14.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="shop-item-filter">
                        <div class="clearfix"></div> 
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="grid">
                                <div class="row">

								<div id="list_product">
									
								</div>
							 </div>
                            </div>
                         </div>   
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pagination-content">
                                    <div class="pagination-button">
										<div class="paginations"></div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
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

<script src="/static/js/libs.min.js"></script>
<script type="text/javascript">
    //Получение максимальной цены товара из каталога
    var maxPrice = <?php $maxPrice = array(); $i = 0; foreach ($productList as $key) { $maxPrice[$i] = $key['price']; $i++; } echo json_encode(max($maxPrice)); ?>; 
</script>
<script src="/static/js/catalog.js"></script>
