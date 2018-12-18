<?php


namespace app\commands;

use yii\rbac\Rule;
use app\models\Leads;
use yii\helpers\ArrayHelper;
/**
 * Checks if authorID matches user passed via params
 */
class UserRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
/*
print_r($user);
echo "lll";
print_r($item);
echo "<pre>";
print_r($params);
echo "</pre>";
echo $params['post']->assignedto;

/*
echo array_key_exists($params['post']->leadid,ArrayHelper::map(Leads::getsharing_access('')->andWhere(['leadid' => $params['post']->leadid])->all(),'leadid','name'));


exit;*/



        //return isset($params['post']) ? $params['post']->assignedto == $user : false;

return isset($params['post']) ? array_key_exists($params['post']->leadid,ArrayHelper::map(Leads::getsharing_access('')->andWhere(['leadid' => $params['post']->leadid])->all(),'leadid','name')) : false;

    }


}

?>
