<?php

use modava\affiliate\AffiliateModule;
use modava\affiliate\widgets\NavbarWidgets;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = AffiliateModule::t('affiliate', 'Customer');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid px-xxl-25 px-xl-10">
<?= NavbarWidgets::widget(); ?>

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <div class="dataTables_wrapper dt-bootstrap4">
                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '
                                        {errors}
                                        <div class="row">
                                            <div class="col-sm-12">
                                                {items}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5">
                                                <div class="dataTables_info" role="status" aria-live="polite">
                                                    {pager}
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="dataTables_paginate paging_simple_numbers">
                                                    {summary}
                                                </div>
                                            </div>
                                        </div>
                                    ',
                                    'pager' => [
                                        'firstPageLabel' => AffiliateModule::t('affiliate', 'First'),
                                        'lastPageLabel' => AffiliateModule::t('affiliate', 'Last'),
                                        'prevPageLabel' => AffiliateModule::t('affiliate', 'Previous'),
                                        'nextPageLabel' => AffiliateModule::t('affiliate', 'Next'),
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
                                        'prevPageCssClass' => 'paginate_button page-item',
                                        'nextPageCssClass' => 'paginate_button page-item',
                                        'firstPageCssClass' => 'paginate_button page-item',
                                        'lastPageCssClass' => 'paginate_button page-item',
                                    ],
                                    'columns' => [
                                        [
                                            'class' => 'yii\grid\SerialColumn',
                                            'header' => 'STT',
                                            'headerOptions' => [
                                                'width' => 60,
                                                'rowspan' => 2
                                            ],
                                            'filterOptions' => [
                                                'class' => 'd-none',
                                            ],
                                        ],
                                        'full_name',
                                        [
                                            'label' => 'phone',
                                            'format' => 'raw',
                                            'value' => function ($model) {
                                                $content = '';
                                                if (class_exists('modava\voip24h\CallCenter')) $content .= Html::a('<i class="fa fa-phone"></i>', 'javascript: void(0)', [
                                                    'class' => 'btn btn-xs btn-success call-to',
                                                    'title' => 'Gọi',
                                                    'data-uri' => $model['phone']
                                                ]);
                                                $content .= Html::a('<i class="fa fa-paste"></i>', 'javascript: void(0)', [
                                                    'class' => 'btn btn-xs btn-info copy ml-1',
                                                    'title' => 'Copy'
                                                ]);
                                                return $content;
                                            }
                                        ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => AffiliateModule::t('affiliate', 'Actions'),
                                            'template' => '{create-coupon} {create-call-note}',
                                            'buttons' => [
                                                'create-coupon' => function ($url, $model) {
                                                    return Html::a('<i class="icon dripicons-ticket"></i>', 'javascript:;', [
                                                        'title' => AffiliateModule::t('affiliate', 'Create Coupon'),
                                                        'alia-label' => AffiliateModule::t('affiliate', 'Create Coupon'),
                                                        'data-pjax' => 0,
                                                        'data-customer-info' => json_encode($model),
                                                        'data-partner' => 'myaris',
                                                        'class' => 'btn btn-info btn-xs create-coupon'
                                                    ]);
                                                },
                                                'create-call-note' => function ($url, $model) {
                                                    return Html::a('<i class="icon dripicons-to-do"></i>', 'javascript:;', [
                                                        'title' => AffiliateModule::t('affiliate', 'Create Call Note'),
                                                        'alia-label' => AffiliateModule::t('affiliate', 'Create Call Note'),
                                                        'data-pjax' => 0,
                                                        'data-customer-info' => json_encode($model),
                                                        'data-partner' => 'myaris',
                                                        'class' => 'btn btn-success btn-xs create-call-note'
                                                    ]);
                                                },
                                            ],
                                            'headerOptions' => [
                                                'width' => 150,
                                            ],
                                        ],
                                    ],
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

    <div class="modal fade" id="createCouponModal" tabindex="-1" role="dialog" aria-labelledby="createCouponModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCouponModalLabel"><?=AffiliateModule::t('affiliate', 'Create Coupon')?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>

<?php
$script = <<< JS

$('.create-coupon').on('click', function() {
    let customerInfo = $(this).data('customer-info');
    console.log(customerInfo);
    $('#createCouponModal').modal();
});

JS;
$this->registerJs($script, \yii\web\View::POS_END);