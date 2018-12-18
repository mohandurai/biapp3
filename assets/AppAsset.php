<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $cssOptions = ['media' => 'screen'];

    public $css = [

		'css/bootstrap.min.css',
		 'multiselect/jquery.tree-multiselect.min.css',
		 'multiselect/highCheckTree.css',
    // 'css/hummingbird-treeview.css',
		//'css/spectrum.css',
		//'js/toastr/toaster.css',
         'css/style.min.css',
		'css/site.css',
		'css/iestylesheet.css',
		//'js/DataTables-master/media/css/dataTables.foundation.min.css',
		'css/bimain.css',
    'css/fontawesome/css/font-awesome.css',
    'css/jquery.mCustomScrollbar.css',
    'css/jquery.mCustomScrollbar.css',
  // 'css/normalize.min.css',
  // 'css/main.css',
  'css/daterangepicker.css',

  // 'css/red.css',
  //   'css/blue.css',


    ];
    public $js = [
      'js/jquery.mCustomScrollbar.js',

      // 'multiselect/jquery-1.11.3.min.js',
      'multiselect/jquery.tree-multiselect.js',
        // 'js/jstree.js',
        // 'multiselect/highchecktree.js',

        'js/bootstrap3.min.js',


        // 'js/setting.js',

        'js/daterangepicker.js',
        'js/main.js',
        

//'js/hummingbird-treeview.js',
		//'js/spectrum.js',
		//'custom_scripts/main.js',
		//'js/toastr/toaster.js',
		//'js/jquery.confirm.js',

		//'js/jquery-1.7.1.min.js',
		//'js/DataTables-master/media/js/dataTables.foundation.min.js',

    ];
	/*
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
	*/
}
