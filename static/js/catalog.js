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
        if (!val.match(/[^a-zA-Z0-9]/g)) {
            searchValue = '%' + val + '%';
            getData(currentPage, state, sortBy, searchValue);
        }
    }
});

async function getData(currentPage, state, sortBy, searchValue) {
    try {
        var data = await receivingВata(currentPage, state, sortBy, searchValue);
        var items = $.parseJSON(data);
        $('.catalog-items-list').html("");
        var total_items = items['total_item'];
        var item_on_page = items['record_per_page'];
        if (items["item"] != undefined) {
            var _iteratorNormalCompletion4 = true;
            var _didIteratorError4 = false;
            var _iteratorError4 = undefined;

            try {
                for (var _iterator4 = items["item"][Symbol.iterator](), _step4; !(_iteratorNormalCompletion4 = (_step4 = _iterator4.next()).done); _iteratorNormalCompletion4 = true) {
                    var val = _step4.value;

                    var _checkPrice = '';
                    if (val["is_sale"] == 1) {
                        _checkPrice = '<span class="item-old-price">' + val["price"] + ' \u0440\u0443\u0431.</span><span class="item-sale-price">' + val["sale_price"] + ' \u0440\u0443\u0431.</span>';
                    } else {
                        _checkPrice = '<span>' + val["price"] + ' \u0440\u0443\u0431.</span>';
                    }
                    $('.catalog-items-list').append('<div class="catalog-item"><div class="item-image"><a href=\'../product/' + val["id"] + '\'><img src="' + val["image"] + '" alt="Item-' + val["id"] + '"></a><div class="item-compare"><i class="fa fa-heart-o" aria-hidden="true"></i></div></div><div class="item-info"><div class="item-info-price">' + _checkPrice + '</div><div class="item-info-shop-now" id="shop-now-' + val["id"] + '">\u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u0432 \u043A\u043E\u0440\u0437\u0438\u043D\u0443</div><div class="item-info-title"><h3>' + val["name"] + ' ' + val["article"] + '</h3></div><div class="item-info-brand"><span>' + val["brand_name"] + '</span></div><div class="item-info-size"><span>' + val["size"] + '</span></div></div></div>');
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
        countItems.innerText = total_items;
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