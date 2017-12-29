

// function getSaleData() {
//     $.ajax({
//         url: 'getAllProductSale',
//         type: 'GET',
//     })
//     .done(function(data) {
//         var items = JSON.parse(data);

//         let total_items = items['total_item'];
//         //Записей на странице
//         let item_on_page = items['record_per_page'];
//         //Установка новой текущей страницы
//         let currentPage = items['current_page'];

//         if (items["item"] != undefined) {
//             for (let val of items["item"]) {
//                 let checkPrice = '';
//                 let checkPercentSale = '';
//                 if (val["is_sale"] == 1) {
//                     checkPrice = `<p class="item-old-price">${val["price"]} руб.</p><p class="item-sale-price">${val["sale_price"]} руб.</p>`;
//                     checkPercentSale = `<div class="item-sale-percent"><p>${val["percentSale"]}%</p></div>`;
//                 } else {
//                     checkPrice = `<p>${val["price"]} руб.</p>`;
//                 }
//                 $('.catalog-items-list').append(`
//                     <div class="catalog-item">
//                         <div class="shadow"></div>
//                         <img src="${val["image"]}" alt="Item-${val["id"]}">
//                         ${checkPercentSale}
//                         <div class="image_overlay"></div>
//                         <div class="add_to_cart product_opacity">Добавить в корзину</div>
//                         <div class="add_to_compare product_opacity">Отложить</div>
//                         <div class="product-info">         
//                             <div class="info-container">
//                                 <div class="info-container-header">
//                                     <div class="product-name">
//                                         <a href="../product/${val["id"]}">
//                                         <p class="product-title">${val["name"]} ${val["article"]}</p>
//                                         <p class="product-brand">${val["brand_name"]}</p>
//                                         </a> 
//                                     </div>
//                                     <div class="product-price">${checkPrice}</div>
//                                 </div>
//                                 <div class="product-hide-info">
//                                     <strong>Размер</strong>
//                                     <div class="product-size">${val["size"]}</div>
//                                     <strong>Состав</strong>
//                                     <div class="product-compositions">
//                                         ${val["composition"]}
//                                     </div>
//                                 </div>                       
//                             </div>                         
//                         </div>
//                     </div>
//                 `);
//             }
//         } else {
//             countItemsRender(0);
//         }


//         $('.paginations').pagination({
//             items: total_items,
//             itemsOnPage: item_on_page,
//             cssStyle: 'dark-theme',
//             prevText: '',
//             nextText: '',
//             hrefTextPrefix: '',
//             currentPage: currentPage,
//             onPageClick: (pageNumber) => {
//                 getSaleData(pageNumber);
//            }
//         });

//     })
//     .fail(function() {
//         console.log("error");
//     })
// }
// window.onload = getSaleData();
"use strict";