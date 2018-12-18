<!DOCTYPE html>
<html>
<head>
<title>Password check</title>
<script type="text/javascript">
	function crtpassword()
	{
var relativeUrl=document.getElementById("url").value;

    var password=document.getElementById("password").value;
   
    var crtid=document.getElementById("crtid").value;

    var crtidsession=document.getElementById("crtidsession").value;

    var cstid=document.getElementById("cstid").value;

var empid=document.getElementById("empid").value;

jQuery(document).ready(function(){
$.get("?r=site/crtsessionpermissiondb",{password:password,empid:empid,crtid:crtid,crtidsession:crtidsession,cstid:cstid},function(selecting)
            {

           if(selecting.trim() =='correct')
             {
            openPopupPage(relativeUrl, crtid,crtidsession,cstid,empid);
             //window.location.assign("index.php?r=site/quizcrtview&c="+crtid+"&cs="+crtidsession+"&cst="+cstid);
             }else
             {
           alert("incorret Password");
              }
            });
});

}
function openPopupPage(relativeUrl, crtid,crtidsession,cstid,empid)
	{
 var param = { 'id' : crtid, 'crtidsession': crtidsession, 'cstid': cstid, 'emp_id': empid };
 OpenWindowWithPost(relativeUrl, "width=1600, height=700, left=0, top=0, resizable=yes, margin=0 auto, scrollbars=yes", "NewFile", param);
 
}



function OpenWindowWithPost(url, windowoption, name, params)

{

 var form = document.createElement("form");

 form.setAttribute("method", "post");

 form.setAttribute("action", url);

 form.setAttribute("target", name);

 for (var i in params)

 {

   if (params.hasOwnProperty(i))

   {

     var input = document.createElement('input');

     input.type = 'hidden';

     input.name = i;

     input.value = params[i];

     form.appendChild(input);

   }

 }

 document.body.appendChild(form);

 //note I am using a post.htm page since I did not want to make double request to the page

 //it might have some Page_Load call which might screw things up.

 window.open("post.htm", name, windowoption);

 form.submit();

 document.body.removeChild(form);

}
 


</script>
</head>
<body>
<table align="center">
<tr>
<td>
<h3>Session Type password</h3>
</td>
</tr>
  <? $userid = @Yii::$app->user->identity->id ;
      $crtidsession=$_REQUEST['id'];
     $crtid= $_SESSION["crt"];
  ?>
   <tr>
   <td>
<?
$actual_link = "$_SERVER[REQUEST_URI]";
 $name=explode('/',$actual_link );
 $url="http://$_SERVER[HTTP_HOST]/".$name[1]."/quiz/crtquizview.php";
?>
<input type="hidden" name="url" id="url" value="<?=$url;?>"><br>
<input type="text" name="password" id="password"><br>
<input type="hidden" name="empid" id="empid" value="<?=$userid;?>">
<input type="hidden" name="crtidsession" id="crtidsession" value="<?=$_SESSION['crtidsession'];?>">
<input type="hidden" name="crtid" id="crtid" value="<?=$_SESSION['crtid'];?>"><br>
<input type="hidden" name="cstid" id="cstid" value="<?=$_REQUEST['id'];?>"><br>
   </td>
   </tr>
   <tr >
   <td>
   <input type="button" value="Verify" onclick="crtpassword();">
   </td>
   </tr>
</body>
</html>





