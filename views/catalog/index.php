<link rel="stylesheet" href="/static/js/simplePagination.css">
<style>
	span {
		margin: 0 4px;
		font-size: 16px;
		font-weight: bold;
	}
    .active {
        color: red;
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


        <!--Breadcrumb Start-->
        <div class="breadcrumb-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumbs">
                            <ul>
                                <li class="home"><a href="index.html">Главная</a><span>/ </span></li>
                                <li><strong>Каталог</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="banner-image-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="category-image"><img alt="women" src="img/banner/13.jpg"></div>
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
                                            От <input type="text"  id="amount_min" value="0">
                                            До <input type="text"  id="amount_max" value="">
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
                                <a href="#"><img src="img/banner/14.jpg" alt=""></a>
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
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous">
 </script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="/static/js/jquery.simplePagination.js"></script>
<script type="text/javascript">
    //Выбор бренда + проверка на наличие класса "active"
    $('#brand_list').on('click', 'li', function() {
        if (this.className !== "active" && this.id !== state.brand_li) {
            state.brand_li = this.id;
            $("#brand_list").children('li').removeClass('active');
            $(this).toggleClass('active');
            //Вызов AJAX запроса + обнуление текущей страницы (чтоб не сломалось)
            currentPage = 1;
            load_data(currentPage, state)
        }
    }); 
    //Выбор категории + проверка на наличие класса "active"
    $('#category_list').on('click', 'li', function() {
        if (this.className !== "active" && this.id !== state.cat_li) {
            state.cat_li = this.id;
            $("#category_list").children('li').removeClass('active');
            $(this).toggleClass('active');
            //Вызов AJAX запроса + обнуление текущей страницы (чтоб не сломалось)
            currentPage = 1;
            load_data(currentPage, state)
        }
    }); 
    //Получение максимальной цены товара из каталога
	var maxPrice = <?php $maxPrice = array(); $i = 0; foreach ($productList as $key) { $maxPrice[$i] = $key['price']; $i++; } echo json_encode(max($maxPrice)); ?>; 
    //Состояния (минимальная и максимальная цена, выбранная категория и бренд (по умолчанию "Все"))
	var state = {
		min: 0,
		max: maxPrice,
        cat_li: "all_category",
        brand_li: "all_brand"
	};
    //Установка максимальной цены в текстовое поле
	$('#amount_max').val(maxPrice);
    //События по изменению минимальной и максимальной цены и вызова AJAX запроса
	$('#amount_min').on('change', function(){
		state.min = this.value;
		load_data(currentPage, state);
	    $( "#slider-range" ).slider({
	    	values: [this.value, state.max]
	    });
	})
	$('#amount_max').on('change', function(){
		state.max = this.value;
		load_data(currentPage, state);
	    $( "#slider-range" ).slider({
	    	values: [state.min, this.value]
	    });
	})

    //jQuery UI слайдер ценового диапазона
    $(function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: maxPrice,
            values: [ 0, maxPrice ],
            slide: function( event, ui ) {
                $("#amount" ).val( "$"+ui.values[0]+"-$"+ui.values[1]);
                    state.min = ui.values[0];
                    state.max = ui.values[1];
                $('#amount_min').val(ui.values[0]);
                $('#amount_max').val(ui.values[1]);
            }
        });
        //При отпускания мышки от слайрера, вызывается AJAX запрос
        $('#slider-range').on('mouseup', function(){
        	load_data(currentPage, state)
        });
  	})

	// var q = <?= json_encode($user); ?>;
    //По умолчанию вызов AJAX запрос
    load_data(currentPage, state); 
    var total_pages, items, currentPage = 1; 

    //AJAX запрос для вызова каталог продуктов (принимает значения: текущая страница и объект состояний)
    function load_data(page, state) {  
        $.ajax({  
            url:"getAllUsers", 
            method:"POST",  
            data:{page: page, state},  
            success:function(data){ 
            	items = $.parseJSON(data);
            	$('#list_product').empty();
                if (items.hasOwnProperty('item') === true) {
                    for (var i = 0; i < items.item.length; i++) {
                        $('#list_product').append("<div class=\"col-md-4 col-sm-4\">\n <div class=\"product_item\">\n<div class=\"single_product clearfix\">\n<a href=\"../product/" + items.item[i]["id"] + "\">\n<span class=\"product_image\">\n<img src=\"img/product/1.jpg\" alt=\"\" width=\"200px\">\n</span>\n</a>\n\n</div>\n<h2 class=\"product_name\"><a href=\"../product/" + items.item[i]["id"] + "\">" + items.item[i]["name"] + "</a></h2>\n<div class=\"oroduct_price\">\n\t<span class=\"price\">$ " + items.item[i]["price"] + "</span>\n\t\t\t\t\t\t\t</div>\n</div>\n\t\t\t</div>");
                    }                   
                } else {
                    $('#list_product').append('Пусто');////
                }

                //Переменные для создания пагинации (всего страниц, продуктов на странице, текущая страница)
            	total_items = items['total_item'];
            	item_on_page = items['record_per_page'];

                //Установка новой текущей страницы
            	currentPage = items['current_page'];

                //Пагинация
			    $('.paginations').pagination({
			        items: total_items,
			        itemsOnPage: item_on_page,
			        cssStyle: 'dark-theme',
			        hrefTextPrefix: '',
                    currentPage : currentPage,
                    onPageClick : function(pageNumber) {
                        load_data(pageNumber, state);
                    }
			    });
           }
      })//AJAX 
    }
</script>