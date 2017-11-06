<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/5
 * Time: 17:20
 */

namespace backend\controllers;


use yii\web\Controller;

class TestController extends Controller
{
 public function actionIndex(){
     //显示视图
     return $this->render('index');
 }
}