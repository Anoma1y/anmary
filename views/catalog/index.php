
<?php require_once "views/index/header.php"; ?>




<?php foreach ($categoryList as $key => $value): ?>
    <label for="categoryList"><?=$value["category_name"];?></label><input type="checkbox" class="categoryList" name="categoryList" value="<?=$value["id"];?>">
<?php endforeach ?>
<br>
<?php foreach ($brandList as $key => $value): ?>
    <label for="brandList"><?=$value["brand_name"];?></label><input type="checkbox" class="brandList" name="brandList" value="<?=$value["id"];?>">
<?php endforeach ?>
<div class="pagination-content">
    <div class="pagination-button">
        <div class="paginations"></div>
    </div>
</div>
<?php //echo "<pre>"; var_dump($filter); echo "</pre>";?>
<script src="/static/js/libs.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script type="text/javascript">
    //Получение максимальной цены товара из каталога
    var maxPrice = <?php $maxPrice = array(); $i = 0; foreach ($productList as $key) { $maxPrice[$i] = $key['price']; $i++; } echo json_encode(max($maxPrice)); ?>; 

    const categoryList = document.getElementsByName('categoryList');
    const brandList = document.getElementsByName('brandList');
    var total_pages, 
        items, 
        currentPage = 1;
    // var page = 1;
    var state = {
        categoryFilter: [],
        brandFilter: [],
        minPrice: 0,
        maxPrice: maxPrice
    }
    //Назначение события для фильтра категорий товара
    for (let category of categoryList) {
        category.addEventListener('change', function(e) {
            if (e.target.checked) {
                state["categoryFilter"].push(e.target.value);
            } else if (!e.target.checked) {
                let index = state["categoryFilter"].indexOf(e.target.value);
                state["categoryFilter"].splice(index, 1);
            }
        }, false);
    }
    //Назначение события для фильтра бренда товара
    for (let brand of brandList) {
        brand.addEventListener('change', function(e) {
            if (e.target.checked) {
                state["brandFilter"].push(e.target.value);
            } else if (!e.target.checked) {
                let index = state["brandFilter"].indexOf(e.target.value);
                state["brandFilter"].splice(index, 1);
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
                console.log(items);
                let total_items = items['total_item'];
                let item_on_page = items['record_per_page'];

                //Установка новой текущей страницы
                let currentPage = items['current_page'];
                //Пагинация
                $('.paginations').pagination({
                    items: total_items,
                    itemsOnPage: item_on_page,
                    cssStyle: 'dark-theme',
                    hrefTextPrefix: '',
                    currentPage : currentPage,
                    onPageClick : function(pageNumber) {

                        load_data(pageNumber, state);
                            //Изменение пагинации
                        
                    }
                });                
            }                   
            //Переменные для создания пагинации (всего страниц, продуктов на странице, текущая страница)

           
      })//AJAX 
    }





</script>
<!-- <script src="/static/js/catalog.js"></script> -->
