<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modava\kenne\models\search\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cat_id') ?>

    <?= $form->field($model, 'pro_name') ?>

    <?= $form->field($model, 'pro_slug') ?>

    <?= $form->field($model, 'pro_description') ?>

    <?php // echo $form->field($model, 'pro_quantity') ?>

    <?php // echo $form->field($model, 'pro_price') ?>

    <?php // echo $form->field($model, 'pro_image') ?>

    <?php // echo $form->field($model, 'pro_status') ?>

    <?php // echo $form->field($model, 'pro_sale') ?>

    <?php // echo $form->field($model, 'pro_number') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('kenne', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('kenne', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
