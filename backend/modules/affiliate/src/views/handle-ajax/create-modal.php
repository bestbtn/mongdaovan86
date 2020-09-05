<?php

use modava\affiliate\AffiliateModule;

/* @var $modelName */
/* @var $formPath */
/* @var $model */
?>

<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="refresh-container">
            <div class="loader-pendulums"></div>
        </div>
        <div class="modal-header">
            <h5 class="modal-title"
                id="createCouponModalLabel"><?= Yii::t('backend', 'Create') . ' ' . Yii::t('backend', $modelName) ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="height: 60vh; overflow-y: scroll">
            <?= \Yii::$app->view->renderFile($formPath, ['model' => $model]); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>