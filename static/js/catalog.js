"use strict";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Catalog = function () {
    function Catalog(url, method) {
        _classCallCheck(this, Catalog);

        this.total_pages;
        this.items;
        this.currentPage = 1;
        this.url = url;
        this.method = method;
        this.total_items = 1;
        this.item_on_page = 1;
        this.countItems = document.getElementById('countItems');
        this.countItemsPerPage = 0;
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

    _createClass(Catalog, [{
        key: 'init',
        value: function init() {
            this.getData(this.currentPage, this.state);
        }
    }, {
        key: 'receiving\u0412ata',
        value: function receivingAta(page, state) {
            var _this = this;

            return new Promise(function (res, rej) {
                if (_this.method == "POST") {
                    $.ajax({
                        url: _this.url,
                        method: _this.method,
                        data: { page: page, state: state } //текущая страница, фильтр и сортировка
                    }).done(res).fail(rej);
                } else if (_this.method == "GET") {
                    $.ajax({
                        url: _this.url,
                        method: _this.method
                    }).done(res).fail(rej);
                }
            });
        }
    }, {
        key: 'getData',
        value: async function getData(currentPage, state) {
            var _this2 = this;

            if (this.method == "POST") {
                try {
                    var data = await this.receivingВata(currentPage, state);
                    this.items = $.parseJSON(data);
                    //Всего записей
                    this.total_items = this.items['total_item'];
                    //Записей на странице
                    this.item_on_page = this.items['record_per_page'];
                    //Установка новой текущей страницы
                    console.log(this.items);
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
                            onPageClick: function onPageClick(pageNumber) {
                                _this2.getData(pageNumber, _this2.state);
                            }
                        });
                    } else if (this.items.length >= 1) {
                        this.itemsRender(this.items);
                    } else {
                        this.countItemsRender(0);
                    }
                } catch (error) {
                    this.countItemsRender("Error");
                    throw new Error(error);
                }
            } else if (this.method == "GET") {
                var data = await this.receivingВata(currentPage, state);
                console.log($.parseJSON(data));
            }
        }
    }, {
        key: 'itemsRender',
        value: function itemsRender(items) {
            var _iteratorNormalCompletion = true;
            var _didIteratorError = false;
            var _iteratorError = undefined;

            try {
                for (var _iterator = items[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                    var val = _step.value;

                    var checkPrice = '';
                    var checkPercentSale = '';
                    if (val["is_sale"] == 1) {
                        checkPrice = '<p class="item-old-price">' + val["price"] + ' \u0440\u0443\u0431.</p><p class="item-sale-price">' + val["sale_price"] + ' \u0440\u0443\u0431.</p>';
                        checkPercentSale = '<div class="item-sale-percent"><p>' + val["percentSale"] + '%</p></div>';
                    } else {
                        checkPrice = '<p>' + val["price"] + ' \u0440\u0443\u0431.</p>';
                    }
                    $('.catalog-items-list').append('\n                    <div class="catalog-item">\n                        <div class="shadow"></div>\n                        <img src="' + val["image"] + '" alt="Item-' + val["id"] + '">\n                        ' + checkPercentSale + '\n                        <div class="image_overlay"></div>\n                        <div class="add_to_cart product_opacity">\u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u0432 \u043A\u043E\u0440\u0437\u0438\u043D\u0443</div>\n                        <div class="add_to_compare product_opacity">\u041E\u0442\u043B\u043E\u0436\u0438\u0442\u044C</div>\n                        <div class="product-info">         \n                            <div class="info-container">\n                                <div class="info-container-header">\n                                    <div class="product-name">\n                                        <a href="../product/' + val["id"] + '">\n                                        <p class="product-title">' + val["name"] + ' ' + val["article"] + '</p>\n                                        <p class="product-brand">' + val["brand_name"] + '</p>\n                                        </a> \n                                    </div>\n                                    <div class="product-price">' + checkPrice + '</div>\n                                </div>\n                                <div class="product-hide-info">\n                                    <strong>\u0420\u0430\u0437\u043C\u0435\u0440</strong>\n                                    <div class="product-size">' + val["size"] + '</div>\n                                    <strong>\u0421\u043E\u0441\u0442\u0430\u0432</strong>\n                                    <div class="product-compositions">\n                                        ' + val["composition"] + '\n                                    </div>\n                                </div>                       \n                            </div>                         \n                        </div>\n                    </div>\n                ');
                }
            } catch (err) {
                _didIteratorError = true;
                _iteratorError = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion && _iterator.return) {
                        _iterator.return();
                    }
                } finally {
                    if (_didIteratorError) {
                        throw _iteratorError;
                    }
                }
            }
        }
    }, {
        key: 'countItemsRender',
        value: function countItemsRender(count) {
            if (count == "Error") {
                $('.catalog-items-list').html("");
                $('.catalog-items-list').append('<h1>Список пуст</h1>');
                this.countItems.innerText = 0;
            } else if (count == 0) {
                $('.catalog-items-list').append('<h1>Список пуст</h1>');
                this.countItems.innerText = 0;
            }
        }
    }, {
        key: 'currentCountItems',
        value: function currentCountItems(itemsPerPage, currentPage, recordPerPage, totalItems) {
            if (this.countItemsPerPage != 0) {
                var fromPage = recordPerPage * (currentPage - 1) + 1;
                var toPage = fromPage - 1 + itemsPerPage;
                return '\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E \u0441 ' + fromPage + ' \u043F\u043E ' + toPage + ' \u0438\u0437 ' + totalItems;
            } else {
                return '0';
            }
        }
    }]);

    return Catalog;
}();

