'use strict';
const newsList = document.getElementById('news-list');
// window.onload = init;


// function init() {
		$.ajax({
			url: '../news/getNews',
			type: 'GET',
			success: function(data) {
				var items = JSON.parse(data);
				console.log(items);				
			}
		})
		// .done(function(data) {

			// let total_items = 50;
			// let item_on_page = 10;
			// let currentPage = 1;
   //          $('.paginations').pagination({
   //              items: total_items,
   //              itemsOnPage: item_on_page,
   //              cssStyle: 'dark-theme',
   //              prevText: '',
   //              nextText: '',
   //              hrefTextPrefix: '',
   //              currentPage: currentPage,
   //              onPageClick: (pageNumber) => {
   //                  setTimeout(() => { init(currentPage); },500);
   //             }
   //          });			
		// })
		// .fail(function() {
		// 	console.log("error");
		// })


// }