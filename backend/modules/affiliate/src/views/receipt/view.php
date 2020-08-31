<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\ToastrWidget;
use modava\affiliate\widgets\NavbarWidgets;
use modava\affiliate\AffiliateModule;

/* @var $this yii\web\View */
/* @var $model modava\affiliate\models\Receipt */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => AffiliateModule::t('receipt', 'Receipts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-view']) ?>
<div class="container-fluid px-xxl-25 px-xl-10">
    <?= NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?=AffiliateModule::t('receipt', 'Chi tiết'); ?>: <?= Html::encode($this->title) ?>
        </h4>
        <p>
            <a class="btn btn-outline-light" href="<?= Url::to(['create']); ?>"
                title="<?= AffiliateModule::t('receipt', 'Create'); ?>">
                <i class="fa fa-plus"></i> <?= AffiliateModule::t('receipt', 'Create'); ?></a>
            <?= Html::a(AffiliateModule::t('receipt', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(AffiliateModule::t('receipt', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => AffiliateModule::t('receipt', 'Are you sure you want to delete this item?'),
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
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
						'title',
						[
                            'attribute' => 'order_id',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a($model->order->title, Url::toRoute(['order/view', 'id' => $model->order_id]));
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                if ($model->status === null) return null;

                                return Yii::$app->getModule('affiliate')->params['receipt_status'][$model->status];
                            },
                        ],
						'total:currency',
						'payment_method',
						'partner_code',
						'created_at:datetime',
						'updated_at:datetime',
                        [
                            'attribute' => 'userCreated.userProfile.fullname',
                            'label' => AffiliateModule::t('receipt', 'Created By')
                        ],
                        [
                            'attribute' => 'userUpdated.userProfile.fullname',
                            'label' => AffiliateModule::t('receipt', 'Updated By')
                        ],
                    ],
                ]) ?>
            </section>
        </div>
    </div>
</div>