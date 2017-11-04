<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/4
 * Time: 13:48
 */

namespace backend\controllers;


use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetail;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ArticleController extends Controller
{
        public function actionIndex(){
            $count = Article::find()->count();
            $pageSize = 4;
            $page = new Pagination(
                [
                    'pageSize'=>$pageSize,
                    'totalCount'=>$count,
                ]
            );

            $articles = Article::find()->limit($page->limit)->offset($page->offset)->all();

            //显示视图
            return $this->render('index',['articles'=>$articles,'page'=>$page]);
        }

        //添加数据
    public function actionAdd(){
            $model = new Article();
            $cates = ArticleCategory::find()->all();
            $options = ArrayHelper::map($cates,'id','name');
            $detail = new ArticleDetail();
            //创建request对象
            $request = \Yii::$app->request;
            if($request->isPost){
//                var_dump($request->post());exit;
                //绑定数据
                if($model->load($request->post())){
//                    var_dump($detail->load($request->post()));exit;
                    //再次验证
                    if($model->validate()){
                        $model->inputtime=time();
                        //保存数据
//                      var_dump($model->save());
                        $model->save();


//                        var_dump($id);exit;
                        if($detail->load($request->post())){
                            if($detail->validate()){
                                $id = $model->attributes['id'];
                                $detail->article_id = $id;
                                $detail->save();
                                //跳转页面
                                \Yii::$app->session->setFlash('success','添加成功');
                            }else{
                                \Yii::$app->session->setFlash('danger','添加失败');
                            }
                        }
                        return  $this->redirect(['index']);
                    }
                }
            }
            //显示视图
            return $this->render('add',['model'=>$model,'options'=>$options,'detail'=>$detail]);
    }

    //编辑
    public function actionEdit($id){
        $model = Article::findOne($id);
        $cates = ArticleCategory::find()->all();
        $options = ArrayHelper::map($cates,'id','name');
        $detail = ArticleDetail::findOne($id);
        //创建request对象
        $request = \Yii::$app->request;
        if($request->isPost){
//                var_dump($request->post());exit;
            //绑定数据
            if($model->load($request->post())){
//                    var_dump($detail->load($request->post()));exit;
                //再次验证
                if($model->validate()){
                    $model->inputtime=time();
                    //保存数据
//                      var_dump($model->save());
                    $model->save();


//                        var_dump($id);exit;
                    if($detail->load($request->post())){
                        if($detail->validate()){
                            $id = $model->attributes['id'];
                            $detail->article_id = $id;
                            $detail->save();
                            //跳转页面
                            \Yii::$app->session->setFlash('success','修改成功');
                        }else{
                            \Yii::$app->session->setFlash('danger','修改失败');
                        }
                    }
                    return  $this->redirect(['index']);
                }
            }
        }
        //显示视图
        return $this->render('add',['model'=>$model,'options'=>$options,'detail'=>$detail]);
    }

    //删除数据
    public function actionDel($id){
        $model = Article::findOne($id);
        $detail = ArticleDetail::findOne($id);
        $model->delete();
        $detail->delete();
        \Yii::$app->session->setFlash('success','删除成功');
        $this->redirect(['index']);
    }
}