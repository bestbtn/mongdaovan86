<?php

use modava\affiliate\AffiliateModule;
use modava\affiliate\helpers\Utils;
use yii\helpers\Url;

// Define route info
$routeInfos = [
    [
        'module' => 'affiliate',
        'controllerId' => 'affiliate',
        'model' => 'Affiliate',
        'label' => AffiliateModule::t('affiliate', 'Affiliate'),
        'icon' => '<i class="ion ion-md-contacts"></i>',
    ],
    [
        'module' => 'affiliate',
        'controllerId' => 'customer',
        'model' => 'Customer',
        'label' => AffiliateModule::t('affiliate', 'Customer Called'),
        'icon' => '<i class="ion ion-md-contacts"></i>',
    ],
    [
        'module' => 'affiliate',
        'controllerId' => 'note',
        'model' => 'Note',
        'label' => AffiliateModule::t('affiliate', 'Note'),
        'icon' => '<span class="material-icons">event_note</span>',
    ],
    [
        'module' => 'affiliate',
        'controllerId' => 'coupon',
        'model' => 'Coupon',
        'label' => AffiliateModule::t('affiliate', 'Coupon'),
        'icon' => '<i class="icon dripicons-ticket"></i>',
    ],
    [
        'module' => 'affiliate',
        'controllerId' => 'order',
        'model' => 'Order',
        'label' => AffiliateModule::t('affiliate', 'Order'),
        'icon' => '<i class="glyphicon glyphicon-ok-circle"></i>',
    ],
    [
        'module' => 'affiliate',
        'controllerId' => 'coupon-type',
        'model' => 'CouponType',
        'label' => AffiliateModule::t('affiliate', 'Coupon Type'),
        'icon' => '<i class="ion ion-md-analytics"></i>',
    ],
    [
        'module' => 'affiliate',
        'controllerId' => 'partner',
        'model' => 'Partner',
        'label' => AffiliateModule::t('affiliate', 'Partners'),
        'icon' => '<i class="fa fa-share-alt"></i>',
    ],
    [
        'module' => 'affiliate',
        'controllerId' => 'feedback',
        'model' => 'Feedback',
        'label' => AffiliateModule::t('affiliate', 'Feedback'),
        'icon' => '<span class="material-icons">feedback</span>',
    ],
    [
        'module' => 'affiliate',
        'controllerId' => 'feedback-time',
        'model' => 'FeedbackTime',
        'label' => AffiliateModule::t('affiliate', 'Feedback Time'),
        'icon' => '<span class="material-icons">feedback</span>',
    ],
    [
        'module' => 'affiliate',
        'controllerId' => 'unsatisfied-reason',
        'model' => 'UnsatisfiedReason',
        'label' => AffiliateModule::t('affiliate', 'Unsatisfied Reason'),
        'icon' => '<span class="material-icons">face</span>',
    ],
    [
        'module' => 'affiliate',
        'controllerId' => 'receipt',
        'model' => 'Receipt',
        'label' => AffiliateModule::t('affiliate', 'Receipt'),
        'icon' => '<span class="material-icons">face</span>',
    ],
];
?>
<ul class="nav nav-tabs nav-sm nav-light mb-10">
    <?php foreach ($routeInfos as $routeInfo):
        if (Utils::isReleaseObject($routeInfo['model'])):?>
            <li class="nav-item mb-5">
                <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == $routeInfo['controllerId']) echo ' active' ?>"
                   href="<?= Url::toRoute(["/{$routeInfo['module']}/{$routeInfo['controllerId']}"]); ?>">
                    <?= $routeInfo['icon'] . AffiliateModule::t($routeInfo['module'], $routeInfo['label']); ?>
                </a>
            </li>
        <?php endif;
    endforeach; ?>
</ul>
