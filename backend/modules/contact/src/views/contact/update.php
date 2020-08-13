<?php

use modava\contact\widgets\NavbarWidgets;
use yii\helpers\Html;
use yii\helpers\Url;
use modava\contact\ContactModule;

/* @var $this yii\web\View */
/* @var $model modava\contact\models\Contact */

$this->title = ContactModule::t('contact', 'Update : {name}', [
    'name' => $model->title,
]);
<<<<<<< HEAD
$this->params['breadcrumbs'][] = ['label' => ContactModule::t('contact', 'Contact'), 'url' => ['index']];
=======
$this->params['breadcrumbs'][] = ['label' => ContactModule::t('contact', 'Contacts'), 'url' => ['index']];
>>>>>>> master
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ContactModule::t('contact', 'Update');
?>
<div class="container-fluid px-xxl-25 px-xl-10">
    <?= NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?= Html::encode($this->title) ?>
        </h4>
<<<<<<< HEAD
=======
        <a class="btn btn-outline-light" href="<?= Url::to(['create']); ?>"
           title="<?= ContactModule::t('contact', 'Create'); ?>">
            <i class="fa fa-plus"></i> <?= ContactModule::t('contact', 'Create'); ?></a>
>>>>>>> master
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </section>
        </div>
    </div>
</div>
