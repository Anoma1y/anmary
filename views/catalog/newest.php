<?php require_once 'views/index/header.php'; ?>

    <div class="catalog">
        <div class="container without-container">
            <div class="catalog-container without-catalog-container">
                <div class="catalog-header">
                    <div class="catalog-count_item">
                        <span id="countItems"></span>
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

    <?php require_once 'views/index/footer.php'; ?>
    <script type="text/javascript" src="/static/js/catalog.js"></script>
    <script type="text/javascript">
        var catalog = new Catalog("getAllProductNewest", "POST");
        var filter = new Filter(catalog);
        if (catalog != undefined && filter != undefined) {
            filter.init();
            catalog.init(filter.state);         
        }
    </script>
