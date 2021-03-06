<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\components\rbac\UserRoleRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $rule = new UserRoleRule();
        $auth->add($rule);

        $user = $auth->createRole('user');
        $user->description = 'User';
        $user->ruleName = $rule->name;
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $admin->description = 'Admin';
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $user);

        $this->stdout('Done!' . PHP_EOL);
    }
}