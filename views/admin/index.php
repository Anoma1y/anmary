<link rel="stylesheet" href="/static/js/simplePagination.css">
<style>
@import url('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
@import url(https://fonts.googleapis.com/css?family=Lato:300,400,700);
*,
*:before,
*:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
body {
  background: #f5f5f5;
  padding: 0;
  margin: 0;
  font-family: 'Lato', sans-serif;
}
i.fa {
  font-size: 16px;
}
p {
  font-size: 16px;
  line-height: 1.428571429;
}
.header {
  position: fixed;
  z-index: 10;
  top: 0;
  left: 0;
  background: #3498DB;
  width: 100%;
  height: 50px;
  line-height: 50px;
  color: #fff;
}
.header .logo {
  text-transform: uppercase;
  letter-spacing: 1px;
}
.header #menu-action {
  display: block;
  float: left;
  width: 60px;
  height: 50px;
  line-height: 50px;
  margin-right: 15px;
  color: #fff;
  text-decoration: none;
  text-align: center;
  background: rgba(0, 0, 0, 0.15);
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 1px;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.header #menu-action i {
  display: inline-block;
  margin: 13px 0px;
}
.header #menu-action span {
  width: 0px;
  display: none;
  overflow: hidden;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.header #menu-action:hover {
  background: rgba(0, 0, 0, 0.25);
}
.header #menu-action.active {
  width: 250px;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.header #menu-action.active span {
  display: inline;
  width: auto;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.sidebar {
  position: fixed;
  z-index: 10;
  left: 0;
  top: 50px;
  height: 100%;
  width: 60px;
  background: #fff;
  border-right: 1px solid #ddd;
  text-align: center;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.sidebar:hover,
.sidebar.active,
.sidebar.hovered {
  width: 250px;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.sidebar ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}
.sidebar ul li {
  display: block;
}
.sidebar ul li a {
  display: block;
  position: relative;
  white-space: nowrap;
  overflow: hidden;
  border-bottom: 1px solid #ddd;
  color: #444;
  text-align: left;
}
.sidebar ul li a i {
  display: inline-block;
  width: 60px;
  height: 60px;
  line-height: 60px;
  text-align: center;
  -webkit-animation-duration: .7s;
  -moz-animation-duration: .7s;
  -o-animation-duration: .7s;
  animation-duration: .7s;
  -webkit-animation-fill-mode: both;
  -moz-animation-fill-mode: both;
  -o-animation-fill-mode: both;
  animation-fill-mode: both;
}
.sidebar ul li a span {
  display: inline-block;
  height: 60px;
  line-height: 60px;
}
.sidebar ul li a:hover {
  background-color: #eee;
}
.sidebar ul li a:hover i {
  -webkit-animation-name: swing;
  -moz-animation-name: swing;
  -o-animation-name: swing;
  animation-name: swing;
}
.main {
    position: relative;
    display: block;
    top: 50px;
    left: 0;
    padding: 15px;
    padding-left: 75px;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}
.main.active {
  padding-left: 275px;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}

@-webkit-keyframes swing {
  20% {
    -webkit-transform: rotate3d(0, 0, 1, 15deg);
    transform: rotate3d(0, 0, 1, 15deg);
  }
  40% {
    -webkit-transform: rotate3d(0, 0, 1, -10deg);
    transform: rotate3d(0, 0, 1, -10deg);
  }
  60% {
    -webkit-transform: rotate3d(0, 0, 1, 5deg);
    transform: rotate3d(0, 0, 1, 5deg);
  }
  80% {
    -webkit-transform: rotate3d(0, 0, 1, -5deg);
    transform: rotate3d(0, 0, 1, -5deg);
  }
  100% {
    -webkit-transform: rotate3d(0, 0, 1, 0deg);
    transform: rotate3d(0, 0, 1, 0deg);
  }
}
@keyframes swing {
  20% {
    -webkit-transform: rotate3d(0, 0, 1, 15deg);
    -ms-transform: rotate3d(0, 0, 1, 15deg);
    transform: rotate3d(0, 0, 1, 15deg);
  }
  40% {
    -webkit-transform: rotate3d(0, 0, 1, -10deg);
    -ms-transform: rotate3d(0, 0, 1, -10deg);
    transform: rotate3d(0, 0, 1, -10deg);
  }
  60% {
    -webkit-transform: rotate3d(0, 0, 1, 5deg);
    -ms-transform: rotate3d(0, 0, 1, 5deg);
    transform: rotate3d(0, 0, 1, 5deg);
  }
  80% {
    -webkit-transform: rotate3d(0, 0, 1, -5deg);
    -ms-transform: rotate3d(0, 0, 1, -5deg);
    transform: rotate3d(0, 0, 1, -5deg);
  }
  100% {
    -webkit-transform: rotate3d(0, 0, 1, 0deg);
    -ms-transform: rotate3d(0, 0, 1, 0deg);
    transform: rotate3d(0, 0, 1, 0deg);
  }
}
.swing {
  -webkit-transform-origin: top center;
  -ms-transform-origin: top center;
  transform-origin: top center;
  -webkit-animation-name: swing;
  animation-name: swing;
}
table {
    font-family: Tahoma, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
.edit_item {
    cursor: pointer;
    background-color: #5FBF0A;
}
.delete_item {
    cursor: pointer;
    background-color: #BF2D22;
}
.edit_item:hover {
    border: 1px solid black;
    background-color: #7DBF2A;
}
.delete_item:hover {
    border: 1px solid black;
    background-color: #BF4F2C;
}
BF4F2C
th {
    color: #fff;
    background-color: #555;
}
th, td {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
<div class="header">
  <a href="#" id="menu-action">
    <i class="fa fa-bars"></i>
    <span>Close</span>
  </a>
  <div class="logo">
    Anmary
  </div>
</div>
<div class="sidebar">
  <ul>
    <li><a href="/admin/add"><i class="fa fa-desktop"></i><span>Добавить товар</span></a></li>
    <li><a href="#"><i class="fa fa-server"></i><span>Добавить бренд</span></a></li>
    <li><a href="#"><i class="fa fa-calendar"></i><span>Добавить цвет</span></a></li>
    <li><a href="#"><i class="fa fa-envelope-o"></i><span>Добавить сезон</span></a></li>
    <li><a href="#"><i class="fa fa-table"></i><span>Добавить категорию</span></a></li>
</div>

<div class="main">
    <div id="tabs">

    </div> 
    <div class="paginations">
    
    </div> 
</div>


<!-- <h2 id="get_allProduct">Получить список продуктов</h2>
 --><!-- <h2 id="add_newProduct">Добавить новый продукт</h2> -->





<script src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous">
 </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

 <script src="/static/js/jquery.simplePagination.js"></script>
<script type="text/javascript">

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

// Add hover feedback on menu
$('#menu-action').hover(function() {
    $('.sidebar').toggleClass('hovered');
});


    load_allProduct()
    $('#get_allProduct').on('click', function(){
            load_allProduct(); 
    })
    function confirmDelete(id) {
        if (confirm("Подтвердите удаление") === true) {
             window.location = "admin/delete/" + id;
        }
    }
    function editItem(id){
        window.location = "admin/edit/" + id;
    }
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
                $('#tabs').append(`<table>
                        <tr>
                            <th>Название</th>
                            <th>Артикль</th> 
                            <th>Бренд</th>
                            <th>Категория</th>
                            <th>Сезон</th>
                            <th>Размер</th>
                            <th>Цвет</th>
                            <th>Состав</th>
                            <th>Цена</th>
                            <th></th>
                            <th></th>
                        </tr>`+qwe.item.map(function (items) {
                                return `<tr>
                                        <td>${items["name"]}</td>
                                        <td>${items["article"]}</td>
                                        <td>${items["brand_name"]}</td>
                                        <td>${items["category_name"]}</td>
                                        <td>${items["season_name"]}</td>
                                        <td>${items["size"]}</td>
                                        <td>${items["color_name"]}</td>
                                        <td>${items["composition"]}</td>
                                        <td>${items["price"]}</td>
                                        <td class="edit_item" onclick="editItem(${items['id']});">Изменить</td>
                                        <td class="delete_item" onclick="return confirmDelete(${items['id']})">Удалить</td></tr>`
                            })+`</table>`);
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
// qwe.item.map(function (items) { .
                            // return '<p>'+items['id']</p>
</script>