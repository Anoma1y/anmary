'use strict';
const newsList = document.getElementById('news-list');


function init(page) {
	try {
		$.ajax({
			url: '../news/getNews',
			data: { 
				page: page 
			},
			type: 'POST'
		})
		.done(function(data) {
			var items = JSON.parse(data);
			$('#news-list').html("");
			for (let item of items["item"]) {
				$('#news-list').append(`
					<article class="news-item">
						<div class="news-item-image">
							<img src="${item['news_image']}" alt="News-${item['id']}">
						</div>
						<div class="news-item-content">
							<div class="news-title">
								<h2>${item['news_title']}</h2>
							</div>
							<div class="news-text">
								<p>${item['news_text']}</p>
							</div>
							<div class="news-date">
								<span>${item['news_date']}</span>
							</div>
						</div>
					</article>
				`);
			}
			//Всего записей
	   		var total_items = items['total_item'];
	        //Записей на странице
	        var item_on_page = items['record_per_page'];
	        //Установка новой текущей страницы
	        var currentPage = items['current_page'];

	        $('.paginations').pagination({
	            items: total_items,
	            itemsOnPage: item_on_page,
	            cssStyle: 'dark-theme',
	            prevText: '',
	            nextText: '',
	            hrefTextPrefix: '',
	            currentPage: currentPage,
	            onPageClick: (pageNumber) => {
	            	
	                setTimeout(() => { init(pageNumber); },500);
	            }
	        });		
		})	
		.fail(function() {
			throw new Error();
		})		
	} catch(e) {
		$('#news-list').append(`<h1>Ошибка при загрузке</h1>`);
		console.log(e);
	}

}

init(1);