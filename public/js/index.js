const cfanews=new Vue({el:"#cfa_news",data:{isDisabled:!0,cfaNewsObj:[],currentFilter:"",currentPage:1,numrows:0,storeLines:[]},methods:{news_year_filter:function(a,e){cfanews.currentPage=1,cfanews.currentFilter=e,cfanews.storeLines=[],jQuery.ajax({type:"get",url:cfa_news_ajax.ajaxurl,data:{action:"get_news_data",nonce:cfa_news_ajax.nonce,category:cfa_news_ajax.category,filter:cfanews.currentFilter},beforeSend:function(){cfanews.isDisabled=!0},dataType:"json",success:function(e){cfanews.isDisabled=!1,e.success&&(cfanews.cfaNewsObj=e.success),e.numrows&&(cfanews.numrows=e.numrows),jQuery(document).find(".years_btns .cfaActive").removeClass("cfaActive"),jQuery(a.target).addClass("cfaActive"),cfanews.cfaNewsObj.map(e=>{cfanews.storeLines.includes(e.date_line)||(cfanews.storeLines.push(e.date_line),e.line=e.date_line)})}})},loadmore_news:function(){jQuery.ajax({type:"get",url:cfa_news_ajax.ajaxurl,data:{action:"get_news_data",nonce:cfa_news_ajax.nonce,category:cfa_news_ajax.category,filter:cfanews.currentFilter,page:cfanews.currentPage+1},beforeSend:function(){cfanews.isDisabled=!0},dataType:"json",success:function(e){cfanews.isDisabled=!1,e.success&&0<e.success.length&&(e.success.forEach(e=>{cfanews.cfaNewsObj.push(e)}),cfanews.currentPage+=1),e.numrows&&(cfanews.numrows=e.numrows),cfanews.cfaNewsObj.map(e=>{cfanews.storeLines.includes(e.date_line)||(cfanews.storeLines.push(e.date_line),e.line=e.date_line)})}})}},updated:function(){},mounted:function(){let e=new Promise((a,e)=>{jQuery.ajax({type:"get",url:cfa_news_ajax.ajaxurl,data:{action:"get_news_data",nonce:cfa_news_ajax.nonce,category:cfa_news_ajax.category},dataType:"json",success:function(e){a(e)}})});e.then(e=>{cfanews.isDisabled=!1,e.success&&(cfanews.cfaNewsObj=e.success),e.numrows&&(cfanews.numrows=e.numrows),cfanews.cfaNewsObj.map(e=>{cfanews.storeLines.includes(e.date_line)||(cfanews.storeLines.push(e.date_line),e.line=e.date_line)})})}});