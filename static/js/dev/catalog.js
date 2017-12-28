    "use strict";
    const categoryList = document.getElementsByName('categoryList');
    const brandList = document.getElementsByName('brandList');
    const seasonList = document.getElementsByName('seasonList');
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
        seasonFilter: [],
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

    //Назначение события для фильтра сезонов товара
    for (let brand of seasonList) {
        brand.addEventListener('change', function(e) {
            let target = e.target;
            if (target.checked) {
                state["seasonFilter"].push(target.value);
                getData(currentPage, state, sortBy, searchValue);
            } else if (!target.checked) {
                let index = state["seasonFilter"].indexOf(target.value);
                state["seasonFilter"].splice(index, 1);
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
            if (!val.match(/[^a-zA-Zа-яА-Я0-9]/g)) {
                searchValue = `%${val}%`;
                getData(currentPage, state, sortBy, searchValue);                
            }

        }
    })

    async function getData(currentPage, state, sortBy, searchValue) {
        try {
            var data = await receivingВata(currentPage, state, sortBy, searchValue);
            var items = $.parseJSON(data);
            $('.catalog-items-list').html("");
            var total_items = items['total_item'];
            var item_on_page = items['record_per_page'];
            function currentCountItems(itemsPerPage, currentPage, recordPerPage, totalItems) {
                if (countItemsPerPage != 0) {
                    let fromPage = recordPerPage * (currentPage - 1) + 1;
                    let toPage = (fromPage - 1) + itemsPerPage;
                    return `Показано с ${fromPage} по ${toPage} из ${totalItems}`                    
                } else {
                    return `0`;
                }
            }
            var countItemsPerPage = 0;
            if (items["item"] != undefined) {
                countItemsPerPage = Object.keys(items["item"]).length;
                for (let val of items["item"]) {
                    let checkPrice = '';
                    if (val["is_sale"] == 1) {
                        checkPrice = `<p class="item-old-price">${val["price"]} руб.</p><p class="item-sale-price">${val["sale_price"]} руб.</p>`;
                    } else {
                        checkPrice = `<p>${val["price"]} руб.</p>`;
                    }
                    $('.catalog-items-list').append(`
                        <div class="catalog-item">
                            <div class="shadow"></div>
                            <img src="https://www.juicycouture.asia/skin/frontend/jc/default/images/homepage/MMe21_IMGs_CollectionFeatured.jpg" alt="Item-${val["id"]}">
                            <div class="image_overlay"></div>
                            <div class="add_to_cart product_opacity">Добавить в корзину</div>
                            <div class="add_to_compare product_opacity">Отложить</div>
                            <div class="product-info">         
                                <div class="info-container">
                                    <div class="info-container-header">
                                        <div class="product-name">
                                            <a href="../product/${val["id"]}">
                                            <p class="product-title">${val["name"]} ${val["article"]}</p>
                                            <p class="product-brand">${val["brand_name"]}</p>
                                            </a> 
                                        </div>
                                        <div class="product-price">${checkPrice}</div>
                                    </div>
                                    <div class="product-hide-info">
                                        <strong>Размер</strong>
                                        <div class="product-size">${val["size"]}</div>
                                        <strong>Состав</strong>
                                        <div class="product-compositions">
                                            ${val["composition"]}
                                        </div>
                                    </div>                       
                                </div>                         
                            </div>
                        </div>
                    `);
                }
            } else {
                $('.catalog-items-list').append('<h1>Список пуст</h1>');
                countItems.innerText = 0;                
            }
            //Установка новой текущей страницы
            var currentPage = items['current_page'];
            countItems.innerText = currentCountItems(countItemsPerPage, currentPage, item_on_page, total_items);
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

