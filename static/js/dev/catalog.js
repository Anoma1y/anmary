    "use strict";
    /**
     * Класс Catalog для вывода товаров в каталоге
     */
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

            //Данные из корзины
            this.productInCart;

            //Данные для добавления товара в корзину (кнопки, data-id, data-size)
            this.catalogBtnCart;
            this.selectedProductSize;
            this.currentProductSize;
            this.idCartItem;

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
        /**
         * [randomInteger метод генерации случайных чисел от и до]
         * @param  {number} min [минимальное значение]
         * @param  {number} max [максимальное значение]
         * @return {number}     [вывод случайного числа от min до max]
         */
        randomInteger(min, max) {
            return Math.round(min - 0.5 + Math.random() * (max - min + 1));
        }

        init() {
            this.getData(this.currentPage, this.state);
        }

        /**
         * [receivingData Метод для выполнения AJAX запроса]
         * @param  {String} page  [Текущая страница]
         * @param  {Object} state [Объект состояний - сортировка, фильтр, цена и тп]
         * @return {Function}       [Если запрос - удачный, передача данных о товарах в асинхронную функцию]
         */
        receivingData(page, state) {
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
        /**
         * [setItems метод для записи данными]
         * @param {bool} если удачно, то true
         */
        setItems(data) {
            if (typeof data == "object") {
                try {
                    this.items = data;
                    //Всего записей
                    this.total_items = this.items['total_item'];
                    //Записей на странице
                    this.item_on_page = this.items['record_per_page'];
                    //Установка новой текущей страницы
                    this.currentPage = this.items['current_page'];
                } catch(e) {
                    console.log(e);
                }
            }
        }
        /**
         * [changeSize метод для добавления текущего выбранного размера]
         */
        changeSize() {
            for (let sizeBtn of this.selectedProductSize) {
                sizeBtn.addEventListener('change', (e) => {
                    let target = e.target;
                    let dataSize = target.getAttribute("data-size");
                    let dataId = target.getAttribute("data-id");
                    this.currentProductSize = target.checked === true ? dataSize : null;
                    this.idCartItem = target.checked === true ? dataId : null;                  
                    for (let btn of this.catalogBtnCart) {
                        let idBtn = btn.getAttribute("data-id");
                        if (sizeBtn.classList.contains('catalog-item-in-cart')) {
                            if (idBtn == dataId) {
                                $(sizeBtn).addClass('in-cart');
                                btn.setAttribute('data-size', dataSize);
                                btn.innerText = "Удалить из корзины";
                            }
                        } else {
                            if (idBtn == dataId) {
                                $(sizeBtn).removeClass('in-cart');
                                btn.setAttribute('data-size', "")
                                btn.innerText = "Добавить в корзину";
                            }
                        }
                    }
                });
            }
        }
        /**
         * [addBtnEvent метод для добавления обработчика событий для "Добавления товара"]
         */
        addBtnEvent() {
            this.catalogBtnCart = document.querySelectorAll('.catalog-add-to-cart');
            for (let btnCart of this.catalogBtnCart) {
                btnCart.addEventListener('click', (e) => {
                    let id = e.target.dataset.id;
                    if (this.currentProductSize != null && id == this.idCartItem) { 
                        if (btnCart.getAttribute('data-size').length != 0) {
                            $.ajax({
                                url: '../cart/deleteProductInCart',
                                type: 'POST',
                                data: {id: this.idCartItem,
                                       size: this.currentProductSize
                                },
                            })
                            .done(function() {
                                window.location.reload();
                            })
                            .fail(function() {
                                errorSet(errorText, "Ошибка при удалении из корзины");
                            })  
                        } else {
                            $.ajax({
                                url: '../cart/addProduct',
                                type: 'POST',
                                data: {id: this.idCartItem, 
                                       size: this.currentProductSize
                                },
                            })
                            .done(function() {
                                window.location.reload();
                            })
                            .fail(function() {
                                console.log('Error');
                            })                             
                        }
                    }
                })
            }            
        }
        async getData(currentPage, state) {
            if (this.method == "POST") {
                try {
                    var data = await this.receivingData(currentPage, state);
                    this.setItems($.parseJSON(data));
                    $('.catalog-items-list').html("");
                    if (this.items["item"] != undefined) {
                        if (this.items["productInCart"]) {
                            this.productInCart = this.items["productInCart"];
                        }

                        this.itemsRender(this.items["item"]);
                        this.selectedProductSize = document.querySelectorAll('input[name="size-item"]');
                        
                        //Вызов методов для добавления обработчиков событий
                        this.changeSize();
                        this.addBtnEvent();

                        this.countItemsPerPage = Object.keys(this.items["item"]).length;
                        this.countItems.innerText = this.currentCountItems(this.countItemsPerPage, this.currentPage, this.item_on_page, this.total_items);

                        //Пагинация
                        $('.paginations').pagination({
                            items: this.total_items,
                            itemsOnPage: this.item_on_page,
                            cssStyle: 'dark-theme',
                            prevText: '',
                            nextText: '',
                            hrefTextPrefix: '',
                            currentPage: this.currentPage,
                            onPageClick: (pageNumber) => {
                                setTimeout(() => { this.getData(pageNumber, this.state); },500);
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
            } else if (this.method == "GET") { //Don't Work
                var data = await this.receivingData(currentPage, state);
                console.log($.parseJSON(data));
            }
        }

        /**
         * [itemsRender Метод для рендеринга товаров на странице]
         * @param  {Object} items [Объект данных о товарах]
         * @return {Nodes}       [Рендер узлов]
         */
        itemsRender(items) {
            for (let val of items) {
                let checkPrice = '';
                let checkPercentSale = '';
                var checkCart;
                //Если корзина не пустая, то для текущего ID отсортировать размеры по возрастанию
                if (this.productInCart) {
                    if (this.productInCart[val["id"]]) {
                        this.productInCart[val["id"]]["size"].sort()
                    }                    
                }
                //Массив размеров, необходим для добавления товаров в корзину
                var itemSize = val["size"].split(', ');
                //Если товар содержит скидку, то добавить классы скидок
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
                        <div class="add_to_cart product_opacity catalog-add-to-cart" data-id="${val["id"]}" data-size="">Добавить в корзину</div>
                        <div class="add_to_compare product_opacity" data-id="${val["id"]}" data-size="">Отложить</div>
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
                                    <div class="product-size">${itemSize.map((n) => {
                                            var classInput = "";
                                            if (this.productInCart) {
                                                if (this.productInCart[val["id"]]) {
                                                    for (let size of this.productInCart[val["id"]]["size"]) {
                                                        if (size == n) {
                                                            classInput = "catalog-item-in-cart";
                                                        }
                                                    }
                                                }
                                            }
                                            return `<input type="radio" class="${classInput}" name="size-item" id='size-item_${val["id"]}_${n}' data-id="${val["id"]}" data-size="${n}">
                                                    <label for='size-item_${val["id"]}_${n}' data-id="${val["id"]}" data-size="${n}" class="size-item">${n}</label>`;
                                        })}
                                    </div>
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

        /**
         * [countItemsRender Вывод информации о том, что товаров нет]
         * @param  {String} count [Количество товаров или ошибка]
         */
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

        /**
         * [currentCountItems Метод, показывающий сколько товаров показано на странице]
         * @param  {Number} itemsPerPage  [Количество товаров на странице]
         * @param  {Number} currentPage   [Текущая страница]
         * @param  {Number} recordPerPage [Записей на странице (по умолчанию)]
         * @param  {Number} totalItems    [Всего товаров в БД]
         * @return {String}               [Вывод информации в узел]
         */
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

        /**
         * [checkUndefined Метод проверки на наличие в переменной данных
         */
        checkUndefined(...variable) {
            for (let vars of variable) {
                if (vars == undefined) {
                    return false;
                } else {
                    return true;
                }
            }
        }

        /**
         * [checkPrice Метод проверки цены на наличия в ней текста или пустого значения]
         * @param  {String} value [Цена]
         * @return {Boolean}       [Выводит true || false]
         */
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