var Filter = function () {
    function Filter(object) {
        _classCallCheck(this, Filter);

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

    _createClass(Filter, [{
        key: 'init',
        value: function init() {
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
            } catch (e) {
                console.log(e);
            }
        }
    }, {
        key: 'checkUndefined',
        value: function checkUndefined() {
            for (var _len = arguments.length, variable = Array(_len), _key = 0; _key < _len; _key++) {
                variable[_key] = arguments[_key];
            }

            var _iteratorNormalCompletion2 = true;
            var _didIteratorError2 = false;
            var _iteratorError2 = undefined;

            try {
                for (var _iterator2 = variable[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
                    var vars = _step2.value;

                    if (vars == undefined) {
                        return false;
                    } else {
                        return true;
                    }
                }
            } catch (err) {
                _didIteratorError2 = true;
                _iteratorError2 = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion2 && _iterator2.return) {
                        _iterator2.return();
                    }
                } finally {
                    if (_didIteratorError2) {
                        throw _iteratorError2;
                    }
                }
            }
        }

        //Функция проверки цены на наличия в ней текста или пустого значения

    }, {
        key: 'checkPrice',
        value: function checkPrice(value) {
            var check = value != '' && value.match(/^\d+$/) ? true : false;
            return check;
        }

        //сортировка товаров

    }, {
        key: 'sorting',
        value: function sorting() {
            var _this3 = this;

            var _iteratorNormalCompletion3 = true;
            var _didIteratorError3 = false;
            var _iteratorError3 = undefined;

            try {
                for (var _iterator3 = this.sortingList[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
                    var sort = _step3.value;

                    sort.addEventListener('change', function (e) {
                        _this3.obj.state["sortBy"] = e.target.value;
                        _this3.obj.currentPage = 1;
                        _this3.obj.getData(_this3.obj.currentPage, _this3.obj.state);
                    }, false);
                }
            } catch (err) {
                _didIteratorError3 = true;
                _iteratorError3 = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion3 && _iterator3.return) {
                        _iterator3.return();
                    }
                } finally {
                    if (_didIteratorError3) {
                        throw _iteratorError3;
                    }
                }
            }
        }

        //Обработчик события обновления ценогого диапазона, срабатывает через 500 мс

    }, {
        key: 'filterPrice',
        value: function filterPrice() {
            var _this4 = this;

            this.minPrice.addEventListener('change', function (e) {
                var target = e.target.value;
                if (_this4.checkPrice(target)) {
                    _this4.obj.state['minPrice'] = target;
                    setTimeout(function () {
                        _this4.obj.getData(_this4.obj.currentPage, _this4.obj.state);
                    }, 500);
                }
            }, false);
            this.maxPrice.addEventListener('change', function (e) {
                var target = e.target.value;
                if (_this4.checkPrice(target)) {
                    _this4.obj.state["maxPrice"] = target;
                    setTimeout(function () {
                        _this4.obj.getData(_this4.obj.currentPage, _this4.obj.state);
                    }, 500);
                }
            }, false);
        }
    }, {
        key: 'filterCategory',
        value: function filterCategory() {
            var _this5 = this;

            //Назначение события для фильтра категорий товара
            var _iteratorNormalCompletion4 = true;
            var _didIteratorError4 = false;
            var _iteratorError4 = undefined;

            try {
                for (var _iterator4 = this.categoryList[Symbol.iterator](), _step4; !(_iteratorNormalCompletion4 = (_step4 = _iterator4.next()).done); _iteratorNormalCompletion4 = true) {
                    var category = _step4.value;

                    category.addEventListener('change', function (e) {
                        var target = e.target;
                        if (target.checked) {
                            _this5.obj.currentPage = 1;
                            _this5.obj.state["categoryFilter"].push(target.value);
                            _this5.obj.getData(_this5.obj.currentPage, _this5.obj.state);
                        } else if (!target.checked) {
                            _this5.obj.currentPage = 1;
                            var index = _this5.obj.state["categoryFilter"].indexOf(target.value);
                            _this5.obj.state["categoryFilter"].splice(index, 1);
                            _this5.obj.getData(_this5.obj.currentPage, _this5.obj.state);
                        }
                    }, false);
                }
                //Назначение события для фильтра бренда товара
            } catch (err) {
                _didIteratorError4 = true;
                _iteratorError4 = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion4 && _iterator4.return) {
                        _iterator4.return();
                    }
                } finally {
                    if (_didIteratorError4) {
                        throw _iteratorError4;
                    }
                }
            }

            var _iteratorNormalCompletion5 = true;
            var _didIteratorError5 = false;
            var _iteratorError5 = undefined;

            try {
                for (var _iterator5 = this.brandList[Symbol.iterator](), _step5; !(_iteratorNormalCompletion5 = (_step5 = _iterator5.next()).done); _iteratorNormalCompletion5 = true) {
                    var brand = _step5.value;

                    brand.addEventListener('change', function (e) {
                        var target = e.target;
                        if (target.checked) {
                            _this5.obj.currentPage = 1;
                            _this5.obj.state["brandFilter"].push(target.value);
                            _this5.obj.getData(_this5.obj.currentPage, _this5.obj.state);
                        } else if (!target.checked) {
                            _this5.obj.currentPage = 1;
                            var index = _this5.obj.state["brandFilter"].indexOf(target.value);
                            _this5.obj.state["brandFilter"].splice(index, 1);
                            _this5.obj.getData(_this5.obj.currentPage, _this5.obj.state);
                        }
                    }, false);
                }
                //Назначение события для фильтра сезонов товара
            } catch (err) {
                _didIteratorError5 = true;
                _iteratorError5 = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion5 && _iterator5.return) {
                        _iterator5.return();
                    }
                } finally {
                    if (_didIteratorError5) {
                        throw _iteratorError5;
                    }
                }
            }

            var _iteratorNormalCompletion6 = true;
            var _didIteratorError6 = false;
            var _iteratorError6 = undefined;

            try {
                for (var _iterator6 = this.seasonList[Symbol.iterator](), _step6; !(_iteratorNormalCompletion6 = (_step6 = _iterator6.next()).done); _iteratorNormalCompletion6 = true) {
                    var _brand = _step6.value;

                    _brand.addEventListener('change', function (e) {
                        var target = e.target;
                        if (target.checked) {
                            _this5.obj.currentPage = 1;
                            _this5.obj.state["seasonFilter"].push(target.value);
                            _this5.obj.getData(_this5.obj.currentPage, _this5.obj.state);
                        } else if (!target.checked) {
                            _this5.obj.currentPage = 1;
                            var index = _this5.obj.state["seasonFilter"].indexOf(target.value);
                            _this5.obj.state["seasonFilter"].splice(index, 1);
                            _this5.obj.getData(_this5.obj.currentPage, _this5.obj.state);
                        }
                    }, false);
                }
            } catch (err) {
                _didIteratorError6 = true;
                _iteratorError6 = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion6 && _iterator6.return) {
                        _iterator6.return();
                    }
                } finally {
                    if (_didIteratorError6) {
                        throw _iteratorError6;
                    }
                }
            }
        }
    }, {
        key: 'filterSearch',
        value: function filterSearch() {
            var _this6 = this;

            this.searchBtn.addEventListener('click', function () {
                var val = _this6.searchInput.value;
                if (val.length == 0) {
                    _this6.obj.state["searchValue"] = "";
                    _this6.obj.currentPage = 1;
                    _this6.obj.getData(_this6.obj.currentPage, _this6.obj.state);
                } else if (val.length >= 3 && val.length <= 20) {
                    if (!val.match(/[^a-zA-Zа-яА-Я0-9]/g)) {
                        _this6.obj.state["searchValue"] = '%' + val + '%';
                        _this6.obj.currentPage = 1;
                        _this6.obj.getData(_this6.obj.currentPage, _this6.obj.state);
                    }
                }
            });
        }
    }, {
        key: 'filterSale',
        value: function filterSale() {
            var _this7 = this;

            this.filterIsSale.addEventListener('change', function (e) {
                var target = e.target;
                if (target.checked) {
                    _this7.obj.state["isSaleFilter"] = 1;
                    _this7.obj.currentPage = 1;
                    _this7.obj.getData(_this7.obj.currentPage, _this7.obj.state);
                } else if (!target.checked) {
                    _this7.obj.state["isSaleFilter"] = '';
                    _this7.obj.currentPage = 1;
                    _this7.obj.getData(_this7.obj.currentPage, _this7.obj.state);
                }
            }, false);
        }
    }]);

    return Filter;
}();

// console.log(window.location.pathname);