<?php


namespace frontend\controllers;


use frontend\components\MyController;

class ContactUsController extends MyController
{
    public function actionIndex(){
        return $this->render('index',[]);
    }
}