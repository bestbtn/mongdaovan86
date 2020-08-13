<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\widgets\ToastrWidget;
use modava\faq\widgets\NavbarWidgets;
use modava\faq\FaqModule;

/* @var $this yii\web\View */
/* @var $model modava\faq\models\Faq */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => FaqModule::t('faq', 'Faqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-view']) ?>
<div class="container-fluid px-xxl-25 px-xl-10">
    <?= NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?= Html::encode($this->title) ?>
        </h4>
        <p>
            <a class="btn btn-outline-light" href="<?= Url::to(['create']); ?>"
                title="<?= FaqModule::t('faq', 'Create'); ?>">
                <i class="fa fa-plus"></i> <?= FaqModule::t('faq', 'Create'); ?></a>
            <?= Html::a(FaqModule::t('faq', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(FaqModule::t('faq', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => FaqModule::t('faq', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <?= $this->render('_detail', [
                    'model' => $model,
                ]) ?>
            </section>
        </div>
    </div>
</div>