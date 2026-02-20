<?php

namespace app\controllers;

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\rest\ActiveController;
use yii\rest\Controller;

class UserController extends Controller
{
    public $serializer = [
        'class'              => 'yii\rest\Serializer',
        'collectionEnvelope' => 'users',
    ];

    public function actionIndex(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query'      => User::find()
                ->select([
                    'users.id',
                    'users.first_name',
                    'users.last_name',
                ]),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort'       => [
                'defaultOrder' => [
                    'id' => SORT_ASC
                ]
            ],
        ]);
    }

    public function actionView(int $id)
    {
        $model = User::find()
            ->where(['users.id' => $id])
            ->with('albums')
            ->one();

        return [
            'id'         => $model->id,
            'first_name' => $model->first_name,
            'last_name'  => $model->last_name,
            'albums'     => array_map(fn($album) => [
                'id'    => $album->id,
                'title' => $album->title,
                'link'  => '/albums/' . $album->id,
            ], $model->albums)
        ];
    }
}
