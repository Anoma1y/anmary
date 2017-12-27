    "use strict";
    const categoryList = document.getElementsByName('categoryList');
    const brandList = document.getElementsByName('brandList');
    const minPrice = document.getElementById('minPrice');
    const maxPrice = document.getElementById('maxPrice');
    var countItems = document.getElementById('countItems');

    var total_pages, 
        items, 
        currentPage = 1;
    var state = {
        categoryFilter: [],
        brandFilter: [],
        minPrice: minPrice.value,
        maxPrice: maxPrice.value
    }
    var sortBy = "sortByNewest";
    window.onload = load_data(currentPage, state, sortBy);
    //Функция проверки цены на наличия в ней текста или пустого значения
    function checkPrice(value) {
        if (value != "" && value.match(/^\d+$/)) {
            return true; 
        }
        return false;
    }
    //обработчик события обновления ценогого диапазона, срабатывает через 500 мс
    minPrice.addEventListener('change', function(e) {
        let target = e.target.value;
        state["minPrice"] = target;
        console.log(checkPrice(target));
        if (checkPrice(target)) {
           setTimeout(function(){ load_data(currentPage, state, sortBy); },500); 
        }
    }, false);
    maxPrice.addEventListener('change', function(e) {
        let target = e.target.value;
        state["maxPrice"] = target;
        if (checkPrice(target)) {
           setTimeout(function(){ load_data(currentPage, state, sortBy); },500); 
        }
    }, false);
    //Назначение события для фильтра категорий товара
    for (let category of categoryList) {
        category.addEventListener('change', function(e) {
            if (e.target.checked) {
                state["categoryFilter"].push(e.target.value);
                load_data(currentPage, state, sortBy);
            } else if (!e.target.checked) {
                let index = state["categoryFilter"].indexOf(e.target.value);
                state["categoryFilter"].splice(index, 1);
                load_data(currentPage, state, sortBy);
            }
        }, false);
    }
    //Назначение события для фильтра бренда товара
    for (let brand of brandList) {
        brand.addEventListener('change', function(e) {
            if (e.target.checked) {
                state["brandFilter"].push(e.target.value);
                load_data(currentPage, state, sortBy);
            } else if (!e.target.checked) {
                let index = state["brandFilter"].indexOf(e.target.value);
                state["brandFilter"].splice(index, 1);
                load_data(currentPage, state, sortBy);
            }
        }, false);
    }

    //сортировка товаров
    $('select[name="sortBy"]').on('change', function(){
        let sort = $('select[name="sortBy"] option:selected').val();
        sortBy = sort;
        load_data(currentPage, state, sortBy);
    })
    
    
    //AJAX запрос для вызова каталог продуктов (принимает значения: текущая страница и объект состояний)
    function load_data(page, state, sortBy) {  
        $.ajax({  
            url:"getAllProduct", 
            method:"POST",  
            data:{page: page, state: state, sort: sortBy},//текущая страница, фильтр и сортировка  
            success:function(data){ 
                items = $.parseJSON(data);
                $('.catalog-items-list').html("");
                let total_items = items['total_item'];
                let item_on_page = items['record_per_page'];
                for (let val of items["item"]) {
                    let checkPrice = '';
                    if (val["is_sale"] == 1) {
                        checkPrice = `<span class="item-old-price">${val["price"]} руб.</span><span class="item-sale-price">${val["sale_price"]} руб.</span>`;
                    } else {
                        checkPrice = `<span>${val["price"]} руб.</span>`;
                    }
                    $('.catalog-items-list').append(`<div class="catalog-item"><div class="item-image"><a href='../product/${val["id"]}'><img src="${val["image"]}" alt="Item-${val["id"]}"></a><div class="item-compare"><i class="fa fa-heart-o" aria-hidden="true"></i></div></div><div class="item-info"><div class="item-info-price">${checkPrice}</div><div class="item-info-shop-now" id="shop-now-${val["id"]}">Добавить в корзину</div><div class="item-info-title"><h3>${val["name"]} ${val["article"]}</h3></div><div class="item-info-brand"><span>${val["brand_name"]}</span></div><div class="item-info-size"><span>${val["size"]}</span></div></div></div>`);
                }
                //Установка новой текущей страницы
                let currentPage = items['current_page'];
                countItems.innerText = total_items;
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
                        load_data(pageNumber, state, sortBy);
                   }
                });                
            }                   
    
      })//AJAX 
    }