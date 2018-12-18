<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
/**
 * ContactForm is the model behind the contact form.
 */
class Import extends Model
{
    public $file_source;
    public $model;
	public $mapping;

//id, model, total_records, success_records, error_records, success_path, success_file,error_path, error_file, created_by, created_date	
    public $id;
	public $total_records;
	public $success_records;
	public $error_records;
	public $success_path;
	public $success_file;
	public $error_path;
	public $error_file;
	public $created_by;
	public $created_date;
	
	public static function tableName()
    {
        return 'csv_import_log';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file_source', 'model'], 'required'],
			['file_source', 'file', 'extensions' => ['csv'], 'maxSize' => 1024 * 1024 * 5, 'tooBig'=>'The file was larger than 5MB. Please upload a smaller file.','skipOnEmpty' => false],
        ];
    }
	
	public static function getCreatedBy($id)
	{
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand('SELECT b.username FROM csv_import_log a,user b where a.created_by=b.id and a.id='.$id);
		$res = $sql->queryAll();
		return $res[0]['username'];
	}

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'file_source' => 'Choose File To Import',
			'model' => 'Select Model',
        ];
    }
	
	public static function write_file($filename, $data)
	{
	  $fp = fopen($filename, 'w');
	  if($fp)
	  {
		fwrite($fp, $data);
		fclose($fp);
		return true;
	  }
	  return false;
	}

	//writes data in the end of a file
	public static function append_file($filename, $data)
	{
	  $fp = fopen($filename, 'a');
	  if($fp)
	  {
		fwrite($fp, $data);
		fclose($fp);
		return true;
	  }
	  return false;
	}

	//OS independent deletion of a file
	public static function delete_file($filename)
	{
	  if(file_exists($filename))
	  {
		$os = php_uname();
		if(stristr($os, "indows")!==false)
		  return exec("del ".$filename);
		else
		  return unlink($filename);
	  }
	  return true;
	}
  //returns array of CSV file fields names
  public static function get_header_fields($db, $file_name, $encoding='utf8', $separator=',', $enclose_char='"', $escape_char='\\')
  {
    return self::load_line($db, $file_name, 1, $encoding, $separator, $enclose_char, $escape_char);
  }

  public static function get_examples($db, $file_name, $encoding='utf8', $separator=',', $enclose_char='"', $escape_char='\\')
  {
    return self::load_line($db, $file_name, 2, $encoding, $separator, $enclose_char, $escape_char);
  }

  public static function get_line($file_name, $line_num=1)
  {
    $line = '';
    $fpointer = fopen($file_name, "r");
    if ($fpointer)
    {
      for($i=1; $i<=$line_num; $i++)
      {
        $line = fgets($fpointer); //get a line which number is equal to $line_num
      }
    }
    return $line;
  }

  public static function load_line($db, $file_name, $line_num, $encoding='utf8', $separator=',', $enclose_char='"', $escape_char='\\')
  {
    $arrColumns = array();
    $line = self::get_line($file_name, $line_num);
      
    if( !empty($line) )
    {
	  $digits = 6;
	  $rand = rand(pow(10, $digits-1), pow(10, $digits)-1);
      //$filename = tempnam('csv-upload', 'csv');
	  $nname = "csv-upload/".$rand.".csv";
	  $filename = fopen($nname, "w");
	  chmod($nname,0777);
      if($filename)
      {
        self::write_file($nname, $line);
        $arrColumns = self::convert_line($db, $nname, $encoding, $separator, $enclose_char, $escape_char);
        self::delete_file($nname);
      }
    }

    return $arrColumns;
  }

  public static function convert_line($db, $file_name, $encoding='utf8', $separator=',', $enclose_char='"', $escape_char='\\')
  {
    $rez = array();
	$arr_csv_columns = self::get_csv_header_fields($file_name,$separator);
	return $arr_csv_columns;
  }
  
  public static function get_csv_header_fields($file_name,$field_separate_char)
  {
    $arr_csv_columns = array();
    $fpointer = fopen($file_name, "r");
    if($fpointer)
    {
      $arr = fgetcsv($fpointer, 10*1024, $field_separate_char);
      if(is_array($arr) && !empty($arr))
      {
          foreach($arr as $val)
            //if(''!=trim($val))
              $arr_csv_columns[] = array('name'=>$val, 'type'=>'TEXT');
      }
      unset($arr);
      fclose($fpointer);
    }
    return $arr_csv_columns;
  }
    
}

