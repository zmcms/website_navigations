$(document).ready(function(){
	var backend_prefix = $('meta[name="backend-prefix"]').attr('content');
	/**
	 *	OBSŁUGA ZARZĄDZANIA NAWIGACJAMI
	**/
	$("#zmcms_website_navigations_control_panel").on('click',"button[id^='zmcms_website_navigations_tab_']", function(e){
		// alert('!!!');
		var str = $(this).attr('id'); 
		var res = str.slice(30);
		e.preventDefault();e.stopPropagation();
		var attr = document.getElementById('zmcms_website_navigations_tab_'+res);
			$.ajax({
				type: 'GET',
				url:  "/"+backend_prefix+"/zmcms_website_navigation_get_navigation/"+attr.dataset.position,
				processData: false,
				contentType: false,
				success: function(data){
					$('#zmcms_website_navigations_control_panel_content').html(data);
				},
				statusCode: {
					500: function(xhr) {$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
					419: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
					404: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
					405: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
				}
			});
		attr.classList.add("selected");
		$(this).siblings('button').removeClass('selected');
		return false;
	});
	$("#btn_positions_list").on('click', function(e){
		location.href = "/"+backend_prefix+"/website/navigations/zmcms_website_navigations_positions";
		return false;
	});
	
	$('#btn_positions_new').on('click', function(e){
		e.preventDefault();e.stopPropagation();
		$.ajax({
				type: 'GET',
				url:  "/"+backend_prefix+"/zmcms_website_navigation_position_new_frm",
				processData: false,
				contentType: false,
				success: function(data){
					$('#ajax_dialog_box').fadeIn( "slow", function() {});
					$('#ajax_dialog_box_content').html(data);
				},
				statusCode: {
					500: function(xhr) {$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
					419: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
					404: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
					405: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
				}
			});
	});
	// 
	$('#btn_navigations_new_link').on('click', function(e){
		e.preventDefault();e.stopPropagation();
		attr_value = $('#zmcms_website_navigations_control_panel .selected').attr('data-position');
		if(attr_value!=null){
			location.href = "/"+backend_prefix+"/website/navigations/create_link/"+attr_value;
			return false;
		}else{
			$('#ajax_dialog_box').fadeIn( "slow", function() {});
			$('#ajax_dialog_box_content').html('<div class="msg error">Musisz wybrać pozycję, do której chcesz dodać link nawigacyjny.</div>');
		}
	});

	$("#zmcms_website_navigations_control_panel_content").on('click', "a[id^='navigation_new_link_']", function(e){
		e.preventDefault();e.stopPropagation();
		var o = $(this).attr('id'); 
		var res = o.slice(20);
		var d = document.getElementById(o);
		attr_value = $('#zmcms_website_navigations_control_panel .selected').attr('data-position');
		$('#zmcms_website_navigations_control_panel .selected').attr('data-position');
		if(attr_value!=null){
			location.href = "/"+backend_prefix+"/website/navigations/create_link/"+attr_value+'/'+d.dataset.token;
			return false;
		}else{
			$('#ajax_dialog_box').fadeIn( "slow", function() {});
			$('#ajax_dialog_box_content').html('<div class="msg error">Musisz wybrać pozycję, do której chcesz dodać link nawigacyjny.</div>');
		}
		return false;
	});

	$('#zmcms_website_navigations_control_panel_content').on('click', "a[id^='navigation_edit_']", function(e){
		e.preventDefault();e.stopPropagation();
		var o = $(this).attr('id'); 
		var d = document.getElementById(o);
		location.href = "/"+backend_prefix+"/website/navigations/zmcms_website_navigations_edit/"+d.dataset.token;
	});
	
	
	$('#zmcms_website_navigations_control_panel_content').on('click', "a[id^='navigation_del_']", function(e){
		e.preventDefault();e.stopPropagation();
		var o = $(this).attr('id'); 
		var res = o.slice(15);
		var d = document.getElementById(o);
		$('#ajax_dialog_box').fadeIn( "slow", function() {});
		$('#ajax_dialog_box_content').html('<div class="msg ok"><div class="loader"></div></div>');
		$.ajax({
				type: 'GET',
				url:  "/"+backend_prefix+"/website/navigations/zmcms_website_navigations_delete/"+d.dataset.token,
				processData: false,
				contentType: false,
				success: function(data){
					var x = JSON.parse(data);
					$('#ajax_dialog_box_content').html('<div class="msg '+x.result+'">'+x.msg+'</div>');
					if(x.result == 'ok')$('#'+o).fadeOut( "slow", function() {});
				},
				statusCode: {
					500: function(xhr) {$('#ajax_dialog_box_content .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
					419: function(xhr){$('#ajax_dialog_box_content .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
					404: function(xhr){$('#ajax_dialog_box_content .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
					405: function(xhr){$('#ajax_dialog_box_content .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
				}
			});
		return false;
	});
	/**
	 * Przycisk ładowania ilustracji do linku nawigacji
	 **/
	 $("button[id^='zcwn_btn_update_']").on('click', function(e){
			e.preventDefault();e.stopPropagation();
			var o = $(this).attr('id'); 
			var d = document.getElementById(o);
			$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
			$('#ajax_dialog_box').fadeIn( "slow", function() {});
			$('#ajax_dialog_box_content').html('<iframe  width="'+(0.90*$(window).width())+'px" height="'+(0.85*$(window.top).height())+'px" frameborder="0" '+
					'src="/themes/zmcms/backend/js/filemanager/dialog.php?type=0&field_id='+d.dataset.selectfld+'&relative_url=0&multiple=false&callback=ccc"'+
					'></iframe>');
			return false;
		
	});	
	 $('#zcwn_btn_icon_fld').on('save', function(e){
	 	// alert($(this).val());
	 });

});
	 function ccc(field_id){
	 	$('#'+field_id).trigger('save');
	 	$('#ajax_dialog_box_content').html('');
	 	$('#ajax_dialog_box').fadeOut( "slow", function() {});

	 }