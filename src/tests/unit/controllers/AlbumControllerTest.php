<?php

namespace tests\unit\controllers;

use app\controllers\AlbumController;
use PHPUnit\Framework\TestCase;

class AlbumControllerTest extends TestCase
{
    public function testActionIndex()
    {
        $controller = new AlbumController('id', \Yii::$app);
        verify($controller->actionIndex())->notNull();
    }

    public function testActionView()
    {
        $controller = new AlbumController('id', \Yii::$app);
        verify($controller->actionView(1))->notNull();
    }
}
