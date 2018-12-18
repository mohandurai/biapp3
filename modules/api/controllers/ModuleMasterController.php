<?php

namespace app\controllers;

use yii\rest\ActiveController;

use Yii;
use app\models\ModuleMaster;
use app\models\ModuleMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModuleMasterController implements the CRUD actions for ModuleMaster model.
 */

class ModuleMasterController extends ActiveController
{
    public $modelClass = 'app\models\ModuleMaster';
} 
