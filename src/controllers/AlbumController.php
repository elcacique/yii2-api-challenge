<?php

namespace app\controllers;

use app\models\Album;
use yii\data\ActiveDataProvider;

class AlbumController extends \yii\rest\Controller
{
    public $serializer = [
        'class'              => 'yii\rest\Serializer',
        'collectionEnvelope' => 'albums',
    ];

    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query'      => Album::find(),
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
        $model = Album::find()
            ->with('user', 'photos')
            ->where(['id' => $id])
            ->one();

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('Album not found');
        }

        return [
            'id'         => $model->id,
            'first_name' => $model->user->first_name ?? null,
            'last_name'  => $model->user->last_name ?? null,
            'photos'     => array_map(fn($photo) => [
                'title' => $photo->title,
                'url'   => $photo->url,
            ], $model->photos ?? [])
        ];
    }

}
