function showEditBox(id) {
	//alert(id);
	$('#frmAdd').hide();
	$('#ed').hide();
	//var currentMessage = $("#message_" + id + " .message-content").html();
	
	var currentMessage = $("#message_" + id + ".cmd").html();
	//alert(currentMessage);
	var editMarkUp = '<br/><br/><textarea rows="1" cols="65" id="txtmessage_'+id+'">'+currentMessage+'</textarea><button name="ok" style="background-color:#2fc332;" onClick="callCrudAction(\'edit\','+id+')"><span style="color:#fff">Save</span></button><button name="cancel"  style="background-color:red;" onClick="cancelEdit(\''+currentMessage+'\','+id+')"><span style="color:#fff">Cancel</span></button>';
	//alert(editMarkUp);
	$("#message_" + id + ".cmd").html(editMarkUp);
}
function cancelEdit(message,id) {
	$("#message_" + id + " .cmd").html(message);
	$('#frmAdd').show();
	$('#ed').show();
}
function callCrudAction(action,id,t_id,txt,modname) {
	//alert(t_id);
	$("#loaderIcon").show();
	var queryString;
	switch(action) {
		
		case "add":
		//alert($("#txtmessage"+txt+"").val());
			queryString = 'action='+action+'&t_id='+t_id+'&txtmessage='+ $("#txtmessage"+txt+"").val()+'&txt='+txt+'&modname='+modname;
		break;
		case "edit":
			queryString = 'action='+action+'&message_id='+ id + '&txtmessage='+ $("#txtmessage_"+id).val();
		break;
		case "delete":
			queryString = 'action='+action+'&message_id='+ id;
		break;
	}	 
	jQuery.ajax({
	url: "http://www.tuneem.com/tuneem/web/sms/crudo_action.php",
	data:queryString,
	type: "POST",
	success:function(data){
		//alert(data);
		switch(action) {
			case "add":
		//	alert(t_id);
				$("#cc_" +t_id).html(data);
			$('#txtmessage'+txt).val('');
			break;
			case "edit":
				$("#message_" + id + ".cmd").html(data);
				$('#frmAdd').show();
				$('#ed').show();
			break;
			case "delete":
				$('#message_'+id).fadeOut();
			break;
			case "like":
		$('#tutorial-'+id+' .btn-likes').html('<input type="button" title="Unlike" class="unlike" onClick="addLikes('+id+',\'unlike\')" />');
		likes = likes+1;
		break;
		case "unlike":
		$('#tutorial-'+id+' .btn-likes').html('<input type="button" title="Like" class="like"  onClick="addLikes('+id+',\'like\')" />')
		likes = likes-1;
		break;
		}
		$("#txtmessage").val('');
		$("#loaderIcon").hide();
	},
	error:function (){}
	});
}
