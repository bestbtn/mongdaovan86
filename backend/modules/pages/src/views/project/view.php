<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\ToastrWidget;
use modava\pages\widgets\NavbarWidgets;
use modava\pages\PagesModule;

/* @var $this yii\web\View */
/* @var $model modava\pages\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => PagesModule::t('pages', 'Projects'), 'url' => ['index']];
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
               title="<?= PagesModule::t('pages', 'Create'); ?>">
                <i class="fa fa-plus"></i> <?= PagesModule::t('pages', 'Create'); ?></a>
            <?= Html::a(PagesModule::t('pages', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(PagesModule::t('pages', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => PagesModule::t('pages', 'Are you sure you want to delete this item?'),
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
                            'attribute' => 'image',
                            'format' => 'html',
                            'value' => function ($model) {
                                if ($model->image == null)
                                    return null;
                                return Html::img(Yii::$app->params['project']['150x150']['folder'] . $model->image, ['width' => 150, 'height' => 150]);
                            },
                            'headerOptions' => [
                                'width' => 150,
                            ],
                        ],
                        'description:html',
                        'content:html',
                        [
                            'attribute' => 'tech',
                            'format' => 'html',
                            'value' => function ($model) {
                                if ($model->tech == null)
                                    return null;
                                $html = '';
                                foreach ($model->tech as $value) {
                                    $html .= $value['tech'] . ': ' . $value['value'] . '<br/>';
                                }
                                return $html;
                            }
                        ],
                        'position',
                        'ads_pixel:html',
                        'ads_session:html',
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return Yii::$app->getModule('pages')->params['status'][$model->status];
                            }
                        ],
                        [
                            'attribute' => 'language',
                            'value' => function ($model) {
                                if ($model->language == null)
                                    return null;
                                return Yii::$app->params['availableLocales'][$model->language];
                            },
                        ],
                        'views',
                        'created_at:datetime',
                        'updated_at:datetime',
                        [
                            'attribute' => 'userCreated.userProfile.fullname',
                            'label' => PagesModule::t('pages', 'Created By')
                        ],
                        [
                            'attribute' => 'userUpdated.userProfile.fullname',
                            'label' => PagesModule::t('pages', 'Updated By')
                        ],
                    ],
                ]) ?>
            </section>
        </div>
    </div>
</div>