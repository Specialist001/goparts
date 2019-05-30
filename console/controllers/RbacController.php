<?php
namespace console\controllers;

use Yii;

class RbacController extends \yii\console\Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем роль "user"
        $user = $auth->createRole('user');
        $auth->add($user);

        $author = $auth->createRole('author');
        $auth->add($author);

        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);

        // добавляем роль "admin"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user);
        $auth->addChild($admin, $moderator);
        $auth->addChild($admin, $author);

        $super_admin = $auth->createRole('super_admin');
        $auth->add($super_admin);
        $auth->addChild($super_admin, $admin);
    }
}
