//Открытие бокового меню
$('#menu-action').click(function() {
  $('.sidebar').toggleClass('active');
  $('.main').toggleClass('active');
  $(this).toggleClass('active');

  if ($('.sidebar').hasClass('active')) {
    $(this).find('i').addClass('fa-close');
    $(this).find('i').removeClass('fa-bars');
  } else {
    $(this).find('i').addClass('fa-bars');
    $(this).find('i').removeClass('fa-close');
  }
});

// Добавление эффекта наведения на меню
$('#menu-action').hover(function() {
  $('.sidebar').toggleClass('hovered');
});


load_allProduct();
//Подтверждение удаления товара
function confirmDelete(id) {
  if (confirm("Подтвердите удаление") === true) {
    window.location = "admin/delete/" + id;
  }
}
//Переход на страницу редактирования товара
function editItem(id){
  window.location = "admin/edit/" + id;
}

var total_pages, items, currentPage = 1;
//Получение всех записей о товарах 
function load_allProduct(page) {  
  $.ajax({  
    url:"admin/getAllProducts", /*???*/  
    method:"POST",  
    data:{page:page}, 
    success:function(data){ 
      $('#tabs').empty();
      items = $.parseJSON(data);
      $('#tabs').append("<table>\n<tr>\n<th>Название</th>\n<th>Артикль</th>\n<th>Бренд</th>\n<th>Категория</th>\n<th>Сезон</th>\n<th>Размер</th>\n<th>Цвет</th>\n<th>Состав</th>\n<th>Цена</th>\n<th></th>\n<th></th>\n</tr>" + items.item.map(function (items) {
        return "<tr>\n<td>" + items["name"] + "</td>\n<td>" + items["article"] + "</td>\n<td>" + items["brand_name"] + "</td>\n<td>" + items["category_name"] + "</td>\n<td>" + items["season_name"] + "</td>\n<td>" + items["size"] + "</td>\n<td>" + items["color_name"] + "</td>\n<td>" + items["composition"] + "</td>\n<td>" + items["price"] + "</td>\n<td class=\"edit_item\" onclick=\"editItem(" + items['id'] + ");\">Изменить</td>\n<td class=\"delete_item\" onclick=\"return confirmDelete(" + items['id'] + ")\">Удалить</td></tr>";
      }) + "</table>");
      total_items = items['total_item'];
      item_on_page = items['record_per_page'];
      currentPage = items['current_page'];
      $('.paginations').pagination({
        items: total_items,
        itemsOnPage: item_on_page,
        cssStyle: 'dark-theme',
        hrefTextPrefix: '',
        currentPage : currentPage,
        onPageClick : function(pageNumber) {
          load_allProduct(pageNumber);
        }
      });
    }  
  })  
}  