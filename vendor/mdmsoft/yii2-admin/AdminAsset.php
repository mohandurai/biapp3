<?php

namespace mdm\admin;

use Yii;
use yii\helpers\Inflector;
/**
 * AdminAsset
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class AdminAsset extends \yii\web\AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@mdm/admin/assets';

    /**
     * @inheritdoc
     */


    public $css = [
        'main.css',
    ];

}
