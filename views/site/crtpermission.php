<!DOCTYPE html>
<html>
<head>
<title>Password check</title>
<script type="text/javascript">
	function crtpassword()
	{
		var password=document.getElementById("password").value;
    var empid=document.getElementById("empid").value;
    var crtid=document.getElementById("crtid").value;
    var crtidsession=document.getElementById("crtidsession").value;

jQuery(document).ready(function(){
$.get("?r=site/crtpermissiondb",{password:password,empid:empid,crtid:crtid,crtidsession:crtidsession},function(selecting)
            {

           if(selecting.trim() =='correct')
             {
            
             window.location.assign("index.php?r=crt-session-type-pass-listview&crtid="+crtid+"&crtidsession="+crtidsession);
             }else
             {
           alert("incorret Password");
              }
            });
});

}

</script>
</head>
<body>
<table align="center">
<tr>
<td>
<h3>Session password</h3>
</td>
</tr>
  <? $userid = @Yii::$app->user->identity->id ;
      $crtidsession=$_REQUEST['id'];
     $crtid= $_SESSION["crt"];
  ?>
   <tr>
   <td>
 
<input type="text" name="password" id="password"><br>
<input type="hidden" name="empid" id="empid" value="<?=$userid;?>">
<input type="hidden" name="crtidsession" id="crtidsession" value="<?=$crtidsession;?>">
<input type="hidden" name="crtid" id="crtid" value="<?=$crtid;?>"><br>
   </td>
   </tr>
   <tr >
   <td>
   <input type="button" value="Verify" onclick="crtpassword();">
   </td>
   </tr>
</body>
</html>





