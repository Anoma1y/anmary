"use strict";

var categoryList = document.getElementsByName('categoryList');
var brandList = document.getElementsByName('brandList');
var seasonList = document.getElementsByName('seasonList');
var minPrice = document.getElementById('minPrice');
var maxPrice = document.getElementById('maxPrice');
var searchInput = document.getElementById('searchFilter_input');
var searchBtn = document.getElementById('searchFilterBtn');
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
};
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
minPrice.addEventListener('change', function (e) {
    var target = e.target.value;
    state["minPrice"] = target;
    if (checkPrice(target)) {
        setTimeout(function () {
            getData(currentPage, state, sortBy, searchValue);;
        }, 500);
    }
}, false);
maxPrice.addEventListener('change', function (e) {
    var target = e.target.value;
    state["maxPrice"] = target;
    if (checkPrice(target)) {
        setTimeout(function () {
            getData(currentPage, state, sortBy, searchValue);;
        }, 500);
    }
}, false);

//Назначение события для фильтра категорий товара
var _iteratorNormalCompletion = true;
var _didIteratorError = false;
var _iteratorError = undefined;

try {
    for (var _iterator = categoryList[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
        var category = _step.value;

        category.addEventListener('change', function (e) {
            var target = e.target;
            if (target.checked) {
                state["categoryFilter"].push(target.value);
                getData(currentPage, state, sortBy, searchValue);
            } else if (!target.checked) {
                var index = state["categoryFilter"].indexOf(target.value);
                state["categoryFilter"].splice(index, 1);
                getData(currentPage, state, sortBy, searchValue);
            }
        }, false);
    }
    //Назначение события для фильтра бренда товара
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

var _iteratorNormalCompletion2 = true;
var _didIteratorError2 = false;
var _iteratorError2 = undefined;

try {
    for (var _iterator2 = brandList[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
        var brand = _step2.value;

        brand.addEventListener('change', function (e) {
            var target = e.target;
            if (target.checked) {
                state["brandFilter"].push(target.value);
                getData(currentPage, state, sortBy, searchValue);
            } else if (!target.checked) {
                var index = state["brandFilter"].indexOf(target.value);
                state["brandFilter"].splice(index, 1);
                getData(currentPage, state, sortBy, searchValue);
            }
        }, false);
    }

    //Назначение события для фильтра сезонов товара
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

var _iteratorNormalCompletion3 = true;
var _didIteratorError3 = false;
var _iteratorError3 = undefined;

try {
    for (var _iterator3 = seasonList[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
        var _brand = _step3.value;

        _brand.addEventListener('change', function (e) {
            var target = e.target;
            if (target.checked) {
                state["seasonFilter"].push(target.value);
                getData(currentPage, state, sortBy, searchValue);
            } else if (!target.checked) {
                var index = state["seasonFilter"].indexOf(target.value);
                state["seasonFilter"].splice(index, 1);
                getData(currentPage, state, sortBy, searchValue);
            }
        }, false);
    }

    //сортировка товаров
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

$('select[name="sortBy"]').on('change', function () {
    var sort = $('select[name="sortBy"] option:selected').val();
    sortBy = sort;
    getData(currentPage, state, sortBy, searchValue);
});

function receivingВata(page, state, sortBy) {
    var searchValue = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : "";

    return new Promise(function (res, rej) {
        $.ajax({
            url: "getAllProduct",
            method: "POST",
            data: { page: page, state: state, sort: sortBy, searchValue: searchValue } //текущая страница, фильтр и сортировка
        }).done(res).fail(rej);
    });
}
window.onload = getData(currentPage, state, sortBy, searchValue);

searchBtn.addEventListener('click', function () {
    var val = searchInput.value;
    if (val.length == 0) {
        searchValue = "";
        getData(currentPage, state, sortBy, searchValue);
    } else if (val.length >= 3 && val.length <= 20) {
        if (!val.match(/[^a-zA-Zа-яА-Я0-9]/g)) {
            searchValue = '%' + val + '%';
            getData(currentPage, state, sortBy, searchValue);
        }
    }
});

async function getData(currentPage, state, sortBy, searchValue) {
    try {
        var currentCountItems = function currentCountItems(itemsPerPage, currentPage, recordPerPage, totalItems) {
            if (countItemsPerPage != 0) {
                var fromPage = recordPerPage * (currentPage - 1) + 1;
                var toPage = fromPage - 1 + itemsPerPage;
                return '\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E \u0441 ' + fromPage + ' \u043F\u043E ' + toPage + ' \u0438\u0437 ' + totalItems;
            } else {
                return '0';
            }
        };

        var data = await receivingВata(currentPage, state, sortBy, searchValue);
        var items = $.parseJSON(data);
        $('.catalog-items-list').html("");
        var total_items = items['total_item'];
        var item_on_page = items['record_per_page'];

        var countItemsPerPage = 0;
        if (items["item"] != undefined) {
            countItemsPerPage = Object.keys(items["item"]).length;
            var _iteratorNormalCompletion4 = true;
            var _didIteratorError4 = false;
            var _iteratorError4 = undefined;

            try {
                for (var _iterator4 = items["item"][Symbol.iterator](), _step4; !(_iteratorNormalCompletion4 = (_step4 = _iterator4.next()).done); _iteratorNormalCompletion4 = true) {
                    var val = _step4.value;

                    var _checkPrice = '';
                    if (val["is_sale"] == 1) {
                        _checkPrice = '<p class="item-old-price">' + val["price"] + ' \u0440\u0443\u0431.</p><p class="item-sale-price">' + val["sale_price"] + ' \u0440\u0443\u0431.</p>';
                    } else {
                        _checkPrice = '<p>' + val["price"] + ' \u0440\u0443\u0431.</p>';
                    }
                    $('.catalog-items-list').append('\n                        <div class="catalog-item">\n                            <div class="shadow"></div>\n                            <img src="https://www.juicycouture.asia/skin/frontend/jc/default/images/homepage/MMe21_IMGs_CollectionFeatured.jpg" alt="Item-' + val["id"] + '">\n                            <div class="image_overlay"></div>\n                            <div class="add_to_cart product_opacity">\u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u0432 \u043A\u043E\u0440\u0437\u0438\u043D\u0443</div>\n                            <div class="add_to_compare product_opacity">\u041E\u0442\u043B\u043E\u0436\u0438\u0442\u044C</div>\n                            <div class="product-info">         \n                                <div class="info-container">\n                                    <div class="info-container-header">\n                                        <div class="product-name">\n                                            <a href="../product/' + val["id"] + '">\n                                            <p class="product-title">' + val["name"] + ' ' + val["article"] + '</p>\n                                            <p class="product-brand">' + val["brand_name"] + '</p>\n                                            </a> \n                                        </div>\n                                        <div class="product-price">' + _checkPrice + '</div>\n                                    </div>\n                                    <div class="product-hide-info">\n                                        <strong>\u0420\u0430\u0437\u043C\u0435\u0440</strong>\n                                        <div class="product-size">' + val["size"] + '</div>\n                                        <strong>\u0421\u043E\u0441\u0442\u0430\u0432</strong>\n                                        <div class="product-compositions">\n                                            ' + val["composition"] + '\n                                        </div>\n                                    </div>                       \n                                </div>                         \n                            </div>\n                        </div>\n                    ');
                }
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
            currentPage: currentPage,
            onPageClick: function onPageClick(pageNumber) {
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