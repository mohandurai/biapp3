 <?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use dosamigos\datepicker\DateRangePicker;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use mdm\admin\models\AuthItem;
use yii\helpers\ArrayHelper;
use  app\models\User;
use  app\models\DepartmentMaster;
use  app\models\CountryMaster;
use  app\models\ZoneMaster;
use  app\models\StateMaster;
use  app\models\CityMaster;
use  app\models\AreaMaster;
use  app\models\TerritoryMaster;
use  app\models\DealershipMaster;
use app\models\UserGroupMaster;
use app\models\ChannelMaster;
use app\models\FunctionMaster;
use app\models\CompanyMaster;
use app\models\BusinessUnitMaster;
use yii\helpers\Json;
use yii\db\Query;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use mdm\admin\models\searchs\AuthItem as AuthItemSearch;
use yii\rbac\Item;
use common\models\DataOperations;
public function actionMenudep()
    {
        $out = []; 
          if(!empty($_POST['depdrop_parents'][0]))
          {
             $parent=$_POST['depdrop_parents'][0];

             

        return json_encode(['output' => $out,'Selected'=>1]);

 }
 else
 {
     echo "keerthana";
 }

}
    ?>