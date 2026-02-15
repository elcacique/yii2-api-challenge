<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "photos".
 *
 * @property int $id
 * @property int $album_id
 * @property string $title
 * @property string $url
 *
 * @property Album $album
 */
class Photo extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'photos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['album_id', 'title', 'url'], 'required'],
            [['album_id'], 'default', 'value' => null],
            [['album_id'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Albums::class, 'targetAttribute' => ['album_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'album_id' => 'Album ID',
            'title' => 'Title',
            'url' => 'Url',
        ];
    }

    /**
     * Gets query for [[Album]].
     *
     * @return ActiveQuery
     */
    public function getAlbum(): ActiveQuery
    {
        return $this->hasOne(Album::class, ['id' => 'album_id']);
    }

}
