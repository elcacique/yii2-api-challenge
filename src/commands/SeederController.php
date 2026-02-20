<?php

namespace app\commands;

use app\models\Album;
use app\models\Photo;
use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Exception;

class SeederController extends Controller
{
    /**
     * Make demo users
     *
     * @param int $numberOfUsers
     * @return int
     */
    public function actionMakeUsers(int $numberOfUsers = 10): int
    {
        try {
            User::deleteAll();
            \Yii::$app->db->createCommand("ALTER SEQUENCE users_id_seq RESTART WITH 1")->execute();

            $faker = \Faker\Factory::create();
            foreach (range(1, $numberOfUsers) as $i) {

                $user = new User();
                $user->username = "user_$i";
                $user->first_name = $faker->firstName;
                $user->last_name = $faker->lastName;

                $password = $faker->password;
                $user->password = \Yii::$app->getSecurity()->generatePasswordHash($password);
                $user->authKey = \Yii::$app->getSecurity()->generateRandomString();
                $user->accessToken = \Yii::$app->security->generateRandomString();

                if ($user->save(false)) {
                    $user->refresh();
                    echo "Создан пользователь #{$user->id}  \t-> {$user->username}  \t-> {$password}\n";
                } else {
                    echo "Ошибка при создании user_$i:\n";
                    echo print_r($user->errors, true) . PHP_EOL;
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return ExitCode::OK;
    }

    /**
     * Make demo albums for each user
     *
     * @return int
     * @throws Exception
     */
    public function actionMakeAlbums(int $numberOfAlbums = 10)
    {
        Album::deleteAll();
        \Yii::$app->db->createCommand("ALTER SEQUENCE albums_id_seq RESTART WITH 1")->execute();

        $users = User::find()->all();
        foreach ($users as $user) {
            foreach (range(1, $numberOfAlbums) as $i) {
                $album = new Album();
                $album->user_id = $user->id;
                $album->title = "Album {$i} of user {$user->id}";
                print_r($album->attributes);
                $album->save();
            }
        }

        return ExitCode::OK;
    }

    /**
     * Make demo photos for each album
     *
     * @return int
     * @throws Exception
     */
    public function actionMakePhotos(): int
    {
        Photo::deleteAll();
        \Yii::$app->db->createCommand("ALTER SEQUENCE photos_id_seq RESTART WITH 1")->execute();

        $albums = Album::find()->all();
        foreach ($albums as $album) {
            foreach (range(1, 10) as $i) {
                $photo = new Photo();
                $photo->album_id = $album->id;
                $photo->title = "Photo $i";
                $photo->save();
            }
        }

        return ExitCode::OK;
    }

    /**
     * Remove all records from users, albums and photos tables
     *
     * @return int
     * @throws Exception
     */
    public function actionClean(): int
    {
        User::deleteAll();
        \Yii::$app->db
            ->createCommand("ALTER SEQUENCE users_id_seq RESTART WITH 1")
            ->execute();

        Album::deleteAll();
        \Yii::$app->db
            ->createCommand("ALTER SEQUENCE albums_id_seq RESTART WITH 1")
            ->execute();

        Photo::deleteAll();
        \Yii::$app->db
            ->createCommand("ALTER SEQUENCE photos_id_seq RESTART WITH 1")
            ->execute();

        return ExitCode::OK;
    }
}