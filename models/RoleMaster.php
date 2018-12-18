<?php

//namespace mdm\admin\models;
namespace mdm\admin\models;
namespace app\models;
use Yii;
use yii\rbac\Item;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/**
 * This is the model class for table "tbl_auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $ruleName
 * @property string $data
 *
 * @property Item $item
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class RoleMaster extends \yii\base\Model
{
    public $name;
    public $type;
    public $description;
    public $ruleName;
    public $data;
public $dealer;
public $businessunit;

    /**
     * @var Item
     */
    private $_item;
 
    /**
     * Initialize object
     * @param Item  $item
     * @param array $config
     */
   /* public function __construct($item, $config = [])
    {
        $this->_item = $item;
        if ($item !== null) {
            $this->name = $item->name;
            $this->type = $item->type;
            $this->dealer = $item->dealer;
            $this->description = $item->description;
            $this->ruleName = $item->ruleName;
            $this->data = $item->data === null ? null : Json::encode($item->data);
        }
        parent::__construct($config);
    }
*/
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['name', 'type'], 'required'],
            [['name'], 'unique', 'when' => function() {
                return $this->isNewRecord || ($this->_item->name != $this->name);
            }],
            [['type'], 'integer'],
            [['description', 'data', 'dealer'], 'safe'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    public function unique()
    {
        $authManager = Yii::$app->authManager;
        $value = $this->dealer."_".$this->name;
       
    $val=$this->name;
    //$neev=new AudiNeevDesignation::findOne($val);
     $neev=ArrayHelper::map(AudiNeevDesignation::find()->andWhere(['neev_designation'=>$val])->all(),'neev_designation','neev_designation');
    if(empty($neev))
     {
          $message1 = Yii::t('yii', '{attribute} "{value}" not a Designation Role.');
            $params1 = [
                'attribute' => $this->getAttributeLabel('name'),
                'value' => $val,
            ];
            $this->addError('name', Yii::$app->getI18n()->format($message1, $params1, Yii::$app->language));
     }

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' =>  'Designation',
            'type' => 'Type',
            'description' => 'Description',
            'data' =>  'Data',
            'dealer' =>  'Dealer Princpal',
        ];
    }

    /**
     * Check if is new record.
     * @return boolean
     */
    public function getIsNewRecord()
    {
        return $this->_item === null;
    }

    /**
     * Find role
     * @param string $id
     * @return null|\self
     */
    public static function find($id)
    {
        $item = Yii::$app->authManager->getRole($id);
        if ($item !== null) {
            return new self($item);
        }

        return null;
    }

    /**
     * Save role to [[\yii\rbac\authManager]]
     * @return boolean
     */
    public function save()
    {
        if ($this->validate()) {
            $manager = Yii::$app->authManager;
            if ($this->_item === null) {
                if ($this->type == Item::TYPE_ROLE) {
                    $this->_item = $manager->createRole($this->name);
                } else {
                    $this->_item = $manager->createPermission($this->name);
                }
                $isNew = true;
            } else {
                $isNew = false;
                $oldName = $this->_item->name;
            }
            $this->_item->name = $this->name;
            $this->_item->dealer = $this->dealer;
            $this->_item->description = $this->description;
          
            $this->_item->data = $this->data === null || $this->data === '' ? null : Json::decode($this->data);
            if ($isNew) {
                $manager->add($this->_item);
            } else {
                $manager->update($oldName, $this->_item);
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * Get item
     * @return Item
     */
    public function getItem()
    {
        return $this->_item;
    }

    /**
     * Get type name
     * @param  mixed $type
     * @return string|array
     */
    public static function getTypeName($type = null)
    {
        $result = [
            Item::TYPE_PERMISSION => 'Permission',
            Item::TYPE_ROLE => 'Role'
        ];
        if ($type === null) {
            return $result;
        }

        return $result[$type];
    }
}

