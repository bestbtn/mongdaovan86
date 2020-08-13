<?php

namespace modava\auth\models;

<<<<<<< HEAD
use common\helpers\MyHelper;
=======
>>>>>>> master
use common\models\User;
use cornernote\linkall\LinkAllBehavior;
use modava\auth\AuthModule;
use modava\auth\models\table\RbacAuthItemTable;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use Yii;
use yii\helpers\Json;
use yii\rbac\Item;

/**
 * This is the model class for table "rbac_auth_item".
 *
 * @property string $name
 * @property int $type
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
<<<<<<< HEAD
 * @property RbacAuthAssignment[] $rbacAuthAssignments
 * @property User[] $users
 * @property RbacAuthRule $ruleName
=======
 * @property User[] $users
>>>>>>> master
 * @property RbacAuthItemChild[] $rbacAuthItemChildren
 * @property RbacAuthItemChild[] $rbacAuthItemChildren0
 * @property RbacAuthItem[] $children
 * @property RbacAuthItem[] $parents
 */
class RbacAuthItem extends RbacAuthItemTable
{
    const TYPE_ROLE = 1;
    const TYPE_PERMISSION = 2;
    const TYPE = [
        self::TYPE_ROLE => 'Role',
        self::TYPE_PERMISSION => 'Permission'
    ];
    public $toastr_key = 'rbac-auth-item';
    public $parents;
    public $_item;
    public $ruleName;
    public $manager;

    /**
     * AuthItemModel constructor.
     *
     * @param Item|null $item
     * @param array $config
     */
    public function __construct($item = null, $config = [])
    {
        $this->_item = $item;
        $this->manager = Yii::$app->authManager;

        if ($item !== null) {
            $this->name = $item->name;
            $this->type = $item->type;
            $this->description = $item->description;
            $this->ruleName = $item->ruleName;
            $this->data = $item->data === null ? null : Json::encode($item->data);
        }

        parent::__construct($config);
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'timestamp' => [
                    'class' => 'yii\behaviors\TimestampBehavior',
                    'preserveNonEmptyValues' => true,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ],
                ],
                'type' => [
                    'class' => AttributeBehavior::class,
                    'attributes' => [],
                    'value' => function () {
                        if (!Yii::$app->user->can(User::DEV)) return self::TYPE_PERMISSION;
                        return $this->type;
                    }
                ],
                LinkAllBehavior::class
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['name', 'type'], 'required'],
            [['type'], 'in', 'range' => array_keys(self::TYPE)],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['parents'], 'safe'],
        ]);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => AuthModule::t('auth', 'Name'),
            'type' => AuthModule::t('auth', 'Type'),
            'description' => AuthModule::t('auth', 'Description'),
            'rule_name' => AuthModule::t('auth', 'Rule Name'),
            'data' => AuthModule::t('auth', 'Data'),
            'created_at' => AuthModule::t('auth', 'Created At'),
            'updated_at' => AuthModule::t('auth', 'Updated At'),
            'parents' => AuthModule::t('auth', 'Parent'),
        ];
    }
=======
//    /**
//     * {@inheritdoc}
//     */
//    public function attributeLabels()
//    {
//        return [
//            'name' => AuthModule::t('auth', 'Name'),
//            'type' => AuthModule::t('auth', 'Type'),
//            'description' => AuthModule::t('auth', 'Description'),
//            'rule_name' => AuthModule::t('auth', 'Rule Name'),
//            'data' => AuthModule::t('auth', 'Data'),
//            'created_at' => AuthModule::t('auth', 'Created At'),
//            'updated_at' => AuthModule::t('auth', 'Updated At'),
//            'parents' => AuthModule::t('auth', 'Parent'),
//        ];
//    }
>>>>>>> master

    public function afterSave($insert, $changedAttributes)
    {
        $parents = [];
        if (is_array($this->parents)) {
            foreach ($this->parents as $parent) {
                $parent = RbacAuthItemTable::getByName($parent, false);
                if ($parent) {
                    $parents[] = $parent;
                }
            }
        }
        $this->linkAll('parentHasMany', $parents);
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    /**
     * Add child to Item
     *
     * @param array $items
     *
     * @return bool
     */
    public function addChildren(array $items): bool
    {
        if ($this->_item) {
            foreach ($items as $name) {
                $child = $this->manager->getPermission($name);
                $this->manager->addChild($this->_item, $child);
            }
        }

        return true;
    }

    /**
     * Remove child from an item
     *
     * @param array $items
     *
     * @return bool
     */
    public function removeChildren(array $items): bool
    {
        if ($this->_item !== null) {
            foreach ($items as $name) {
                $child = $this->manager->getPermission($name);
                $this->manager->removeChild($this->_item, $child);
            }
        }

        return true;
    }
}
