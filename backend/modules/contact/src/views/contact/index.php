<?php

use backend\widgets\ToastrWidget;
use modava\contact\ContactModule;
use modava\contact\widgets\NavbarWidgets;
use common\grid\MyGridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modava\contact\models\search\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Contacts');
$this->params['breadcrumbs'][] = $this->title;
//echo '<pre>';
//var_dump($searchModel->contactMetadataIndex);die;
try {
    $contactMetadataIndex = $searchModel->contactMetadataIndex;
    if (!is_array($contactMetadataIndex)) $contactMetadataIndex = [];
} catch (Exception $ex) {
    $contactMetadataIndex = [];
}
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $searchModel->toastr_key . '-index']) ?>
    <div class="container-fluid px-xxl-25 px-xl-10">
        <?= NavbarWidgets::widget(); ?>

        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                            class="ion ion-md-apps"></span></span><?= Html::encode($this->title) ?>
            </h4>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper index">

                    <?php Pjax::begin(['id' => 'contact-pjax', 'timeout' => false, 'enablePushState' => true, 'clientOptions' => ['method' => 'GET']]); ?>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="dataTables_wrapper dt-bootstrap4">
                                    <?= MyGridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'layout' => '
                                            {errors} 
                                            <div class="pane-single-table">
                                                {items}
                                            </div>
                                            <div class="pager-wrap clearfix">
                                                {summary}' .
                                            Yii::$app->controller->renderPartial('@backend/views/layouts/my-gridview/_pageTo', [
                                                'totalPage' => $totalPage,
                                                'currentPage' => Yii::$app->request->get($dataProvider->getPagination()->pageParam)
                                            ]) .
                                            Yii::$app->controller->renderPartial('@backend/views/layouts/my-gridview/_pageSize') .
                                            '{pager}
                                            </div>
                                        ',
                                        'tableOptions' => [
                                            'id' => 'dataTable',
                                            'class' => 'dt-grid dt-widget pane-hScroll',
                                        ],
                                        'myOptions' => [
                                            'class' => 'dt-grid-content my-content pane-vScroll',
                                            'data-minus' => '{"0":95,"1":".hk-navbar","2":".nav-tabs","3":".hk-pg-header","4":".hk-footer-wrap"}'
                                        ],
                                        'summaryOptions' => [
                                            'class' => 'summary pull-right',
                                        ],
                                        'pager' => [
                                            'firstPageLabel' => Yii::t('backend', 'First'),
                                            'lastPageLabel' => Yii::t('backend', 'Last'),
                                            'prevPageLabel' => Yii::t('backend', 'Previous'),
                                            'nextPageLabel' => Yii::t('backend', 'Next'),
                                            'maxButtonCount' => 5,

                                            'options' => [
                                                'tag' => 'ul',
                                                'class' => 'pagination',
                                            ],

                                            // Customzing CSS class for pager link
                                            'linkOptions' => ['class' => 'page-link'],
                                            'activePageCssClass' => 'active',
                                            'disabledPageCssClass' => 'disabled page-disabled',
                                            'pageCssClass' => 'page-item',

                                            // Customzing CSS class for navigating link
                                            'prevPageCssClass' => 'paginate_button page-item prev',
                                            'nextPageCssClass' => 'paginate_button page-item next',
                                            'firstPageCssClass' => 'paginate_button page-item first',
                                            'lastPageCssClass' => 'paginate_button page-item last',
                                        ],
										'fullname',
										'phone',
										'email:email',
										'address',
										'title',
										//'content:ntext',
										//'ip_address',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => ContactModule::t('contact', 'Actions'),
                                            'template' => '{update} {delete}',
                                            'buttons' => [
                                                'update' => function ($url, $model) {
                                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                                        'title' => ContactModule::t('contact', 'Update'),
                                                        'alia-label' => ContactModule::t('contact', 'Update'),
                                                        'data-pjax' => 0,
                                                        'class' => 'btn btn-info btn-xs'
                                                    ]);
                                                },
                                                'delete' => function ($url, $model) {
                                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:;', [
                                                        'title' => ContactModule::t('contact', 'Delete'),
                                                        'class' => 'btn btn-danger btn-xs btn-del',
                                                        'data-title' => ContactModule::t('contact', 'Delete?'),
                                                        'data-pjax' => 0,
                                                    ]);
                                                }
                                            ],
                                            'fullname',
                                            'phone',
                                            'email',
                                            'address',
                                            'content:html',
                                            [
                                                'attribute' => 'Category',
                                                'label' => 'Danh mục',
                                                'value' => 'contactCategory.title',
                                            ],
                                            'ip_address',
                                        ], $contactMetadataIndex
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php Pjax::end(); ?>
                </section>
            </div>
        </div>
    </div>
<?php
$urlChangePageSize = \yii\helpers\Url::toRoute(['perpage']);
$script = <<< JS
var customPjax = new myGridView();
customPjax.init({
    pjaxId: '#contact-pjax',
    urlChangePageSize: '$urlChangePageSize',
});
$('body').on('click', '.success-delete', function(e){
    e.preventDefault();
    var url = $(this).attr('href') || null;
    if(url !== null){
        $.post(url);
    }
    return false;
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);