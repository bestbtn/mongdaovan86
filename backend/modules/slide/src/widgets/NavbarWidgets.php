<?php
namespace modava\slide\widgets;

class NavbarWidgets extends \yii\base\Widget
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        if(CONSOLE_HOST == 1)
            return $this->render('navbarWidgets', []);
        else
            return '';
    }
}