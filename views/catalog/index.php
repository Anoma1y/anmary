

                    <div class="col-md-9">
                        <div class="shop-item-filter">
                        <div class="clearfix"></div> 
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="grid">
                                <div class="row">

								<div id="list_product">
									
								</div>
							 </div>
                            </div>
                         </div>   
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pagination-content">
                                    <div class="pagination-button">
										<div class="paginations"></div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>


<script src="/static/js/libs.min.js"></script>
<script type="text/javascript">
    //Получение максимальной цены товара из каталога
    var maxPrice = <?php $maxPrice = array(); $i = 0; foreach ($productList as $key) { $maxPrice[$i] = $key['price']; $i++; } echo json_encode(max($maxPrice)); ?>; 
</script>
<script src="/static/js/catalog.js"></script>
