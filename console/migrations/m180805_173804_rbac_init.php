<?php

use yii\base\InvalidRouteException;
use yii\console\Exception;
use yii\db\Migration;

/**
 * Class m180805_173804_rbac_init
 */
class m180805_173804_rbac_init extends Migration
{
    /**
     * @return bool|void
     * @throws InvalidRouteException
     * @throws Exception
     * @throws \yii\base\Exception
     * @throws \Exception
     */
    public function up()
    {
        Yii::$app->runAction('user/create', ['admin@app.localhost', 'admin', 'administrator', '--interactive' => 0]);
        Yii::$app->runAction('user/create', ['testuser@examaple.com', 'test.user', 'testuser', '--interactive' => 0]);

        $auth = Yii::$app->authManager;

        $all = $auth->createPermission('user/*');
        $all->description = 'Universal Acccess';
        $auth->add($all);

        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator';
        $auth->add($admin);
        $auth->assign($admin,1);
        $auth->addChild($admin,$all);
    }

    /**
     * @return bool|void
     * @throws InvalidRouteException
     * @throws Exception
     */
    public function down()
    {
        Yii::$app->authManager->removeAll();

        Yii::$app->runAction('user/delete', ['admin', '--interactive' => 0]);
        Yii::$app->runAction('user/delete', ['test.user', '--interactive' => 0]);

        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->truncateTable('user');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1');
    }

}
