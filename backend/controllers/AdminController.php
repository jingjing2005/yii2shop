<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 14:40
 */

namespace backend\controllers;


use backend\models\Admin;
use backend\models\LoginForm;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $admins = Admin::find()->all();
        //显示视图
        return $this->render('index',['admins'=>$admins]);
    }

    //注册管理员
    public function actionAdd(){
        $model = new Admin();
        //创建request模型
        $request = \Yii::$app->request;
        //判断是不是post提交
        if($request->isPost){
            //绑定数据
            if($model->load($request->post())){
                //密码加密
                $model->password_hash = \Yii::$app->security->generatePasswordHash($model->password_hash);
                //自动登录令牌生成
                $model->auth_key = \Yii::$app->security->generateRandomString();
                //注册时间
                $model->add_time = time();
                //再次验证
                if($model->validate()){
                    $model->save();
                    //跳转页面
                    \Yii::$app->session->setFlash('info','注册成功');
                    return $this->redirect(['index']);
                }
            }
        }
        //显示视图
        return $this->render('add',['model'=>$model]);
    }
    
    //登录
    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        //创建request对象
        $request = \Yii::$app->request;
        //判断是不是post提交
        if($request->post()){
//            echo "<pre>";
//            var_dump($_SERVER);exit;
            //绑定数据
            $model->load($request->post());
               //再次验证
            if($model->validate()){
                //根据用户名把用户对象找出来
                $admin = Admin::findOne(['username'=>$model->username]);
                if($admin){
                    //如果存在再判断密码
                    if(\Yii::$app->security->validatePassword($model->password,$admin->password_hash)){
                        //登录
                        \Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);
                        $admin->last_login_time = time();
                        $admin->last_login_ip = $_SERVER['REMOTE_ADDR'];
                        $admin->save();
                        return $this->redirect(['index']);
                    }else{
                        \Yii::$app->session->setFlash('danger','密码错误');
                    }
                }else{
                    \Yii::$app->session->setFlash('danger','用户名不存在');
                }
            }
        }
        //显示视图
        return $this->render('login', ['model' => $model]);
    }

    //退出登录
    public function actionLogout()
    {
      \Yii::$app->user->logout();
      return $this->redirect(['login']);
    }

    //删除数据
    public function actionDel($id){
        $admin = Admin::findOne($id);
        $admin->delete();
        //刷新
        return $this->redirect(['index']);
    }
}