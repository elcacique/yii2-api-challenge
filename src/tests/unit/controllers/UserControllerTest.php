<?php

namespace app\tests\unit\controllers;

use app\controllers\UserController;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    public function testActionIndex()
    {
        $controller = new UserController('id', \Yii::$app);
        verify($controller->actionIndex())->notNull();
    }

    public function testActionView()
    {
        $controller = new UserController('id', \Yii::$app);
        verify($controller->actionView(1))->notNull();
    }
}
