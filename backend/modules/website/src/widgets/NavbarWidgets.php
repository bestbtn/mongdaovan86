<?php
namespace modava\website\widgets;

class NavbarWidgets extends \yii\base\Widget
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
<<<<<<< HEAD
        return $this->render('navbarWidgets', []);
=======
        if(CONSOLE_HOST == 1)
            return $this->render('navbarWidgets', []);
        else
            return '';
>>>>>>> master
    }
}