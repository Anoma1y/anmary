"use strict";

var categoryList = document.getElementsByName('categoryList');
var brandList = document.getElementsByName('brandList');
var minPrice = document.getElementById('minPrice');
var maxPrice = document.getElementById('maxPrice');
var countItems = document.getElementById('countItems');

var total_pages,
    items,
    currentPage = 1;
var state = {
    categoryFilter: [],
    brandFilter: [],
    minPrice: minPrice.value,
    maxPrice: maxPrice.value
};
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
minPrice.addEventListener('change', function (e) {
    var target = e.target.value;
    state["minPrice"] = target;
    console.log(checkPrice(target));
    if (checkPrice(target)) {
        setTimeout(function () {
            load_data(currentPage, state, sortBy);
        }, 500);
    }
}, false);
maxPrice.addEventListener('change', function (e) {
    var target = e.target.value;
    state["maxPrice"] = target;
    if (checkPrice(target)) {
        setTimeout(function () {
            load_data(currentPage, state, sortBy);
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
            if (e.target.checked) {
                state["categoryFilter"].push(e.target.value);
                load_data(currentPage, state, sortBy);
            } else if (!e.target.checked) {
                var index = state["categoryFilter"].indexOf(e.target.value);
                state["categoryFilter"].splice(index, 1);
                load_data(currentPage, state, sortBy);
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
            if (e.target.checked) {
                state["brandFilter"].push(e.target.value);
                load_data(currentPage, state, sortBy);
            } else if (!e.target.checked) {
                var index = state["brandFilter"].indexOf(e.target.value);
                state["brandFilter"].splice(index, 1);
                load_data(currentPage, state, sortBy);
            }
        }, false);
    }

    //сортировка товаров
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

$('select[name="sortBy"]').on('change', function () {
    var sort = $('select[name="sortBy"] option:selected').val();
    sortBy = sort;
    load_data(currentPage, state, sortBy);
});

//AJAX запрос для вызова каталог продуктов (принимает значения: текущая страница и объект состояний)
function load_data(page, state, sortBy) {
    $.ajax({
        url: "getAllProduct",
        method: "POST",
        data: { page: page, state: state, sort: sortBy }, //текущая страница, фильтр и сортировка  
        success: function success(data) {
            items = $.parseJSON(data);
            $('.catalog-items-list').html("");
            var total_items = items['total_item'];
            var item_on_page = items['record_per_page'];
            var _iteratorNormalCompletion3 = true;
            var _didIteratorError3 = false;
            var _iteratorError3 = undefined;

            try {
                for (var _iterator3 = items["item"][Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
                    var val = _step3.value;

                    var _checkPrice = '';
                    if (val["is_sale"] == 1) {
                        _checkPrice = '<span class="item-old-price">' + val["price"] + ' \u0440\u0443\u0431.</span><span class="item-sale-price">' + val["sale_price"] + ' \u0440\u0443\u0431.</span>';
                    } else {
                        _checkPrice = '<span>' + val["price"] + ' \u0440\u0443\u0431.</span>';
                    }
                    $('.catalog-items-list').append('<div class="catalog-item"><div class="item-image"><a href=\'../product/' + val["id"] + '\'><img src="' + val["image"] + '" alt="Item-' + val["id"] + '"></a><div class="item-compare"><i class="fa fa-heart-o" aria-hidden="true"></i></div></div><div class="item-info"><div class="item-info-price">' + _checkPrice + '</div><div class="item-info-shop-now" id="shop-now-' + val["id"] + '">\u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u0432 \u043A\u043E\u0440\u0437\u0438\u043D\u0443</div><div class="item-info-title"><h3>' + val["name"] + ' ' + val["article"] + '</h3></div><div class="item-info-brand"><span>' + val["brand_name"] + '</span></div><div class="item-info-size"><span>' + val["size"] + '</span></div></div></div>');
                }
                //Установка новой текущей страницы
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
                    load_data(pageNumber, state, sortBy);
                }
            });
        }

    }); //AJAX 
}