<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property int     $id
 * @property string  $username
 * @property string  $password
 *
 * @property string  $first_name
 * @property string  $last_name
 *
 * @property string  $auth_key
 * @property string  $accessToken
 *
 * @property Album[] $albums
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public function rules(): array
    {
        return [
            [['id', 'username'], 'required'],
            [['id'], 'integer'],
            [['username', 'first_name', 'last_name'], 'string'],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        unset($fields['username'], $fields['password'], $fields['authKey'], $fields['accessToken']);
        return $fields;
    }

    /**
     * @return ActiveQuery
     */
    public function getAlbums(): ActiveQuery
    {
        return $this->hasMany(Album::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password): bool
    {
        return $this->password === $password;
    }
}
