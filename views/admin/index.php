<link rel="stylesheet" href="/static/css/simplePagination.css">
<link rel="stylesheet" href="/static/css/admin.min.css">
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>
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
      <table id="table">
        <thead>
        <tr>
          <th class="sortingProduct" id="productIdTh">id</th>
          <th class="sortingProduct" id="productTitleTh">Название</th>
          <th class="sortingProduct" id="productArticleTh">Артикль</th>
          <th class="sortingProduct" id="productBrandTh">Бренд</th>
          <th class="sortingProduct" id="productCategoryTh">Категория</th>
          <th class="sortingProduct" id="productSeasonTh">Сезон</th>
          <th>Размер</th>
          <th>Цвет</th>
          <th>Состав</th>
          <th>Цена</th>
          <th>Цена со скидкой</th>
          <th>Процент скидки</th>
          <th class="sortingProduct" id="productAvailabilityTh">Наличие</th>
          <th class="sortingProduct" id="productIsSaleTh">Скидка</th>
          <th></th>
          <th></th>
        </tr>
        </thead>
        <tbody id="tbody">
          
        </tbody>
      </table>
    </div> 
    <div class="paginations">
    
    </div> 
</div>

<!-- <script src="/static/js/libs.min.js"></script> -->
<script src="/static/js/adminMain.js"></script>
