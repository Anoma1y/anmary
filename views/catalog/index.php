<?php require_once "views/index/header.php"; ?>
<?php $price = array(); $i = 0; foreach ($priceList as $key) { $price[$i] = $key['price']; $i++; } $minPrice = min($price); $maxPrice = max($price); ?>;

<div class="catalog">
    <div class="container">
        <div class="catalog_filter">
            <div class="filter_search">
                <h3>Поиск:</h3>
                <input type="text" name="searchFilter_input" id="searchFilter_input" placeholder="Поиск...">
                <button id="searchFilterBtn"><i class="fa fa-search"></i></button>
            </div>
            <div class="filter_by">
                <h3>Параметры поиска:</h3>
                <div class="filter-category catalog-filter-block">
                    <input type="checkbox" class="filter-checkbox" id="tab-catalog-filter-category">
                    <label for="tab-catalog-filter-category" class="filter-label">Категории</label>
                    <div class="catalog-filter-panel">
                        <div class="catalog-filter-category-inpanel">
                            <?php foreach ($categoryList as $key => $value): ?>
                                <div class="filter-category-item">
                                    <div class="filter-category-item-input">
                                         <input type="checkbox" class="categoryList" name="categoryList" id="categoryList_<?=$value["id"];?>" value="<?=$value["id"];?>">
                                        <label for="categoryList_<?=$value["id"];?>"></label>                                       
                                    </div>
                                    <div class="filter-category-item-value">
                                         <span><?=$value["category_name"];?></span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>

                <div class="filter-brand catalog-filter-block">
                    <input type="checkbox" class="filter-checkbox" id="tab-catalog-filter-brand">
                    <label for="tab-catalog-filter-brand" class="filter-label">Бренды</label>
                    <div class="catalog-filter-panel">
                        <div class="catalog-filter-category-inpanel">
                            <?php foreach ($brandList as $key => $value): ?>
                                <div class="filter-category-item">
                                    <div class="filter-category-item-input">
                                         <input type="checkbox" class="brandList" name="brandList" id="brandList_<?=$value["id"];?>" value="<?=$value["id"];?>">
                                        <label for="brandList_<?=$value["id"];?>"></label>                                       
                                    </div>
                                    <div class="filter-category-item-value">
                                         <span><?=$value["brand_name"];?></span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>

                <div class="filter-season catalog-filter-block">
                    <input type="checkbox" class="filter-checkbox" id="tab-catalog-filter-season">
                    <label for="tab-catalog-filter-season" class="filter-label">Сезон</label>
                    <div class="catalog-filter-panel">
                        <div class="catalog-filter-category-inpanel">
                            <?php foreach ($seasonList as $key => $value): ?>
                                <div class="filter-category-item">
                                    <div class="filter-category-item-input">
                                         <input type="checkbox" class="seasonList" name="seasonList" id="seasonList_<?=$value["id"];?>" value="<?=$value["id"];?>">
                                        <label for="seasonList_<?=$value["id"];?>"></label>                                       
                                    </div>
                                    <div class="filter-category-item-value">
                                         <span><?=$value["season_name"];?></span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>


                <div class="filter-price catalog-filter-block">
                    <input type="checkbox" class="filter-checkbox" id="tab-catalog-filter-price">
                    <label for="tab-catalog-filter-price" class="filter-label">Цена</label>                  
                    <div class="catalog-filter-panel">
                        <div class="catalog-filter-price-inpanel">
                            <div class="filter-minmax-price">
                               <input type="text" value="<?=$minPrice?>" name="minPrice" id="minPrice"> 
                            </div>
                            <div class="filter-minmax-line">
                            </div>
                            <div class="filter-minmax-price">
                                <input type="text" value="<?=$maxPrice?>" name="maxPrice" id="maxPrice"> 
                            </div>                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="catalog-container">
            <div class="catalog-header">
                <div class="catalog-count_item">
                    Найдено товаров: <span id="countItems"></span>
                </div>
                <div class="catalog-sort">
                    <div class="catalog-sort-by">
                        <span>Сортировка: </span>
                        <select name="sortBy" id="sortBy">
                            <option value="sortByNewest">По новинкам</option>
                            <option value="sortBySales">По скидкам</option>
                            <option value="sortByPriceLower">По убыванию цены</option>
                            <option value="sortByPriceHigher">По возрастанию цены</option>
                        </select>
                    </div>
                    <div class="catalog-pagination">
                        <div class="paginations"></div>
                    </div>                    
                </div>
            </div>
            <div class="catalog-main">
                <div class="catalog-items-list">

                </div>
                <div class="main-pagination">
                    <div class="paginations"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="/static/js/libs.min.js"></script>
<script type="text/javascript" src="/static/js/catalog.js"></script>


<?php require_once "views/index/footer.php"; ?>