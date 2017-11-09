<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171109_055659_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('用户名'),
            'password_hash' => $this->string()->notNull()->comment('密码'),
            'email' => $this->string()->notNull()->unique()->comment('邮箱'),
            'auth_key' => $this->string(32)->notNull()->comment('自动登录令牌'),
            'add_time' => $this->integer()->notNull()->comment('注册时间'),
            'last_login_time' => $this->integer()->notNull()->comment('最后登陆时间'),
            'last_login_ip'=>$this->string(15)->notNull()->comment('最后登录ip')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
