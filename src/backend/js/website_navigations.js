
$(document).ready(function(){
	var backend_prefix = $('meta[name="backend-prefix"]').attr('content');
	$("#btn_zwnp button").on('click', function(e){
		location.href = "/"+backend_prefix+"/website/navigations/zmcms_website_navigations_positions";
		return false;
	});
});