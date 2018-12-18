<?php
namespace app\controllers;

use finfo;
use Yii;
use app\models\Import;
use app\models\ImportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\db\Query;
use yii\data\ActiveDataProvider;
/**
 * ImportController implements the File upload and validation actions for Import model.
 */
class ImportController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
	
	public function actionLog()
    {
        $searchModel = new ImportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('log', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
		
    }
	
	public function actionView($id)
    {        
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand('SELECT * FROM csv_import_log where id='.$id);
		$res = $sql->queryAll();
		return $this->render('view', [
            'model' => $res,
        ]);
    }

    /**
     * STEP1 File Selection
     * @return mixed
     */
	 public function actionAudiimport()
    {
        $model = new Import();

		// create folder structure
		if (!file_exists('csv-upload')) {
			mkdir('csv-upload', 0777, true);
			chmod('csv-upload',0777);
		}

		if (!file_exists('csv-upload-error')) {
			mkdir('csv-upload-error', 0777, true);
			chmod('csv-upload-error',0777);
		}
		if (!file_exists('csv-upload-template')) {
			mkdir('csv-upload-template', 0777, true);
			chmod('csv-upload-template',0777);
		}

        if ($model->load(Yii::$app->request->post())) {

		$allowed_mime = array(
		'csv1' => 'text/plain; charset=binary',
		'csv2' => 'text/csv; charset=binary',
		'csv3' => 'text/comma-separated-values; charset=binary',
		'csv4' => 'text/plain; charset=us-ascii',
		'csv5' => 'text/x-fortran; charset=us-ascii',
		);
		
		echo $model->file_source =UploadedFile::getInstances($model,'file_source');
		
		$file = $model->file_source;
		$file_info = new finfo(FILEINFO_MIME);  // object oriented approach!
		$mime_type = $file_info->buffer(file_get_contents($file[0]->tempName));
		
		if(!empty($model->file_source) && in_array($mime_type,$allowed_mime) && $mime_type!="" && $file[0]->size!=0)
		{	
			if($file[0]->size > 5242880)
			{
					\Yii::$app->getSession()->setFlash('csv_error', 'Maximum size exceeded. you can upload less or equal 5MB file');
					return $this->render('step1', ['model' => $model,]);
			}
			if(!empty($model->file_source)){
				foreach ($model->file_source as $file) {
					$current_time = date('Y-m-d_H:i:s')."_";
					$rename_file  = 'csv-upload/'.$current_time.$file->baseName.'.'.$file->extension;
					$file->saveAs($rename_file);
					chmod($rename_file,0777);
					$_SESSION['data']['baseName'] = $current_time.$file->baseName;
					$_SESSION['data']['file_name'] = $rename_file;
					$_SESSION['data']['model'] = $model->model;
				}
			}			
		}
		else
		{
			Yii::$app->getSession()->setFlash('csv_error', 'Invalid File Format...');
			return $this->render('step1', ['model' => $model,]);
		}
			
        return $this->redirect(['step2']);

        } else {
			unset($_SESSION['data']);
			unset($_SESSION['message']);
            return $this->render('step1', ['model' => $model,]);
        }
    }
	 

    public function actionStep1()
    {
        $model = new Import();
		
		// create folder structure
		if (!file_exists('csv-upload')) {
			mkdir('csv-upload', 0777, true);
			chmod('csv-upload',0777);
		}
		if (!file_exists('csv-upload-error')) {
			mkdir('csv-upload-error', 0777, true);
			chmod('csv-upload-error',0777);
		}
		if (!file_exists('csv-upload-template')) {
			mkdir('csv-upload-template', 0777, true);
			chmod('csv-upload-template',0777);
		}

        if ($model->load(Yii::$app->request->post())) {
			
		$allowed_mime = array(
		'csv1' => 'text/plain; charset=binary',
		'csv2' => 'text/csv; charset=binary',
		'csv3' => 'text/comma-separated-values; charset=binary',
		'csv4' => 'text/plain; charset=us-ascii',
		'csv5' => 'text/x-fortran; charset=us-ascii',
		'csv5' => 'text/x-fortran; charset=UTF-8',
		);
			
		$model->file_source =UploadedFile::getInstances($model,'file_source');
		$file = $model->file_source;
		$file_info = new finfo(FILEINFO_MIME);  // object oriented approach!
		$mime_type = $file_info->buffer(file_get_contents($file[0]->tempName));
		
		if(!empty($model->file_source) && in_array($mime_type,$allowed_mime) && $mime_type!="" && $file[0]->size!=0)
		{	
			if($file[0]->size > 5242880)
			{
					\Yii::$app->getSession()->setFlash('csv_error', 'Maximum size exceeded. you can upload less or equal 5MB file');
					return $this->render('step1', ['model' => $model,]);
			}
			if(!empty($model->file_source)){
				foreach ($model->file_source as $file) {
					$current_time = date('Y-m-d_H:i:s')."_";
					$rename_file  = 'csv-upload/'.$current_time.$file->baseName.'.'.$file->extension;
					$file->saveAs($rename_file);
					chmod($rename_file,0777);
					$_SESSION['data']['baseName'] = $current_time.$file->baseName;
					$_SESSION['data']['file_name'] = $rename_file;
					$_SESSION['data']['model'] = $model->model;
				}
			}			
		}
		else
		{
			\Yii::$app->getSession()->setFlash('csv_error', 'Invalid File Format...');
			return $this->render('step1', ['model' => $model,]);
		}
			
        return $this->redirect(['step2']);

        } else {
			unset($_SESSION['data']);
			unset($_SESSION['message']);
            return $this->render('step1', ['model' => $model,]);
        }
    }
	
	public function actionStep2()
    {
        $model = new Import();
		unset($_SESSION['message']);
		if(!empty($_SESSION['data']['model']))
		{
			$anothermodel = $_SESSION['data']['model'];
			$classfile = "\app\models\\". $anothermodel;
			$invoke = new $classfile();
		}
		else
		{
			\Yii::$app->getSession()->setFlash('csv_error', 'please select import model');
			return $this->redirect(['step1']);
		}
		$_SESSION['data']['mapped_columns'] = "";
		if($model->load(Yii::$app->request->post()) && Yii::$app->request->post()['Import']['mapping']=="CSV") 
		{	
			$rules = $invoke->rules();
			$required_column = array();
			foreach($rules as $rulekey => $rulevalues)
			{				
				if($rulevalues[1] == "required" && !is_array($rulevalues[0]))
				{
					$required_column[] = $rulevalues[0];
				}
				else if($rulevalues[1] == "required")
				{
					foreach($rulevalues as $singlerulekey => $singlerule)
					{
						if($singlerule == "required")
						{
							foreach($rulevalues[0] as $requiredkey => $requiredcolumn)
							{
								$required_column[] = $requiredcolumn;
							}
						}
					}
				}
				/* foreach($rulevalues as $singlerulekey => $singlerule)
				{
					if($singlerule == "required")
					{
						foreach($rulevalues[0] as $requiredkey => $requiredcolumn)
						{
							$required_column[] = $requiredcolumn;
						}
					}
				} */
			}	
			$unique_required = array_unique($required_column, SORT_REGULAR); // remove duplicate required column
			$missing_required = array();
			$mapping = Yii::$app->request->post()['mapping'];
			$_SESSION['data']['mapped_columns'] = "";
			foreach($unique_required as $ukey => $match)
			{
				if(in_array($match, $mapping))
				{
				   // Nothing To Do Match Found...	
				}
				else 
				{
					// Match Not Found and display as error message...	
					$missing_required[] = $_SESSION['data']['model_columns'][$match];
				}
			}
			if(count($missing_required)==0)
			{
				$_SESSION['data']['mapped_columns'] = $mapping;
				return $this->redirect(['step3']);
			}
			else
			{
				$_SESSION['data']['mapped_columns'] = $mapping;
				\Yii::$app->getSession()->setFlash('csv_error', 'Following columns are required. <br> { '.implode(",",$missing_required).' }');
				return $this->render('step2', ['model' => $model,]);
			}
			
		}
		if(!empty($_SESSION['data']['model']) && !empty($_SESSION['data']['file_name']))
		{		
			$rules = $invoke->rules();
			$required_column_first = array();
			foreach($rules as $rulekey => $rulevalues)
			{				
				if($rulevalues[1] == "required" && !is_array($rulevalues[0]))
				{
					$required_column_first[] = $rulevalues[0];
				}
				else if($rulevalues[1] == "required")
				{
					foreach($rulevalues as $singlerulekey => $singlerule)
					{
						if($singlerule == "required")
						{
							foreach($rulevalues[0] as $requiredkey => $requiredcolumn)
							{
								$required_column_first[] = $requiredcolumn;
							}
						}
					}
				}
			}
			$unique_required_first = array_unique($required_column_first, SORT_REGULAR); // remove duplicate required column
			$arr_fields = $invoke->attributeLabels();
			//remove array elements created_by, created_date, modified_by, modified_date,created_at, updated_at,last_updated_by
			$removearray = array('created_by', 'created_date', 'modified_by', 'modified_date','created_at','updated_at','last_updated_by');
			foreach ($removearray as $key => $val)
			{
				unset($arr_fields[$val]);
			}			
			foreach ($unique_required_first as $key => $val)
			{
				if(in_array($val,$removearray))
				unset($unique_required_first[$key]);
			}
			
			if(!file_exists($_SESSION['data']['file_name'])) {
			\Yii::$app->getSession()->setFlash('csv_error', 'CSV file Not Found...');
			return $this->redirect(['step1']);
			}
			$arr_headers = Import::get_header_fields('', $_SESSION['data']['file_name']);
			if( empty( $arr_headers ) ) {
			\Yii::$app->getSession()->setFlash('csv_error', 'Cannot retrieve headers columns of the CSV file');
			return $this->redirect(['step1']);
			}
			$arr_examples = Import::get_examples('', $_SESSION['data']['file_name']);
			if( empty( $arr_examples ) ) {
			\Yii::$app->getSession()->setFlash('csv_error', 'Cannot retrieve example data of the CSV file (first data line)');
			 return $this->redirect(['step1']);
			}
			//save for 3rd step to avoid rereads
			$_SESSION['data']['model_required'] = $unique_required_first;
			$_SESSION['data']['model_columns'] = $arr_fields;
			$_SESSION['data']['csv_headers'] = $arr_headers;
			$_SESSION['data']['csv_example'] = $arr_examples;
			$_SESSION['data']['success'] = "true";
			return $this->render('step2', ['model' => $model,]);
		}
		
		 return $this->redirect(['step1']);
    }
	
	public function actionStep3()
    {
        
		$model = new Import();
		$mapped_fields = $_SESSION['data']['mapped_columns'];
		$filename = $_SESSION['data']['file_name'];
		$selected_model = $_SESSION['data']['model'];
		if(empty($_SESSION['data']) && empty($_SESSION['message']))
		{
			\Yii::$app->getSession()->setFlash('csv_error', 'Upload CSV file Not Found...');
			return $this->redirect(['step1']);
		}
		if($_SESSION['data']['success']=="true")
		{
			if(!file_exists($_SESSION['data']['file_name'])) {
			\Yii::$app->getSession()->setFlash('csv_error', 'CSV file Not Found...');
			return $this->redirect(['step1']);
			}
			
			if(empty($_SESSION['data']['mapped_columns']))
			{
				\Yii::$app->getSession()->setFlash('csv_error', 'Filed Mapping Not Found...');
				return $this->redirect(['step2']);
			}
			
			if(!empty($_SESSION['data']['model']))
			{
				$anothermodel = $_SESSION['data']['model'];
				$classfile = "\app\models\\". $anothermodel;
				$invoke = new $classfile();
			}
			else
			{
				\Yii::$app->getSession()->setFlash('csv_error', 'please select import model');
				return $this->redirect(['step1']);
			}
		}
		
		return $this->render('step3', ['model' => $model,]);
    }
	public function actionStep4()
    {

		$model = new Import();
		$mapped_fields = $_SESSION['data']['mapped_columns'];
		$filename = $_SESSION['data']['file_name'];
		$selected_model = $_SESSION['data']['model'];
		$response = "";
		if(empty($_SESSION['data']))
		{
			\Yii::$app->getSession()->setFlash('csv_error', 'Upload CSV file Not Found...');
			return $this->redirect(['step1']);
		}
		if($_SESSION['data']['success']=="true")
		{
		if(!file_exists($_SESSION['data']['file_name'])) {
		//\Yii::$app->getSession()->setFlash('csv_error', 'CSV file Not Found...');
		//return $this->redirect(['step1']);
		$response = '{"success":"false","message":"CSV file Not Found..."}';
		}
		
		if(empty($_SESSION['data']['mapped_columns']))
		{
			//\Yii::$app->getSession()->setFlash('csv_error', 'Filed Mapping Not Found...');
			//return $this->redirect(['step2']);
			$response = '{"success":"false","message":"Filed Mapping Not Found..."}';
		}
		
		if(!empty($_SESSION['data']['model']))
		{
			$anothermodel = $_SESSION['data']['model'];
			$classfile = "\app\models\\". $anothermodel;
			$invoke = new $classfile();
		}
		else
		{
			//\Yii::$app->getSession()->setFlash('csv_error', 'please select import model');
			//return $this->redirect(['step1']);
			$response = '{"success":"false","message":"please select import model"}';
		}
		$newlymapped = array();
		$mappedcsv_header = array();
		$map = 0;
		foreach($mapped_fields as $csv_column=>$modelfield)
		{
			if(!empty($modelfield))
			{
				$newlymapped[$map] = $modelfield;
				$mappedcsv_header[$modelfield] = $csv_column;
			}
			$map++;
		}	
		
		$row = 1;
		$success_record_count = 0;
		$error_record_count = 0;
		$successful_csv_data= array();
		$unsuccessful_csv_data= array();
		if (($handle = fopen($filename, "r")) !== FALSE) 
		{
			$csvheader = fgets($handle); // read the first line and ignore it
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
			{
				$num = count($data);
				$row++;
					$model_related_data = array();
					foreach($newlymapped as $csv_column_no=>$model_field)
					{
						$model_related_data[$selected_model][$model_field] = $data[$csv_column_no];
					}

				$anothermodel = $_SESSION['data']['model'];
				$classfile = "\app\models\\". $anothermodel;
				$invoke = new $classfile();
				$arr_fields = $invoke->attributeLabels();
				if ($invoke->load($model_related_data) && $invoke->save())			
				{
					//Show successfull records.
					if($success_record_count==0)
					{
						$succ_header = trim($csvheader);
						$successful_csv_data[] = explode(",",$succ_header);
					}
					$successful_csv_data[] = $data;					
					$success_record_count = $success_record_count+1;
				} 
				else 
				{
					$errors = $invoke->errors;
					$summary_error = "";
					$error_cnt = 1;										
					foreach($errors as $field=>$error)
					{											
						$csv_column = $mappedcsv_header[$field];
						$summary_error .= '('.$csv_column.') - '.implode(",",$errors[$field]);
						if(count($errors) > 1 && count($errors) > $error_cnt)
						{
							$summary_error .= " and ";
						}
						$error_cnt++;
					}
					if($error_record_count==0)
					{
						$err_header = trim($csvheader).",Mapped CSV Column And Error Description";
						$unsuccessful_csv_data[] = explode(",",$err_header);
					}
					$error_data = implode(",",$data).','.$summary_error;
					$unsuccessful_csv_data[] = explode(",",$error_data);
					$error_record_count = $error_record_count+1;
				}
				
			}
		fclose($handle);
		}		
		if(count($successful_csv_data)!=0)
		{			
			$fp = fopen('csv-upload-error/'.$_SESSION['data']['baseName'].'_success.csv', 'w');
			foreach ($successful_csv_data as $fields) {
			fputcsv($fp, $fields);
			}
			fclose($fp);
			$success_path = 'csv-upload-error/'.$_SESSION['data']['baseName'].'_success.csv';
			chmod($success_path,0777);
			$success_file = $_SESSION['data']['baseName'].'_success.csv';
		}
		else
		{
			$success_path = "";
			$success_file = "";
		}
		if(count($unsuccessful_csv_data)!=0)
		{			
			$fp = fopen('csv-upload-error/'.$_SESSION['data']['baseName'].'_error.csv', 'w');
			foreach ($unsuccessful_csv_data as $fields) {
			fputcsv($fp, $fields);
			}
			fclose($fp);
			$error_path = 'csv-upload-error/'.$_SESSION['data']['baseName'].'_error.csv';
			chmod($error_path,0777);
			$error_file = $_SESSION['data']['baseName'].'_error.csv';
		}
		else
		{
			$error_path = "";
			$error_file = "";
		}
		
		$_SESSION['message']['total'] = $row-1;
		$_SESSION['message']['success'] = $success_record_count;
		$_SESSION['message']['error'] = $error_record_count;
		$_SESSION['message']['success_path'] = $success_path;
		$_SESSION['message']['error_path'] = $error_path;
		$_SESSION['message']['actual_path'] = $_SESSION['data']['file_name'];
		$created_by = Yii::$app->user->identity->id;
		$parameters[] = array(':model'=>$_SESSION['data']['model'], ':total_records'=>$_SESSION['message']['total'], ':success_records'=>$_SESSION['message']['success'], ':error_records'=>$_SESSION['message']['error'], ':success_path'=>$_SESSION['message']['success_path'], ':success_file'=>$success_file, ':error_path'=>$_SESSION['message']['error_path'], ':error_file'=>$error_file, ':created_by:'=>$created_by,);       
        Yii::$app->db->createCommand()->batchInsert('csv_import_log', ['model', 'total_records', 'success_records', 'error_records', 'success_path', 'success_file', 'error_path', 'error_file', 'created_by',], $parameters)->execute();
		unset($_SESSION['data']);
		$response = '{"success":"true","message":"File Uploaded Successfully..."}';
		}
		
	echo $response;
		
	}
	public function actionStep5()
    {
		if(empty($_SESSION['message']))
		{
			\Yii::$app->getSession()->setFlash('csv_error', 'Upload CSV file Not Found...');
			return $this->redirect(['step1']);
		}
		$filepath = \Yii::getAlias('@webroot').'/'.$_REQUEST['file'];;
		if (file_exists($filepath)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($filepath));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		ob_clean();
		flush();
		readfile($filepath);
		exit;
		}
	}
	public function actionStep6()
    {
		if(!empty($_REQUEST['model']))
		{
			$anothermodel = $_REQUEST['model'];
			$classfile = "\app\models\\". $anothermodel;
			$invoke = new $classfile();
			$arr_fields = $invoke->attributeLabels();
			$removearray = array('created_by', 'created_date', 'modified_by', 'modified_date','created_at','updated_at','last_updated_by');
			foreach ($removearray as $key => $val)
			{
				unset($arr_fields[$val]);
			}
			$file_location = 'csv-upload-template/'.$anothermodel.'_template.csv';
			$file = $anothermodel.'_template.csv';
			$fp = fopen('csv-upload-template/'.$anothermodel.'_template.csv', 'w');
			fputcsv($fp, $arr_fields);
			fclose($fp);
			chmod($file_location,0777);
			echo $response = '{"success":"true","file":"'.$file.'","filelocation":"'.$file_location.'","message":"Template Generated..."}';
			exit;
		}
		else
		{
			echo $response = '{"success":"false","message":"Unable to generate template..."}';
		}
	}
	
	public function actionStep7()
    {
		
		if(empty($_REQUEST['file']))
		{
			\Yii::$app->getSession()->setFlash('csv_error', 'CSV file Not Found...');
			return $this->redirect(['step1']);
		}
		$filepath = \Yii::getAlias('@webroot').'/'.$_REQUEST['file'];
		if (file_exists($filepath)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($filepath));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		ob_clean();
		flush();
		readfile($filepath);
		exit;
		}
	}
    
}
