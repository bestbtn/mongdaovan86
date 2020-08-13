<?php

use yii\helpers\Url;
use modava\product\ProductModule;

?>
<ul class="nav nav-tabs nav-sm nav-light mb-25">
    <li class="nav-item mb-5">
<<<<<<< HEAD
        <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == 'product') echo ' active' ?>"
=======
        <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == 'product' && Yii::$app->controller->action->id != 'images') echo ' active' ?>"
>>>>>>> master
           href="<?= Url::toRoute(['/product']); ?>">
            <i class="ion ion-ios-book"></i><?= ProductModule::t('product', 'Product'); ?>
        </a>
    </li>

    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == 'product-category') echo ' active' ?>"
           href="<?= Url::toRoute(['/product/product-category']); ?>"><i
                    class="ion ion-md-apps"></i><?= ProductModule::t('product', 'Product category'); ?></a>
    </li>

    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == 'product-type') echo ' active' ?>"
           href="<?= Url::toRoute(['/product/product-type']); ?>"><i
                    class="ion ion-md-transgender"></i><?= ProductModule::t('product', 'Product type'); ?></a>
    </li>
<<<<<<< HEAD
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == 'product-image') echo ' active' ?>"
           href="<?= Url::toRoute(['/product/product-image']); ?>"><i
                    class="ion ion-md-images"></i><?= ProductModule::t('product', 'Product image'); ?></a>
    </li>
=======
    <?php if (Yii::$app->controller->id == 'product' && Yii::$app->controller->action->id == 'images') { ?>
        <li class="nav-item mb-5">
            <a class="nav-link link-icon-left active" href="<?= Url::toRoute(['/product/product/images', 'id' => Yii::$app->request->get('id')]); ?>">
                <i class="ion ion-md-images"></i><?= ProductModule::t('product', 'Product image'); ?>
            </a>
        </li>
    <?php } ?>
>>>>>>> master
</ul>
