<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/4
 * Time: 11:02
 */

namespace backend\controllers;


use backend\models\ArticleCategory;
use yii\data\Pagination;
use yii\web\Controller;

class ArticleCategoryController extends Controller
{
        public function actionIndex(){
            //总条数
            $count = ArticleCategory::find()->count();
            //每页显示条数
            $pageSize = 2;
            $page = new Pagination(
                [
                    'pageSize'=>$pageSize,
                    'totalCount'=>$count,
                ]
            );
            $categorys = ArticleCategory::find()->limit($page->limit)->offset($page->offset)->all();

            //显示视图
            return $this->render('index',['categorys'=>$categorys ,'page'=>$pagev]);
        }



        //添加数据
        public function actionAdd(){
            $model = new ArticleCategory();
            //创建request对象
            $request = \Yii::$app->request;
            //绑定数据
            if($model->load($request->post())){
                //再次验证
                if($model->validate()){
                    //保存数据
                    $model->save();
                    //跳转页面
                    $this->redirect(['index']);
                }
            }
            //显示视图
            return $this->render('add',['model'=>$model]);
        }

        //编辑数据

    //添加数据
    public function actionEdit($id){
        $model = ArticleCategory::findOne($id);
        //创建request对象
        $request = \Yii::$app->request;
        //绑定数据
        if($model->load($request->post())){
            //再次验证
            if($model->validate()){
                //保存数据
                $model->save();
                //跳转页面
                $this->redirect(['index']);
            }
        }
        //显示视图
        return $this->render('add',['model'=>$model]);
    }


    //删除数据
    public function actionDel($id){
        $model = ArticleCategory::findOne($id);
        $model->delete();
        $this->redirect(['index']);
    }
}