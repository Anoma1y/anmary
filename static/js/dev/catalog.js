    "use strict";
    const categoryList = document.getElementsByName('categoryList');
    const brandList = document.getElementsByName('brandList');
    const minPrice = document.getElementById('minPrice');
    const maxPrice = document.getElementById('maxPrice');
    const searchInput = document.getElementById('searchFilter_input');
    const searchBtn = document.getElementById('searchFilterBtn');
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
    var searchValue = "";
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
        if (checkPrice(target)) {
           setTimeout(function(){ getData(currentPage, state, sortBy, searchValue);; },500); 
        }
    }, false);
    maxPrice.addEventListener('change', function(e) {
        let target = e.target.value;
        state["maxPrice"] = target;
        if (checkPrice(target)) {
           setTimeout(function(){ getData(currentPage, state, sortBy, searchValue);; },500); 
        }
    }, false);

    //Назначение события для фильтра категорий товара
    for (let category of categoryList) {
        category.addEventListener('change', function(e) {
            let target = e.target;
            if (target.checked) {
                state["categoryFilter"].push(target.value);
                getData(currentPage, state, sortBy, searchValue);
            } else if (!target.checked) {
                let index = state["categoryFilter"].indexOf(target.value);
                state["categoryFilter"].splice(index, 1);
                getData(currentPage, state, sortBy, searchValue);
            }
        }, false);
    }
    //Назначение события для фильтра бренда товара
    for (let brand of brandList) {
        brand.addEventListener('change', function(e) {
            let target = e.target;
            if (target.checked) {
                state["brandFilter"].push(target.value);
                getData(currentPage, state, sortBy, searchValue);
            } else if (!target.checked) {
                let index = state["brandFilter"].indexOf(target.value);
                state["brandFilter"].splice(index, 1);
                getData(currentPage, state, sortBy, searchValue);
            }
        }, false);
    }

    //сортировка товаров
    $('select[name="sortBy"]').on('change', function(){
        let sort = $('select[name="sortBy"] option:selected').val();
        sortBy = sort;
        getData(currentPage, state, sortBy, searchValue);
    })
    
    function receivingВata(page, state, sortBy, searchValue = "") {
        return new Promise((res, rej) => {
            $.ajax({
                url:"getAllProduct", 
                method: "POST",  
                data:{page: page, state: state, sort: sortBy, searchValue: searchValue}, //текущая страница, фильтр и сортировка
            })
            .done(res)
            .fail(rej)           
        })
    }
    window.onload = getData(currentPage, state, sortBy, searchValue);

    searchBtn.addEventListener('click', function () {
        let val = searchInput.value;
        if (val.length == 0) {
            searchValue = "";
            getData(currentPage, state, sortBy, searchValue);
        } else if (val.length >= 3 && val.length <= 20) {
            searchValue = `%${val}%`;
            getData(currentPage, state, sortBy, searchValue);
        }
    })

    async function getData(currentPage, state, sortBy, searchValue) {
        try {
            var data = await receivingВata(currentPage, state, sortBy, searchValue);
            var items = $.parseJSON(data);
            $('.catalog-items-list').html("");
            var total_items = items['total_item'];
            var item_on_page = items['record_per_page'];
            if (items["item"] != undefined) {
                for (let val of items["item"]) {
                    let checkPrice = '';
                    if (val["is_sale"] == 1) {
                        checkPrice = `<span class="item-old-price">${val["price"]} руб.</span><span class="item-sale-price">${val["sale_price"]} руб.</span>`;
                    } else {
                        checkPrice = `<span>${val["price"]} руб.</span>`;
                    }
                    $('.catalog-items-list').append(`<div class="catalog-item"><div class="item-image"><a href='../product/${val["id"]}'><img src="${val["image"]}" alt="Item-${val["id"]}"></a><div class="item-compare"><i class="fa fa-heart-o" aria-hidden="true"></i></div></div><div class="item-info"><div class="item-info-price">${checkPrice}</div><div class="item-info-shop-now" id="shop-now-${val["id"]}">Добавить в корзину</div><div class="item-info-title"><h3>${val["name"]} ${val["article"]}</h3></div><div class="item-info-brand"><span>${val["brand_name"]}</span></div><div class="item-info-size"><span>${val["size"]}</span></div></div></div>`);
                }
            } else {
                $('.catalog-items-list').append('<h1>Список пуст</h1>');
                countItems.innerText = 0;                
            }
            //Установка новой текущей страницы
            var currentPage = items['current_page'];
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
                    getData(pageNumber, state, sortBy, searchValue);
               }
            });                
        } catch (error) {
            $('.catalog-items-list').html("");
            $('.catalog-items-list').append('<h1>Список пуст</h1>');
            countItems.innerText = 0;
            throw new Error(error);
        }
    }

