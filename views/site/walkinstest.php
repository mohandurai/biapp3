<?
require_once "db.php";
    $uid=$_REQUEST["eid"];	
    $cid=$_REQUEST["cid"];	
    $comm=$_REQUEST["comm"];	
    $category=$_REQUEST["cate"];	
  $infocnt1 = Yii::$app->db->createCommand('SELECT status FROM crt_participant where crt_id="'.$cid.'" and empid="'.$uid.'"')->queryAll();
$cont= $infocnt1[0]['status'];
if($cont==""){

	echo $sql5= "update crt_walkins set comment='$comm',category_status='$category' where crt_id='$cid' and emp_id='$uid'";

Yii::$app->db->createCommand($sql5)->execute();
if($category=="Accept"){
$sql4= "insert into crt_participant(empid,crt_id, status)values('$uid','$cid','NEW')";
 
Yii::$app->db->createCommand($sql4)->execute();


$sql7 = "insert into crt_session_type_participants(crt_id, module_id, session_id, session_name, session_password, session_pass_status, question_type_id, question_type, question_type_pass, question_type_pass_status, emp_id)
select sess.crt_id,sess.module_id,sess.session_id,sess.session_name,sess.session_password,sess.session_pass_status,qtype.question_type,sess.session_type,
sess.session_type_password,sess.sess_type_pass_status,sess.empid

from

(select distinct b.question_type,a.session_id,a.module_id,a.crt_id
from
crt_question_mapping a,
question_master b
where a.question_id=b.question_id group by session_id,crt_id,question_type) as qtype,

(select a.crt_id,b.session_id,b.module_id,b.session_type_id,b.session_type,b.session_type_password,b.sess_type_pass_status,a.empid,
        c.session_password,c.session_pass_status,d.session_name
from crt_participant a,
     crt_session_type_pass b,
     crt_sessions_pass c,
     session_masters d
where a.crt_id=b.crt_id and b.session_id=c.session_id and b.module_id=c.module_id and b.crt_id=c.crt_id and c.session_id=d.session_id) as sess

where qtype.crt_id=sess.crt_id and qtype.module_id=sess.module_id and qtype.module_id=sess.module_id and qtype.crt_id='$cid' and qtype.question_type=sess.session_type_id group by qtype.question_type,sess.empid,sess.session_id,sess.crt_id" ;

Yii::$app->db->createCommand($sql7)->execute();
//echo "Accepted ";
header('Location: http://www.tuneem.com/tuneem/web/index.php?r=site%2Fnamination&id='$cid'');
}
else{
//echo "Rejected ";
header('Location: http://www.tuneem.com/tuneem/web/index.php?r=site%2Fnamination&id='$cid'');
}
 
}else{
	echo $sql5= "update crt_walkins set comment='$comm',category_status='$category' where crt_id='$cid' and emp_id='$uid'";

Yii::$app->db->createCommand($sql5)->execute();
header('Location: http://www.tuneem.com/tuneem/web/index.php?r=site%2Fnamination&id='$cid'');
	//echo "Already Accepted";
}
 

?>