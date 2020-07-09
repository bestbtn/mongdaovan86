<?php

use modava\auth\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\widgets\ToastrWidget;
use modava\auth\AuthModule;
use modava\auth\models\RbacAuthItem;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model modava\auth\models\RbacAuthItem */
/* @var $form yii\widgets\ActiveForm */
if ($model->parentHasMany != null) {
    $model->parents = ArrayHelper::map($model->parentHasMany, 'name', 'name');
}
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-form']) ?>
<div class="rbac-auth-item-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-12">
            <?= $form->field($model, 'name')->textInput(array_merge(['maxlength' => true], ($model->name == null ? [] : ['disabled' => true]))) ?>
        </div>
        <div class="col-md-6 col-12">
            <?= $form->field($model, 'type')->dropDownList((Yii::$app->user->can(User::DEV) ? RbacAuthItem::TYPE : function () {
                $type = RbacAuthItem::TYPE;
                unset($type[RbacAuthItem::TYPE_ROLE]);
                return $type;
            }), [
                'id' => 'choose-type'
            ]) ?>
        </div>
        <div class="col-12 type-role"
             style="display: <?= $model->type === RbacAuthItem::TYPE_ROLE ? 'block' : 'none' ?>">
            <?= \modava\select2\Select2::widget(['model' => $model,
                'attribute' => 'parents',
                'data' => ArrayHelper::map(RbacAuthItem::getRoleChildByCurrentUser(true, $model->name), 'name', 'description'),
                'options' => ['multiple' => 'multiple']]) ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(AuthModule::t('auth', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
