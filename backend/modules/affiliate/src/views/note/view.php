<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\ToastrWidget;
use modava\affiliate\widgets\NavbarWidgets;
use modava\affiliate\AffiliateModule;

/* @var $this yii\web\View */
/* @var $model modava\affiliate\models\Note */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => AffiliateModule::t('affiliate', 'Notes'), 'url' => ['index']];
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
                title="<?= AffiliateModule::t('affiliate', 'Create'); ?>">
                <i class="fa fa-plus"></i> <?= AffiliateModule::t('affiliate', 'Create'); ?></a>
            <?= Html::a(AffiliateModule::t('affiliate', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(AffiliateModule::t('affiliate', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => AffiliateModule::t('affiliate', 'Are you sure you want to delete this item?'),
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
						'id',
						'title',
						'slug',
                        [
                            'attribute' => 'customer_id',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->customer_id ? Html::a($model->customer->full_name, Url::toRoute(['/affiliate/customer/view', 'id' => $model->customer_id])) : '';
                            }
                        ],
                        [
                            'attribute' => 'call_time',
                            'value' => function ($model) {
                                return $model->call_time
                                    ? date('d-m-Y H:i', strtotime($model->call_time))
                                    : '';
                            }
                        ],
                        [
                            'attribute' => 'recall_time',
                            'value' => function ($model) {
                                return $model->recall_time
                                    ? date('d-m-Y H:i', strtotime($model->recall_time))
                                    : '';
                            }
                        ],
                        [
                            'attribute' => 'note_type',
                            'value' => function ($model) {
                                return Yii::$app->getModule('affiliate')->params['note_type'][$model->note_type];
                            }
                        ],
                        [
                            'attribute' => 'partner_id',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->partner_id ? $model->partner->title : null;
                            },
                        ],
						'created_at:datetime',
						'updated_at:datetime',
                        [
                            'attribute' => 'userCreated.userProfile.fullname',
                            'label' => AffiliateModule::t('affiliate', 'Created By')
                        ],
                        [
                            'attribute' => 'userUpdated.userProfile.fullname',
                            'label' => AffiliateModule::t('affiliate', 'Updated By')
                        ],
                    ],
                ]) ?>
            </section>
        </div>
    </div>
</div>
