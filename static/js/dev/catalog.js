    "use strict";

    class Catalog {
        constructor(url, method) {
            this.total_pages;
            this.items;
            this.currentPage = 1;
            this.url = url;
            this.method = method;
            this.total_items = 1;
            this.item_on_page = 1;
            this.countItems = document.getElementById('countItems');
            this.countItemsPerPage = 0;
            //анимиация библиотеки AOS
            this.animationAOS = ["fade-up", "fade-in", "fade-right", "fade-left", "fade-up-right", "fade-up-left", "fade-down-right", "fade-down-left"];
            //текущее состояние для фильтров, сортировки и поиска
            this.state = {
                categoryFilter: [],
                brandFilter: [],
                seasonFilter: [],
                isSaleFilter: '',
                minPrice: 0,
                maxPrice: 0,
                sortBy: 'sortByNewest',
                searchValue: ''                
            };
        }

        randomInteger(min, max) {
            return Math.round(min - 0.5 + Math.random() * (max - min + 1));
        }

        init() {
            this.getData(this.currentPage, this.state);
        }

        receivingВata(page, state) {
            return new Promise((res, rej) => {
                if (this.method == "POST") {
                    $.ajax({
                        url: this.url, 
                        method: this.method,  
                        data:{page: page, state: state}, //текущая страница, фильтр и сортировка
                    })
                    .done(res)
                    .fail(rej)                    
                } else if (this.method == "GET") {
                    $.ajax({
                        url: this.url, 
                        method: this.method
                    })
                    .done(res)
                    .fail(rej)                      
                }
            })
        }

        async getData(currentPage, state) {
            if (this.method == "POST") {
                try {
                    var data = await this.receivingВata(currentPage, state);
                    this.items = $.parseJSON(data);
                    //Всего записей
                    this.total_items = this.items['total_item'];
                    //Записей на странице
                    this.item_on_page = this.items['record_per_page'];
                    //Установка новой текущей страницы
                    this.currentPage = this.items['current_page'];
                    $('.catalog-items-list').html("");
                    if (this.items["item"] != undefined) {
                        this.itemsRender(this.items["item"]);
                        this.countItemsPerPage = Object.keys(this.items["item"]).length;
                        this.countItems.innerText = this.currentCountItems(this.countItemsPerPage, this.currentPage, this.item_on_page, this.total_items);
                        $('.paginations').pagination({
                            items: this.total_items,
                            itemsOnPage: this.item_on_page,
                            cssStyle: 'dark-theme',
                            prevText: '',
                            nextText: '',
                            hrefTextPrefix: '',
                            currentPage: this.currentPage,
                            onPageClick: (pageNumber) => {
                                this.getData(pageNumber, this.state);
                           }
                        });
                    } else if (this.items.length >= 1) {
                        this.itemsRender(this.items);
                    } else {
                        this.countItemsRender(0);
                    }
                } catch (error) {
                    this.countItemsRender("Error")
                    throw new Error(error);
                }                
            } else if (this.method == "GET") {
                var data = await this.receivingВata(currentPage, state);
                console.log($.parseJSON(data));
            }
        }

        itemsRender(items) {
            for (let val of items) {
                let checkPrice = '';
                let checkPercentSale = '';
                if (val["is_sale"] == 1) {
                    checkPrice = `<p class="item-old-price">${val["price"]} руб.</p><p class="item-sale-price">${val["sale_price"]} руб.</p>`;
                    checkPercentSale = `<div class="item-sale-percent"><p>${val["percentSale"]}%</p></div>`;
                } else {
                    checkPrice = `<p>${val["price"]} руб.</p>`;
                }
                $('.catalog-items-list').append(`
                    <div class="catalog-item" data-aos="${this.animationAOS[this.randomInteger(0,7)]}" data-aos-duration="500">
                        <div class="shadow"></div>
                        <img src="${val["image"]}" alt="Item-${val["id"]}">
                        ${checkPercentSale}
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
        }

        countItemsRender(count) {
            if (count == "Error") {
                $('.catalog-items-list').html("");
                $('.catalog-items-list').append('<h1>Список пуст</h1>');
                this.countItems.innerText = 0;                
            } else if (count == 0) {
                $('.catalog-items-list').append('<h1>Список пуст</h1>');
                this.countItems.innerText = 0;      
            }
        }

        currentCountItems(itemsPerPage, currentPage, recordPerPage, totalItems) {
            if (this.countItemsPerPage != 0) {
                let fromPage = recordPerPage * (currentPage - 1) + 1;
                let toPage = (fromPage - 1) + itemsPerPage;
                return `Показано с ${fromPage} по ${toPage} из ${totalItems}`                    
            } else {
                return `0`;
            }
        }        
    }

    class Filter {

        constructor(object){
            this.minPrice = document.getElementById('minPrice');
            this.maxPrice = document.getElementById('maxPrice');
            this.categoryList = document.getElementsByName('categoryList');
            this.brandList = document.getElementsByName('brandList');
            this.seasonList = document.getElementsByName('seasonList');
            this.searchInput = document.getElementById('searchFilter_input');
            this.searchBtn = document.getElementById('searchFilterBtn');
            this.filterIsSale = document.getElementById('filterIsSale');
            this.sortingList = document.getElementsByName('sortBy');
            this.checkPrice = this.checkPrice.bind(this);
            this.obj = object;
        }

        init() {
            try {
                if (this.checkUndefined(this.minPrice, this.maxPrice)) {
                    this.obj.state["minPrice"] = minPrice.value;
                    this.obj.state["maxPrice"] = maxPrice.value; 
                    this.filterPrice(); 
                }
                if (this.checkUndefined(this.categoryList, this.brandList, this.seasonList)) { 
                    this.filterCategory();
                }
                if (this.checkUndefined(this.searchInput, this.searchBtn)) {     
                    this.filterSearch();
                }
                if (this.checkUndefined(this.filterIsSale)) { 
                    this.filterSale();
                }
                if (this.checkUndefined(this.sortingList)) { 
                    this.sorting();
                }
            } catch(e) {
                console.log(e);
            }
        }

        checkUndefined(...variable) {
            for (let vars of variable) {
                if (vars == undefined) {
                    return false;
                } else {
                    return true;
                }
            }
        }

        //Функция проверки цены на наличия в ней текста или пустого значения
        checkPrice(value) {
            let check = (value != '' && value.match(/^\d+$/)) ? true : false;
            return check;            
        }

        //сортировка товаров
        sorting() {
            for (let sort of this.sortingList) {
                sort.addEventListener('change', (e) => {
                    this.obj.state["sortBy"] = e.target.value;
                    this.obj.currentPage = 1;
                    setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500);
                }, false);
            }
        }

        //Обработчик события обновления ценогого диапазона, срабатывает через 500 мс
        filterPrice() {
            this.minPrice.addEventListener('change', (e) => {
                let target = e.target.value;
                if (this.checkPrice(target)) {
                   this.obj.state['minPrice'] = target;
                   setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500); 
                }
            }, false);
            this.maxPrice.addEventListener('change', (e) => {
                let target = e.target.value;
                if (this.checkPrice(target)) {
                   this.obj.state["maxPrice"] = target;
                   setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500); 
                }
            }, false);           
        }

        filterCategory() {
            //Назначение события для фильтра категорий товара
            for (let category of this.categoryList) {
                category.addEventListener('change', (e) => {
                    let target = e.target;
                    if (target.checked) {
                        this.obj.currentPage = 1;
                        this.obj.state["categoryFilter"].push(target.value);
                        setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500);
                    } else if (!target.checked) {
                        this.obj.currentPage = 1;
                        let index = this.obj.state["categoryFilter"].indexOf(target.value);
                        this.obj.state["categoryFilter"].splice(index, 1);
                        setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500);
                    }
                }, false);
            }
            //Назначение события для фильтра бренда товара
            for (let brand of this.brandList) {
                brand.addEventListener('change', (e) => {
                    let target = e.target;
                    if (target.checked) {
                        this.obj.currentPage = 1;
                        this.obj.state["brandFilter"].push(target.value);
                        setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500);
                    } else if (!target.checked) {
                        this.obj.currentPage = 1;
                        let index = this.obj.state["brandFilter"].indexOf(target.value);
                        this.obj.state["brandFilter"].splice(index, 1);
                        setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500);
                    }
                }, false);
            }
            //Назначение события для фильтра сезонов товара
            for (let brand of this.seasonList) {
                brand.addEventListener('change', (e) => {
                    let target = e.target;
                    if (target.checked) {
                        this.obj.currentPage = 1;
                        this.obj.state["seasonFilter"].push(target.value);
                        setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500);
                    } else if (!target.checked) {
                        this.obj.currentPage = 1;
                        let index = this.obj.state["seasonFilter"].indexOf(target.value);
                        this.obj.state["seasonFilter"].splice(index, 1);
                        setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500);
                    }
                }, false);
            }
        }

        filterSearch() {
            this.searchBtn.addEventListener('click', () => {
                let val = this.searchInput.value;
                if (val.length == 0) {
                    this.obj.state["searchValue"] = "";
                    this.obj.currentPage = 1;
                    setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500);
                } else if (val.length >= 3 && val.length <= 20) {
                    if (!val.match(/[^a-zA-Zа-яА-Я0-9]/g)) {
                        this.obj.state["searchValue"] = `%${val}%`;
                        this.obj.currentPage = 1;
                        setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500);               
                    }
                }
            })
        }
        
        filterSale() {
            this.filterIsSale.addEventListener('change', (e) => {
                let target = e.target;
                if (target.checked) {
                    this.obj.state["isSaleFilter"] = 1;
                    this.obj.currentPage = 1;
                    setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500);
                } else if (!target.checked) {
                    this.obj.state["isSaleFilter"] = '';
                    this.obj.currentPage = 1;
                    setTimeout(() => { this.obj.getData(this.obj.currentPage, this.obj.state); },500);
                }
            }, false);
        }
    }