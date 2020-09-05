<?php

use modava\customer\widgets\NavbarWidgets;
use yii\helpers\Html;
use modava\customer\CustomerModule;


/* @var $this yii\web\View */
/* @var $model modava\customer\models\CustomerTreatmentSchedule */

$this->title = Yii::t('backend', 'Create') . ' ' . Yii::t('backend', 'Customer Treatment Schedules');
if ($model->order_id != null) {
    $this->title .= ': ' . $model->orderHasOne->customerHasOne->name . ' (' . $model->orderHasOne->code . ')';
}
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Customer Treatment Schedules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid px-xxl-25 px-xl-10">
    <?= NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?= Html::encode($this->title) ?>
        </h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </section>
        </div>
    </div>

</div>
