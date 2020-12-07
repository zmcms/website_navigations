$(document).ready(function(){
	var backend_prefix = $('meta[name="backend-prefix"]').attr('content');
	/**
	 *	OBSŁUGA ZARZĄDZANIA NAWIGACJAMI
	**/
	$("#zmcms_website_navigations_control_panel").on('click',"button[id^='zmcms_website_navigations_tab_']", function(e){
		alert('!!!');
		var str = $(this).attr('id'); 
		var res = str.slice(30);
		e.preventDefault();e.stopPropagation();
		var attr = document.getElementById('zmcms_website_navigations_tab_'+res);
		alert(attr.dataset.position);
 
 // "3"
// article.dataset.indexNumber // "12314"
// article.dataset.parent // "cars"
			// $.ajax({
				// type: 'GET',
				// url:  "/"+backend_prefix+"/zmcms_website_navigation_position_delete/"+$('#position_code_'+res).html(),
				// processData: false,
				// contentType: false,
				// success: function(data){
					// var resultset = JSON.parse(data);
					// $('#ajax_dialog_box').fadeIn( "slow", function() {});
					// $('#ajax_dialog_box_content').html('<div class="msg '+resultset.result+'">'+resultset.msg+'</div>');
					// $('#row_'+res).fadeOut( "slow", function() {});
				// },
				// statusCode: {
					// 500: function(xhr) {$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
					// 419: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
					// 404: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
					// 405: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
				// }
			// });
		return false;
	});
});