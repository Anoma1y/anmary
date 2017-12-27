
<?php require_once "views/index/header.php"; ?>

<?php $price = array(); $i = 0; foreach ($productList as $key) { $price[$i] = $key['price']; $i++; } $minPrice = min($price); $maxPrice = max($price); ?>;
<div class="catalog">
    <div class="container">
        <div class="catalog_filter">
            <div class="filter_search">
                <h3>Поиск:</h3>
                <input type="text" name="searchFilter_input" id="searchFilter_input" placeholder="Поиск...">
                <button id="searchFilterBtn"><i class="fa fa-search"></i></button>
            </div>
            <div class="filter_by">
                <h3>Параметры поиска:</h3>
                <div class="filter-category catalog-filter-block">
                    <input type="checkbox" class="filter-checkbox" id="tab-catalog-filter-category">
                    <label for="tab-catalog-filter-category" class="filter-label">Категории</label>
                    <div class="catalog-filter-panel">
                        <div class="catalog-filter-category-inpanel">
                            <?php foreach ($categoryList as $key => $value): ?>
                                <div class="filter-category-item">
                                    <div class="filter-category-item-input">
                                         <input type="checkbox" class="categoryList" name="categoryList" id="categoryList_<?=$value["id"];?>" value="<?=$value["id"];?>">
                                        <label for="categoryList_<?=$value["id"];?>"></label>                                       
                                    </div>
                                    <div class="filter-category-item-value">
                                         <span><?=$value["category_name"];?></span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="filter-brand catalog-filter-block">
                    <input type="checkbox" class="filter-checkbox" id="tab-catalog-filter-brand">
                    <label for="tab-catalog-filter-brand" class="filter-label">Бренды</label>
                    <div class="catalog-filter-panel">
                        <div class="catalog-filter-category-inpanel">
                            <?php foreach ($brandList as $key => $value): ?>
                                <div class="filter-category-item">
                                    <div class="filter-category-item-input">
                                         <input type="checkbox" class="brandList" name="brandList" id="brandList_<?=$value["id"];?>" value="<?=$value["id"];?>">
                                        <label for="brandList_<?=$value["id"];?>"></label>                                       
                                    </div>
                                    <div class="filter-category-item-value">
                                         <span><?=$value["brand_name"];?></span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="filter-price catalog-filter-block">
                    <input type="checkbox" class="filter-checkbox" id="tab-catalog-filter-price">
                    <label for="tab-catalog-filter-price" class="filter-label">Цена</label>                  
                    <div class="catalog-filter-panel">
                        <div class="catalog-filter-price-inpanel">
                            <div class="filter-minmax-price">
                               <input type="text" value="<?=$minPrice?>" name="minPrice" id="minPrice"> 
                            </div>
                            <div class="filter-minmax-line">
                            </div>
                            <div class="filter-minmax-price">
                                <input type="text" value="<?=$maxPrice?>" name="maxPrice" id="maxPrice"> 
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog-container">
            <div class="catalog-header">
                <div class="catalog-count_item">
                    Найдено товаров: <span>120</span>
                </div>
                <div class="catalog-sort">
                    <div class="catalog-sort-by">
                        <span>Сортировка: </span>
                        <select name="sortBy" id="sortBy">
                            <option value="sortByNewest">По новинкам</option>
                            <option value="sortBySales">По скидкам</option>
                            <option value="sortByPriceLower">По убыванию цены</option>
                            <option value="sortByPriceHigher">По возрастанию цены</option>
                        </select>
                    </div>
                    <div class="catalog-pagination">
                        <div class="paginations"></div>
                    </div>                    
                </div>
            </div>
            <div class="catalog-main">
                <div class="catalog-items-list">

                </div>
            </div>
        </div>
    </div>
</div>



<script src="/static/js/libs.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script type="text/javascript">
    const categoryList = document.getElementsByName('categoryList');
    const brandList = document.getElementsByName('brandList');
    const minPrice = document.getElementById('minPrice');
    const maxPrice = document.getElementById('maxPrice');


    var total_pages, 
        items, 
        currentPage = 1;
    // var page = 1;
    var state = {
        categoryFilter: [],
        brandFilter: [],
        minPrice: minPrice.value,
        maxPrice: maxPrice.value
    }
    function checkPrice(value) {
        if (value != "" && value.match(/^\d+$/)) {
            return true; 
        }
        return false;
    }
    minPrice.addEventListener('change', function(e) {
        let target = e.target.value;
        state["minPrice"] = target;
        console.log(checkPrice(target));
        if (checkPrice(target)) {
           setTimeout(function(){ load_data(currentPage, state); },500); 
        }
    }, false);
    maxPrice.addEventListener('change', function(e) {
        let target = e.target.value;
        state["maxPrice"] = target;
        if (checkPrice(target)) {
           setTimeout(function(){ load_data(currentPage, state); },500); 
        }
    }, false);
    //Назначение события для фильтра категорий товара
    for (let category of categoryList) {
        category.addEventListener('change', function(e) {
            if (e.target.checked) {
                state["categoryFilter"].push(e.target.value);
                load_data(currentPage, state);
            } else if (!e.target.checked) {
                let index = state["categoryFilter"].indexOf(e.target.value);
                state["categoryFilter"].splice(index, 1);
                load_data(currentPage, state);
            }
        }, false);
    }
    //Назначение события для фильтра бренда товара
    for (let brand of brandList) {
        brand.addEventListener('change', function(e) {
            if (e.target.checked) {
                state["brandFilter"].push(e.target.value);
                load_data(currentPage, state);
            } else if (!e.target.checked) {
                let index = state["brandFilter"].indexOf(e.target.value);
                state["brandFilter"].splice(index, 1);
                load_data(currentPage, state);
            }
        }, false);
    }

    load_data(currentPage, state);
    //AJAX запрос для вызова каталог продуктов (принимает значения: текущая страница и объект состояний)
    function load_data(page, state) {  
        $.ajax({  
            url:"getAllProduct", 
            method:"POST",  
            data:{page: page, state: state},  
            success:function(data){ 
                items = $.parseJSON(data);
                $('.catalog-items-list').html("");
                let total_items = items['total_item'];
                let item_on_page = items['record_per_page'];
                for (let val of items["item"]) {
                    $('.catalog-items-list').append(`<div class="catalog-item"><div class="item-image"><a href='../product/${val["id"]}'><img src="${val["image"]}" alt="Item-${val["id"]}"></a><div class="item-compare"><i class="fa fa-heart-o" aria-hidden="true"></i></div></div><div class="item-info"><div class="item-info-price"><span>${val["price"]} руб.</span></div><div class="item-info-shop-now" id="shop-now-${val["id"]}">Добавить в корзину</div><div class="item-info-title"><h3>${val["name"]} ${val["article"]}</h3></div><div class="item-info-brand"><span>${val["brand_name"]}</span></div><div class="item-info-size"><span>${val["size"]}</span></div></div></div>`);
                }
                //Установка новой текущей страницы
                let currentPage = items['current_page'];
                //Пагинация
                $('.paginations').pagination({
                    items: total_items,
                    itemsOnPage: item_on_page,
                    cssStyle: 'dark-theme',
                    prevText: '',
                    nextText: '',
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
<!-- <script src="/static/js/catalog.js"></script> -->
<?php require_once "views/index/footer.php"; ?>