function addLikes(id,action,modname) {
	
	$('.demo-table #tutorial-'+id+' li').each(function(index) {
		$(this).addClass('selected');
		$('#tutorial-'+id+' #rating').val((index+1));
		if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
			return false;	
		}
	});
	$.ajax({
	url: "http://tuneem.com/tuneem/web/sms/add_likes.php",
	data:'id='+id+'&action='+action+'&modname='+modname,
	type: "POST",
	beforeSend: function(){
		$('#tutorial-'+id+' .btn-likes').html("<img src='LoaderIcon.gif' />");
	},
	success: function(data){
	var likes = parseInt($('#likes-'+id).val());
	switch(action) {
		case "like":
		$('#tutorial-'+id+' .btn-likes').html('<input type="button" title="Unlike" class="unlike" onClick="addLikes('+id+',\'unlike\')" />');
		likes = likes+1;
		break;
		case "unlike":
		$('#tutorial-'+id+' .btn-likes').html('<input type="button" title="Like" class="like"  onClick="addLikes('+id+',\'like\')" />')
		likes = likes-1;
		break;
	}
	$('#likes-'+id).val(likes);
//	alert(likes)
	if(likes>0) {
		$('#tutorial-'+id+' .label-likes').html(likes+" Like(s)");
	} else {
		$('#tutorial-'+id+' .label-likes').html(likes+" Like(s)");
	}
	
	}
	});
}
