<link rel="stylesheet" href="/static/js/simplePagination.css">
<style>
	span {
		margin: 0 4px;
		font-size: 16px;
		font-weight: bold;
	}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<h2 id="get_allProduct">Получить список продуктов</h2>
<h2 id="add_newProduct">Добавить новый продукт</h2>
<div id="tabs">
    

</div>

<div class="paginations">
	
</div>


<script src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous">
 </script>
 <script src="/static/js/jquery.simplePagination.js"></script>
<script type="text/javascript">

    $('#get_allProduct').on('click', function(){
            load_allProduct(); 
    })
    var total_pages, qwe, currentPage = 1; 
    function load_allProduct(page) {  
      	var prev = "prev";
      	var next = "next";
        $.ajax({  
            url:"admin/getAllProducts", /*???*/  
            method:"POST",  
            data:{page:page}, 
            success:function(data){ 
                $('#tabs').empty();
            	qwe = $.parseJSON(data);
                console.log(qwe)
                $('#tabs').append('\n<table>\n<tr>\n<th>ID</th>\n<th>Название</th>\n<th>Цена</th>\n</tr>\n'+qwe.item.map(function (items) {
                    return '<tr>\n<td>'+items['id']+'</td>\n<td>'+items['name']+'</td>\n<td>'+items['price']+'</td>\n<td><a href="/admin/edit/'+items['id']+'">Изменить </a></td>\n<td><a href="/admin/delete/'+items['id']+'">Удалить</a></td>\n</tr>';
                })+'\n</table>\n');
            	total_items = qwe['total_item'];
            	item_on_page = qwe['record_per_page'];
            	currentPage = qwe['current_page'];
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

</script>