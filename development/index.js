const cfanews = new Vue({
    el: '#cfa_news',
    data: {
        isDisabled: true,
        cfaNewsObj: [],
		currentFilter: '',
		currentPage: 1,
		numrows: 0
    },
    methods: {
		news_year_filter: function(event, year){
			cfanews.currentPage = 1;
            cfanews.currentFilter = year;

            jQuery.ajax({
				type: "get",
				url: cfa_news_ajax.ajaxurl,
				data: {
					action: "get_news_data",
					nonce: cfa_news_ajax.nonce,
					filter: cfanews.currentFilter
				},
				beforeSend: function(){
					cfanews.isDisabled = true;
				},
				dataType: "json",
				success: function (response) {
					cfanews.isDisabled = false;
					
					if (response.success) {
						cfanews.cfaNewsObj = response.success;
					}

                    if (response.numrows) {
						cfanews.numrows = response.numrows;
					}

					jQuery(document).find('.years_btns .cfaActive').removeClass('cfaActive');
					jQuery(event.target).addClass('cfaActive');
				}
			});
		},

		loadmore_news: function(){
			jQuery.ajax({
				type: "get",
				url: cfa_news_ajax.ajaxurl,
				data: {
					action: "get_news_data",
					nonce: cfa_news_ajax.nonce,
					filter: cfanews.currentFilter,
					page: (cfanews.currentPage+1)
				},
				beforeSend: function(){
					cfanews.isDisabled = true;
				},
				dataType: "json",
				success: function (response) {
					cfanews.isDisabled = false;
					if (response.success) {
						if(response.success.length > 0){
							response.success.forEach(element => {
								cfanews.cfaNewsObj.push(element);
							});
							cfanews.currentPage +=1;
						}
					}
					if (response.numrows) {
						cfanews.numrows = response.numrows;
					}
				}
			});
		}
    },
    mounted: function () {

		let cfaNews = new Promise((resolve, reject) => {
			jQuery.ajax({
				type: "get",
				url: cfa_news_ajax.ajaxurl,
				data: {
					action: "get_news_data",
					nonce: cfa_news_ajax.nonce
				},
				dataType: "json",
				success: function (response) {
					resolve(response);
				}
			});
		});

		cfaNews.then(response => {
			cfanews.isDisabled = false;
            if (response.success) {
                cfanews.cfaNewsObj = response.success;
				cfanews.currentPage = cfanews.cfaNewsObj.length;
            }
            if (response.numrows) {
                cfanews.numrows = response.numrows;
            }
		});
	}
});