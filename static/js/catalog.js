'use strict';

//Выбор бренда + проверка на наличие класса "active"
$('#brand_list').on('click', 'li', function () {
    if (this.className !== "active" && this.id !== state.brand_li) {
        state.brand_li = this.id;
        $("#brand_list").children('li').removeClass('active');
        $(this).toggleClass('active');
        //Вызов AJAX запроса + обнуление текущей страницы (чтоб не сломалось)
        currentPage = 1;
        load_data(currentPage, state);
    }
});
//Выбор категории + проверка на наличие класса "active"
$('#category_list').on('click', 'li', function () {
    if (this.className !== "active" && this.id !== state.cat_li) {
        state.cat_li = this.id;
        $("#category_list").children('li').removeClass('active');
        $(this).toggleClass('active');
        //Вызов AJAX запроса + обнуление текущей страницы (чтоб не сломалось)
        currentPage = 1;
        load_data(currentPage, state);
    }
});

//Состояния (минимальная и максимальная цена, выбранная категория и бренд (по умолчанию "Все"))
var state = {
    min: 0,
    max: maxPrice,
    cat_li: "all_category",
    brand_li: "all_brand"
};
//Установка максимальной цены в текстовое поле
$('#amount_max').val(maxPrice);
//События по изменению минимальной и максимальной цены и вызова AJAX запроса
$('#amount_min').on('change', function () {
    state.min = this.value;
    load_data(currentPage, state);
    $("#slider-range").slider({
        values: [this.value, state.max]
    });
});
$('#amount_max').on('change', function () {
    state.max = this.value;
    load_data(currentPage, state);
    $("#slider-range").slider({
        values: [state.min, this.value]
    });
});
//jQuery UI слайдер ценового диапазона
$(function () {
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: maxPrice,
        values: [0, maxPrice],
        slide: function slide(event, ui) {
            $("#amount").val("$" + ui.values[0] + "-$" + ui.values[1]);
            state.min = ui.values[0];
            state.max = ui.values[1];
            $('#amount_min').val(ui.values[0]);
            $('#amount_max').val(ui.values[1]);
        }
    });
    //При отпускания мышки от слайрера, вызывается AJAX запрос
    $('#slider-range').on('mouseup', function () {
        load_data(currentPage, state);
    });
});
// var q = <?= json_encode($user); ?>;
//По умолчанию вызов AJAX запрос
load_data(currentPage, state);
var total_pages,
    items,
    currentPage = 1;

//AJAX запрос для вызова каталог продуктов (принимает значения: текущая страница и объект состояний)
function load_data(page, state) {
    $.ajax({
        url: "getAllUsers",
        method: "POST",
        data: { page: page, state: state },
        success: function success(data) {
            items = $.parseJSON(data);
            console.log(items);
            $('#list_product').empty();
            if (items.hasOwnProperty('item') === true) {
                for (var i = 0; i < items.item.length; i++) {
                    if (items.item[i]['is_sale'] == 1) {
                        sale_price = '<span class="old_price">' + items.item[i]["price"] + '</span>&nbsp;&nbsp;<span class="price">' + items.item[i]["sale_price"] + '</span>';
                    } else {
                        sale_price = '<span class="price">' + items.item[i]["price"] + '</span>';
                    }
                    $('#list_product').append('\n                            <div class="col-md-4 col-sm-4">\n                                <div class="product_item">\n                                    <div class="single_product clearfix">\n                                        <a href="../product/' + items.item[i]["id"] + '">\n                                            <span class="product_image">\n                                                <img src="' + items.item[i]["image"] + '" alt="" width="200px">\n                                            </span>\n                                        </a>\n                                    </div>\n                                    <h2 class="product_name"><a href="../product/' + items.item[i]["id"] + '">' + items.item[i]["name"] + '</a></h2>\n                                    <div class="oroduct_price">\n                                        ' + sale_price + '\n                                    </div>\n                                </div>\n                            </div>');
                }
            } else {
                $('#list_product').append('Пусто'); ////
            }

            //Переменные для создания пагинации (всего страниц, продуктов на странице, текущая страница)
            total_items = items['total_item'];
            item_on_page = items['record_per_page'];

            //Установка новой текущей страницы
            currentPage = items['current_page'];

            //Пагинация
            $('.paginations').pagination({
                items: total_items,
                itemsOnPage: item_on_page,
                cssStyle: 'dark-theme',
                hrefTextPrefix: '',
                currentPage: currentPage,
                onPageClick: function onPageClick(pageNumber) {

                    load_data(pageNumber, state);
                    //Изменение пагинации
                }
            });
        }
    }); //AJAX 
}