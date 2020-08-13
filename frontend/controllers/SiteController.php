<?php

namespace frontend\controllers;

use frontend\models\LoginForm;
use frontend\models\Products;
use frontend\components\MyController;
use frontend\models\SignupForm;
use modava\kenne\models\Account;

class SiteController extends MyController
{
    public function actionIndex()
    {
        $model = new Products();
        $proNew = $model->getProductLimitNumber(6);
        $proBags = $model->getProductsByCategories(7);
        $proShirts = $model->getProductsByCategories(6);
        $proShoes = $model->getProductsByCategories(8);
        $dataBestSeller = $model->getBestSellerProduct();
        return $this->render('index', [
            'data' => $proNew,
            'proBags' => $proBags,
            'proShirts' => $proShirts,
            'proShoes' => $proShoes,
            'dataBestSeller' => $dataBestSeller
        ]);
    }

    public function actionLogin()
    {
        /*if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }*/
        if (!\Yii::$app->user->isGuest) {
            return $this->goBack();
        }
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            \Yii::$app->session->setFlash('success', 'Đăng nhập thành công');
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(\Yii::$app->request->post()) && $model->signup()) {
            \Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->redirect('/site/login');
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
