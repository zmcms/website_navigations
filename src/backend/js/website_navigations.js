$(document).ready(function(){
	var backend_prefix = $('meta[name="backend-prefix"]').attr('content');
	/**
	 *	OTWIERA LISTĘ POZYCJI, W KTÓRYCH WYŚWIETLA SIĘ NAWIGACJA SERWISU INTERNETOWEGO
	**/
	$("#btn_zwnp").on('click', function(e){
		location.href = "/"+backend_prefix+"/website/navigations/zmcms_website_navigations_positions";
		return false;
	});
	/**
	 *	USUWA WYBRANĄ POZYCJĘ NAWIGACJI Z BAZY DANYCH.
	**/
	$("#positions_list .content").on('click',"a[id^='position_del_']", function(e){
		var str = $(this).attr('id'); 
		var res = str.slice(13);
		e.preventDefault();e.stopPropagation();
		if(confirm( 'Usunąć pozycję "'+$('#position_name_'+res).html()+'"?' )){
			$.ajax({
				type: 'GET',
				url:  "/"+backend_prefix+"/zmcms_website_navigation_position_delete/"+$('#position_code_'+res).html(),
				processData: false,
				contentType: false,
				success: function(data){
					var resultset = JSON.parse(data);
					$('#ajax_dialog_box').fadeIn( "slow", function() {});
					$('#ajax_dialog_box_content').html('<div class="msg '+resultset.result+'">'+resultset.msg+'</div>');
					$('#row_'+res).fadeOut( "slow", function() {});
				},
				statusCode: {
					500: function(xhr) {$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
					419: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
					404: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
					405: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
				}
			});
		}
		return false;
	});
	$('#position_new').on('click', function(e){
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
	
 
/**	
 * WYWOŁANIE ZAPISU DO BAZY DANYCH NOWEJ POZYCJI NAWIGACJI
**/

$('#ajax_dialog_box_content').on('click', "#zmcms_website_navigation_position_new_frm #btn_save", function(e){
	e.preventDefault();e.stopPropagation();
	
		$.ajax({
			type: 'POST',
				url: "/"+backend_prefix+"/zmcms_website_navigation_position_save",
				data: new FormData(document.getElementById('zmcms_website_navigation_position_new_frm')),
				processData: false,
				contentType: false,
				success: function(data){
					var d = JSON.parse(data);
					if(d.result == 'ok')
						$('#zmcms_website_navigation_position_new_frm .msg').html('<div class="msg '+d.result+'">'+d.msg+'</div>');
					else
						$('#zmcms_website_navigation_position_new_frm .msg').html('<div class="msg '+d.result+'">(kod: '+d.code+') '+d.msg+'</div>');
				},
				statusCode: {
					500: function(xhr) {$('#zmcms_website_navigation_position_new_frm .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
					419: function(xhr){$('#zmcms_website_navigation_position_new_frm .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
					404: function(xhr){$('#zmcms_website_navigation_position_new_frm .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
					405: function(xhr){$('#zmcms_website_navigation_position_new_frm .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
				}
		}).done(function() {
		  	$.ajax({
				type: 'GET',
				url:  "/"+backend_prefix+"/zmcms_website_navigation_positions_refresh",
				processData: false,
				contentType: false,
				success: function(data){
					$('#positions_list .content').html('');
					$('#positions_list .content').html(data);
				},
				statusCode: {
					500: function(xhr) {$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
					419: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
					404: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
					405: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
				}
			});
		});
		return false;
	});
	/**
	 * EDYCJA WYBRANEJ POZYCJI NAZWIGACJI
	 */
	$("#positions_list .content").on('click',"a[id^='position_edit_']", function(e){
		var str = $(this).attr('id'); 
		var res = str.slice(14);
		e.preventDefault();e.stopPropagation();
			$.ajax({
				type: 'GET',
				url:  "/"+backend_prefix+"/zmcms_website_navigation_position_edit_frm/"+$('#position_code_'+res).html(),
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
		return false;
	});
	/**
	 * OTWIERA FORMULARZ DO ZARZĄDZANIA RODZAJAMI NAWIGACJI
	 */
	$("#btn_zwnrn").on('click', function(e){
		location.href = "/"+backend_prefix+"/website/navigations/zmcms_website_navigations_types";
		return false;
	});
	
	/**
	 * OTWIERA FORMULARZ DO DODAWANIA NOWEGO TYPU NAWIGACJI
	 */
	$("#wntbtnnew").on('click', function(e){
		e.preventDefault();e.stopPropagation();
			$.ajax({
				type: 'GET',
				url:  "/"+backend_prefix+"/zmcms_website_navigation_type_new_frm",
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
		return false;
	});
	/**
	 * ZAPISANIE NOWEGO RODZAJU NAWIGACJI
	 **/
	 
	 $('#ajax_dialog_box_content').on('click', "#zmcms_website_navigation_type_new_frm #btn_save", function(e){
	e.preventDefault();e.stopPropagation();
	
		$.ajax({
			type: 'POST',
				url: "/"+backend_prefix+"/zmcms_website_navigation_type_save",
				data: new FormData(document.getElementById('zmcms_website_navigation_type_new_frm')),
				processData: false,
				contentType: false,
				success: function(data){
					var d = JSON.parse(data);
					if(d.result == 'ok')
						$('#zmcms_website_navigation_type_new_frm .msg').html('<div class="msg '+d.result+'">'+d.msg+'</div>');
					else
						$('#zmcms_website_navigation_type_new_frm .msg').html('<div class="msg '+d.result+'">(kod: '+d.code+') '+d.msg+'</div>');
				},
				statusCode: {
					500: function(xhr) {$('#zmcms_website_navigation_type_new_frm .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
					419: function(xhr){$('#zmcms_website_navigation_type_new_frm .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
					404: function(xhr){$('#zmcms_website_navigation_type_new_frm .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
					405: function(xhr){$('#zmcms_website_navigation_type_new_frm .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
				}
		});

		// .done(function() {
		  	// $.ajax({
				// type: 'GET',
				// url:  "/"+backend_prefix+"/zmcms_website_navigations_types_refresh",
				// processData: false,
				// contentType: false,
				// success: function(data){
					// $('#types_list .content').html('');
					// $('#types_list .content').html(data);
				// },
				// statusCode: {
					// 500: function(xhr) {$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
					// 419: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
					// 404: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
					// 405: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
				// }
			// });
		// });
		return false;
	});

	/**
	 *	USUWA WYBRANY RODZAJ NAWIGACJI Z PLIKU KONFIGURACYJNEGO.
	**/
	$("#types_list .content").on('click',"a[id^='type_del_']", function(e){
		var str = $(this).attr('id'); 
		var res = str.slice(9);
		e.preventDefault();e.stopPropagation();
		if(confirm( 'Usunąć rodzaj nawigacji "'+$('#type_name_'+res).html()+'"?' )){
			$.ajax({
				type: 'GET',
				url:  "/"+backend_prefix+"/zmcms_website_navigation_type_delete/"+$('#type_code_'+res).html(),
				processData: false,
				contentType: false,
				success: function(data){
					var resultset = JSON.parse(data);
					$('#ajax_dialog_box').fadeIn( "slow", function() {});
					$('#ajax_dialog_box_content').html('<div class="msg '+resultset.result+'">'+resultset.msg+'</div>');
					$('#row_'+res).fadeOut( "slow", function() {});
				},
				statusCode: {
					500: function(xhr) {$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
					419: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
					404: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
					405: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
				}
			});
		}
		return false;
	});


	/**
	 *	OTWIERA FORMULARZ DO AKTUALIZACJI WYBRANEJ POZYCJI NAWIGACJI W PLIKU KONFIGURACYJNYM.
	**/	
	$("#types_list .content").on('click',"a[id^='type_edit_']", function(e){
		var str = $(this).attr('id'); 
		var res = str.slice(10);
		// alert()
		e.preventDefault();e.stopPropagation();
			$.ajax({
				type: 'GET',
				url:  "/"+backend_prefix+"/zmcms_website_navigation_type_update_frm/"+$('#type_code_'+res).html(),
				processData: false,
				contentType: false,
				success: function(data){
					$('#ajax_dialog_box').fadeIn( "slow", function() {});
					$('#ajax_dialog_box_content').html(data);
					// $('#row_'+res).fadeOut( "slow", function() {});
				},
				statusCode: {
					500: function(xhr) {$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
					419: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
					404: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
					405: function(xhr){$('#zmcms_main_frm_contact_data .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
				}
			});
		return false;
	});
	/**
	 * OTWIERA PANEL ZARZĄDANIA NAWIGACJĄ W SERWISIE WWW
	 **/
	$("#btn_zwnl").on('click', function(e){
		location.href = "/"+backend_prefix+"/website/navigations/zmcms_website_navigations_panel";
		return false;
	});
	/**
	 * ZAPISANIE DANYCH FORMUALRZA DO DODAWANIA NOWEJ NAWIGACJI
	 **/
	
	$("#zmcms_website_navigation_create_link_frm #btn_save").on('click', function(e){
		e.preventDefault();e.stopPropagation();
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		$('#ajax_dialog_box').fadeIn( "slow", function() {});
		$('#ajax_dialog_box_content').html('<div class="msg ok"><div class="loader"></div></div>');
		tinymce.triggerSave();
		// alert('ok');
		$.ajax({
			type: 'POST',
			url:  "/"+backend_prefix+"/zmcms_website_navigations_create_link",
			data: new FormData(document.getElementById('zmcms_website_navigation_create_link_frm')),
			processData: false,
			contentType: false,
			success: function(data){
				// d=JSON.parse(data);
				// $('#ajax_dialog_box_content').html('<div class="msg '+d.result+'">'+d.msg+'<br>'+d.code+'</div>');
				$('#ajax_dialog_box_content').html('<div class="msg ok"><pre>'+data+'</pre></div>');
			},
			statusCode: {
				500: function(xhr) {$('#contact_data_create_new_department_frm .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');},
				419: function(xhr){$('#contact_data_create_new_department_frm .msg').html('<div class="msg error"><pre>'+xhr.responseText+'</pre></div>');},
				404: function(xhr){$('#contact_data_create_new_department_frm .msg').html('<div class="msg error">Nie znaleziono skryptu</div>');},
				405: function(xhr){$('#contact_data_create_new_department_frm .msg').html('<div class="msg error">'+xhr.status+'<br>'+xhr.responseText+'</div>');}
			}
		});
	});
});