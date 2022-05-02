jQuery(function( $ ) {
	'use strict';

	$('#cfa_news_static_color').wpColorPicker();
	$('#cfa_news_static_text_color').wpColorPicker();
	$('#cfa_news_selected_color').wpColorPicker();
	$('#cfa_news_selected_text_color').wpColorPicker();
	$('#cfa_news_title_color').wpColorPicker();
	$('#cfa_news_date_color').wpColorPicker();
	$('#cfa_news_content_text_color').wpColorPicker();

	function validURL(str) {
		var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
		  '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
		  '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
		  '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
		  '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
		  '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
		return !!pattern.test(str);
	}

	$("#get_and_save_news").on("click", function(){
		let newsUrl = $("#cfa-news-url").val();
		let date = $("#cfa-news-date").val();

		if(validURL(newsUrl)){
			$.ajax({
				type: "post",
				url: newsajax.ajaxurl,
				data: {
					action: "url_to_cfa_news",
					nonce: newsajax.nonce,
					newsurl: newsUrl,
					date: date
				},
				beforeSend: function(){
					$(".cfa_news_Loader").addClass("active");
				},
				dataType: "json",
				success: function (response) {
					if(response.success){
						location.href = response.success;
					}
					if(response.error){
						$(".cfa_news_Loader").removeClass("active");
						alert(response.error);
					}
				}
			});
		}
	});

	$("#regenrate_nes").on("click", function(){
		let news_id = $(this).data("id");
		if(news_id !== ""){
			$.ajax({
				type: "post",
				url: newsajax.ajaxurl,
				data: {
					action: "regenrate_news",
					nonce: newsajax.nonce,
					news_id: news_id
				},
				beforeSend: function(){
					$(".cfa_news_Loader").addClass("active");
				},
				dataType: "json",
				success: function (response) {
					if(response.success){
						location.href = response.success;
					}
					if(response.error){
						$(".cfa_news_Loader").removeClass("active");
						alert(response.error);
					}
				}
			});
		}
	});

});
