<?php

namespace leandrogehlen\querybuilder;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the [jquery QueryBuilder library](https://github.com/mistic100/jQuery-QueryBuilder)
 *
 * @author Leandro Gehlen <leandrogehlen@gmail.com>
 */
class QueryBuilderAsset extends AssetBundle {

    public $sourcePath = '@bower/jQuery-QueryBuilder/dist';

    public $js = [
        'query-builder.standalone.js',
    ];

    public $css = [
        'query-builder.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'leandrogehlen\querybuilder\BootstrapAsset',
    ];

} 