<?php

use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;
use modava\affiliate\models\Customer;
use modava\affiliate\widgets\JsCreateModalWidget;
use modava\datetime\DateTimePicker;
use modava\website\models\table\KeyValueTable;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use backend\widgets\ToastrWidget;
use modava\affiliate\AffiliateModule;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model modava\affiliate\models\Coupon */
/* @var $form yii\widgets\ActiveForm */
$model->expired_date = $model->expired_date != null
    ? date('d-m-Y', strtotime($model->expired_date))
    : '';

if ($model->primaryKey === null) {
    $model->max_discount = KeyValueTable::getValueByKey('MAX_PROMO_PERCENT_VALUE');
    $model->min_discount = KeyValueTable::getValueByKey('MIN_PROMO_PERCENT_VALUE');
    $model->expired_date = date('d-m-Y', strtotime(date('Y-m-d') . ' +30 days'));
}
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-form']) ?>
    <div class="coupon-form">
        <?php $form = ActiveForm::begin([
            'id' => 'coupon_form',
            'enableAjaxValidation' => true,
            'validationUrl' => Url::toRoute(['/affiliate/coupon/validate', 'id' => $model->primaryKey]),
        ]); ?>
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-6">
                <div class="row m-0">
                    <?php if ($model->primaryKey): ?>
                        <?= $form->field($model, 'coupon_code')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
                    <?php else: ?>
                        <div class="col-8">
                            <?= $form->field($model, 'coupon_code')->textInput(['maxlength' => true,]) ?>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-primary btn-sm"
                                    id="js-generate-coupon-code"><?= Yii::t('backend', 'Generate Coupon Code') ?></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'quantity')->input('number') ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'expired_date')->widget(DatePicker::class, [
                    'addon' => '<button type="button" class="btn btn-increment btn-light"><i class="ion ion-md-calendar"></i></button>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                        'todayHighlight' => true,
                    ],
                    'options' => [
                            'readonly' => true
                    ]
                ]) ?>
            </div>
            <div class="col-6">
                <?php
                $initValueText = '';
                if ($model->customer_id) {
                    $customerModel = Customer::findOne($model->customer_id);
                    $initValueText = $customerModel->full_name . ' - ' . $customerModel->phone;
                }
                ?>

                <?= $form->field($model, 'customer_id')->widget(Select2::class, [
                    'value' => $model->customer_id,
                    'initValueText' => $initValueText,
                    'options' => ['placeholder' => Yii::t('backend', 'Chọn một giá trị ...')],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 3,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                        ],
                        'ajax' => [
                            'url' => Url::toRoute(['/affiliate/customer/get-customer-by-key-word']),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(model) { return model.text; }'),
                        'templateSelection' => new JsExpression('function (model) { return model.text; }'),
                    ],
                ]); ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'coupon_type_id')->dropDownList(
                    ArrayHelper::map(\modava\affiliate\models\table\CouponTypeTable::getAllRecords(), 'id', 'title'),
                    ['prompt' => Yii::t('backend', 'Select an option ...')]
                ) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'promotion_type')->dropDownList(
                    Yii::$app->getModule('affiliate')->params["promotion_type"],
                    [
                        'prompt' => Yii::t('backend', 'Select an option ...'),
                        'id' => 'promotion-type',
                        'options' => [\modava\affiliate\models\Coupon::DISCOUNT_AMOUNT => ['disabled' => true]]
                    ]
                ) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'promotion_value')->textInput(['maxlength' => true, 'type' => 'number']) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'commission_for_owner')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
            </div>
            <div class="col-3">
                <?= $form->field($model, 'min_discount')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
            </div>
            <div class="col-3">
                <?= $form->field($model, 'max_discount')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
            </div>

            <div class="col-12">
                <?= $form->field($model, 'description')->widget(\modava\tiny\TinyMce::class, [
                    'options' => ['rows' => 20],
                    'type' => 'content'
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

<?php
$script = <<< JS
function generateCouponCode() {
    return Math.random(10).toString(36).substr(2);
}

$('#coupon_form #js-generate-coupon-code').on('click', function() {
    /* Comment because change logic for short code*/
    /*let customerId = $('#coupon_form').find('[name="Coupon[customer_id]"]').val();
    if (!customerId) {
        $.toast({
            heading: 'Thông báo',
            text: 'Không có Khách hàng được chọn',
            position: 'top-right',
            class: 'jq-toast-warning',
            hideAfter: 2000,
            stack: 6,
            showHideTransition: 'fade'
        });
        return ;
    }
    
    let loading = $('#coupon_form').closest('.modal-dialog').find('.refresh-container');
    
    loading.show();
    
    if (customerId) {
        generateCouponCode(customerId).then((data) => {
            $('#coupon-coupon_code').val(data).trigger('change');
            loading.fadeOut(300);
        })
    }*/
    $('#coupon-coupon_code').val(generateCouponCodeRandom(true)).trigger('change');
});

$('#coupon_form #coupon-coupon_code').on('change keyup blur', function() {
    $(this).val($(this).val().toUpperCase());  
});

$('#coupon_form [name="Coupon[promotion_value]"]').on('change', function () {
    
    let value = $(this).val() ? parseFloat($(this).val()) : 0;
    $('#coupon_form [name="Coupon[commission_for_owner]"]').val(parseFloat($('#coupon_form [name="Coupon[max_discount]"]').val()) - value);
});
$('#coupon-coupon_code').on('change keyup blur', function() {
    $(this).val($(this).val().toUpperCase());  
});

JS;
$this->registerJs($script, \yii\web\View::POS_END);
