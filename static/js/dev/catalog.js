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
        }
        init(initialState) {
            this.getData(this.currentPage, initialState)
        }
        receivingВata(page, state) {
            return new Promise((res, rej) => {
                $.ajax({
                    url: this.url, 
                    method: this.method,  
                    data:{page: page, state: state}, //текущая страница, фильтр и сортировка
                })
                .done(res)
                .fail(rej)           
            })
        }
        async getData(currentPage, state) {
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
                    this.itemsRender(this.items);
                    this.countItemsPerPage = Object.keys(this.items["item"]).length;
                } else {
                    this.countItemsRender(0);
                }
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
                        this.getData(pageNumber, filter.state);
                   }
                });
            } catch (error) {
                this.countItemsRender("Error")
                throw new Error(error);
            }

        }
        itemsRender(items) {
            for (let val of items["item"]) {
                let checkPrice = '';
                let checkPercentSale = '';
                if (val["is_sale"] == 1) {
                    checkPrice = `<p class="item-old-price">${val["price"]} руб.</p><p class="item-sale-price">${val["sale_price"]} руб.</p>`;
                    checkPercentSale = `<div class="item-sale-percent"><p>${val["percentSale"]}%</p></div>`;
                } else {
                    checkPrice = `<p>${val["price"]} руб.</p>`;
                }
                $('.catalog-items-list').append(`
                    <div class="catalog-item">
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
            this.masd = document.getElementById('adsfa');
            this.state = {
                categoryFilter: [],
                brandFilter: [],
                seasonFilter: [],
                isSaleFilter: '',
                minPrice: this.minPrice.value,
                maxPrice: this.maxPrice.value,
                sortBy: 'sortByNewest',
                searchValue: ''                
            }
            this.obj = object;
        }
        init() {
            try {
                if (this.checkUndefined(this.minPrice, this.maxPrice)) { 
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
                    this.state["sortBy"] = e.target.value;
                    this.obj.currentPage = 1;
                    this.obj.getData(this.obj.currentPage, this.state);
                }, false);
            }
        }
        //Обработчик события обновления ценогого диапазона, срабатывает через 500 мс
        filterPrice() {
            this.minPrice.addEventListener('change', (e) => {
                let target = e.target.value;
                if (this.checkPrice(target)) {
                   this.state['minPrice'] = target;
                   setTimeout(() => { this.obj.getData(this.obj.currentPage, this.state); },500); 
                }
            }, false);
            this.maxPrice.addEventListener('change', (e) => {
                let target = e.target.value;
                if (this.checkPrice(target)) {
                   this.state["maxPrice"] = target;
                   setTimeout(() => { this.obj.getData(this.obj.currentPage, this.state); },500); 
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
                        this.state["categoryFilter"].push(target.value);
                        this.obj.getData(this.obj.currentPage, this.state);
                    } else if (!target.checked) {
                        this.obj.currentPage = 1;
                        let index = this.state["categoryFilter"].indexOf(target.value);
                        this.state["categoryFilter"].splice(index, 1);
                        this.obj.getData(this.obj.currentPage, this.state);
                    }
                }, false);
            }
            //Назначение события для фильтра бренда товара
            for (let brand of this.brandList) {
                brand.addEventListener('change', (e) => {
                    let target = e.target;
                    if (target.checked) {
                        this.obj.currentPage = 1;
                        this.state["brandFilter"].push(target.value);
                        this.obj.getData(this.obj.currentPage, this.state);
                    } else if (!target.checked) {
                        this.obj.currentPage = 1;
                        let index = this.state["brandFilter"].indexOf(target.value);
                        this.state["brandFilter"].splice(index, 1);
                        this.obj.getData(this.obj.currentPage, this.state);
                    }
                }, false);
            }
            //Назначение события для фильтра сезонов товара
            for (let brand of this.seasonList) {
                brand.addEventListener('change', (e) => {
                    let target = e.target;
                    if (target.checked) {
                        this.obj.currentPage = 1;
                        this.state["seasonFilter"].push(target.value);
                        this.obj.getData(this.obj.currentPage, this.state);
                    } else if (!target.checked) {
                        this.obj.currentPage = 1;
                        let index = this.state["seasonFilter"].indexOf(target.value);
                        this.state["seasonFilter"].splice(index, 1);
                        this.obj.getData(this.obj.currentPage, this.state);
                    }
                }, false);
            }
        }
        filterSearch() {
            this.searchBtn.addEventListener('click', () => {
                let val = this.searchInput.value;
                if (val.length == 0) {
                    this.state["searchValue"] = "";
                    this.obj.currentPage = 1;
                    this.obj.getData(this.obj.currentPage, this.state);
                } else if (val.length >= 3 && val.length <= 20) {
                    if (!val.match(/[^a-zA-Zа-яА-Я0-9]/g)) {
                        this.state["searchValue"] = `%${val}%`;
                        this.obj.currentPage = 1;
                        this.obj.getData(this.obj.currentPage, this.state);               
                    }
                }
            })
        }
        filterSale() {
            this.filterIsSale.addEventListener('change', (e) => {
                let target = e.target;
                if (target.checked) {
                    this.state["isSaleFilter"] = 1;
                    this.obj.currentPage = 1;
                    this.obj.getData(this.obj.currentPage, this.state);
                } else if (!target.checked) {
                    this.state["isSaleFilter"] = '';
                    this.obj.currentPage = 1;
                    this.obj.getData(this.obj.currentPage, this.state);
                }
            }, false);
        }
    }

    const catalog = new Catalog("getAllProduct", "POST");
    const filter = new Filter(catalog);
    if (catalog != undefined && filter != undefined) {
        filter.init();
        catalog.init(filter.state);         
    }
       


