

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

	var loader = `<div class="cfaLoader">
		<svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
			<path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
			s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
			c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"></path>
			<path fill="#1e73be" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
			C22.32,8.481,24.301,9.057,26.013,10.047z">
			<animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.9s" repeatCount="indefinite"></animateTransform>
			</path>
		</svg>
	</div>`;

	$("#get_news_btn").on("click", function(e){
		e.preventDefault();
		
		let newsUrl = $("#cfa-news-url").val();
		let post_id = $("#cfa-post_id").val();

		if(validURL(newsUrl)){
			$.ajax({
				type: "post",
				url: newsajax.ajaxurl,
				data: {
					action: "url_to_cfa_news",
					nonce: newsajax.nonce,
					newsurl: newsUrl,
					post_id: post_id
				},
				beforeSend: function(){
					$('body').append(loader);
				},
				dataType: "json",
				success: function (response) {
					if(response.success){
						location.href = response.success;
					}
					if(response.error){
						$(document).find(".cfaLoader").remove();
						alert(response.error);
					}
				}
			});
		}
	});
});
