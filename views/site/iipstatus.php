<?php 
session_start();
require_once "db.php";
$iid = $_REQUEST['iid'];
$log = Yii::$app->user->identity->id;
?>
<!DOCTYPE html>
<html>
    <head>
    <style type="text/css">
    .ta{
     width:100%;    
     border:none;
    }
    th,td{
     padding:10px;    
     border:2px solid darkgray;
    }
    th{
		background-color:#2791e3;
		width:25%;    
		/*border-radius: 8px;*/
		box-shadow: -3px 4px 12px #000;
		border:none;
    }
    td{
		background-color:#bed5e5;
		width:75%;   
		/*border-radius: 8px; */
		box-shadow: 4px 3px 8px #000;
		border:none;
    }
    
    table tbody tr:last-child td,
	 table tbody tr:first-child:last-child td{
    background:#0059aa;
     width:100%;    
    /*border-radius: 8px;*/
    box-shadow: none;
    }​
    </style>
    <script type="text/javascript">
	function ad(h) {
   	 h.style.height = "47px";
    	 h.style.height = (h.scrollHeight)+"px";
		}
</script>
        <meta content="text/html; charset=utf-8" http-equiv="content-type">
        	<link href='rating.css' rel='stylesheet' type='text/css'/>
		<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<script type="text/javascript">
		$(document).ready(function(){					
$('#submitbtn1').click(function(e){
	var comm=document.getElementById("comm").value;	
	var iid=<?php echo $iid; ?>;
	var logid=<?php echo $log; ?>;
				$.ajax({
					url:'add_ratingiip.php',
	data:'qid='+iid+'&comm='+comm+'&logid='+logid,
					success:function(){													
						 window.location.href = "";					
					}
				});
			});
$('#rating_panel>img').click(function(e){	
	var logid=<?php echo $log; ?>;	
				var imgindex	=	$(this).index() + 1;
				var ratingpanel	=	$(this).closest('div');
				var pollid		=	ratingpanel.attr('data-pollid');
				var israted		=	ratingpanel.attr('data-rated');
				var quid		=	ratingpanel.attr('quid');
				if(israted == 1){
					alert('You have already voted!');
					return false;
				}else{
					ratingpanel.attr('data-rated',1);
									
				}
				$('#starloader').show();
				for( i=0;i<imgindex; i++){
					var imgobj = $("#rating_panel>img:eq( "+i+" )" );
					var img = 'images/full.png';
					imgobj.attr('src',img);
					
				}						
				$.ajax({
					url:'add_ratingiip.php',
					data:'rate='+imgindex+'&qid='+quid+'&logid='+logid,
					success:function(){						
														
					$('#starloader').hide();
					}
				});		
			
								
			});


		});		
		
	
		</script>



		<script>calling();

		</script>

		<?php
if(!empty($iid) ){ 
$all_sql1 = "SELECT title,type_name,module_name,score,code FROM  Performance_employee_details a,modules b,improvement_type c where e_id='".$iid."' and a.module=b.id and a.type_improvement=c.type_id";
$all_res2 = mysql_query($all_sql1);
$all_nrw2= mysql_num_rows($all_res2);
while($all_row2 = mysql_fetch_array($all_res2))
{ 	

	?>

<table border="1" align="left" class="ta">
<tr>
<th> Area of Improvement</th><td><?php echo $all_row2['title']; ?></td></tr>
<tr><th>Type of Improvement</th><td><?php echo $all_row2['type_name']; ?></td></tr>
<tr><th>Delivery Mode</th><td><?php echo $all_row2['module_name']; ?></td></tr>
<tr><th>Employee Marks</th><td><?php echo $all_row2['score']; ?></td></tr>
<tr><th>Rating</th><td><?php echo '<div id="rating_panel" data-pollid="1" data-rated="0" quid='.$iid.'>
			<img src="images/zero.png" /> <img src="images/zero.png" /> <img src="images/zero.png" /> <img src="images/zero.png" /> <img src="images/zero.png" /><div id="starloader"></div>
				</div>'; ?></td></tr>
<tr><th>Comments</th>
<td>
		<!--<input type="text" id="comm"></td>-->
		<textarea name="field4" onkeyup="ad(this)" id="comm" style="width:100%;"></textarea>
</tr>
<tr></tr>
<tr> <td colspan="2"><center><input type="button" class="btn btn-danger" id="submitbtn1" name="submit" value="Submit"></center></td></tr>
</table>


<?php
}

 
}
		?>

<body>

    </body>
</html>