<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/5
 * Time: 13:13
 */

namespace backend\controllers;


use backend\models\GoodsCategory;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Request;

class GoodsCategoryController extends Controller
{
    //显示
    public function actionIndex(){
        $goods = GoodsCategory::find()->all();
        //显示视图
//        $childs = GoodsCategory::find()->where(['parent_id'=>1])->all();
//        $options = ArrayHelper::map($childs,'id','name');

//            var_dump($options);exit;

        return $this->render('index',['goods'=>$goods]);
    }


    //添加分类
    public function actionAdd(){
        $model = new GoodsCategory();
        $request = \Yii::$app->request;
        $cates = GoodsCategory::find()->asArray()->all();
        $cates[] =['id'=>0,'parent_id'=>0,'name'=>'商品分类'];
        $cate = json_encode($cates);
//        var_dump($cate);exit;
        //判断是不是post提交
        if($request->isPost){
            //绑定数据
            $model->load($request->post());
            //再次验证
            if($model->validate()){
                //判断父级Id为0的时候添加根目录
                if($model->parent_id==0){
                    $model->makeRoot();
                    \Yii::$app->session->setFlash('info','添加根目录成功');
                    $this->redirect(['index']);
                }else{
                    //找到父级ID
                    $parentId = GoodsCategory::findOne(['id'=>$model->parent_id]);
                    if($parentId->depth==0){
                        $model->name = '-----'.$model->name;
                    }
                    if($parentId->depth==1){
                        $model->name = '----------'.$model->name;
                    }
                    if($parentId->depth==2){
                        $model->name = '----------------'.$model->name;
                    }
                    $model->prependTo($parentId);
                    \Yii::$app->session->setFlash("success",'添加目录成功');
                     return $this->redirect(['index']);
                }
            }
        }
        //显示页面
        return $this->render('add',['model'=>$model,'cate'=>$cate]);
    }


    //编辑
    public function actionEdit($id){
        $cate = GoodsCategory::findOne($id);
        $request = \Yii::$app->request;
        $cates = GoodsCategory::find()->asArray()->all();
        $cates[] =['id'=>0,'parent_id'=>0,'name'=>'商品分类'];
        $cate1 = json_encode($cates);
        //判断是不是post提交
        if($request->isPost){
            //绑定数据
            if($cate->load($request->post())){
                //再次验证
                if($cate->validate()){
                    try{
                        $cate->makeRoot();
                    }catch (Exception $e){
                        \Yii::$app->session->setFlash('danger','不能将根目录修改并且不能将父分类添加到子分类里面');
                        return $this->redirect(['index']);
                    }
                    \Yii::$app->session->setFlash('info','编辑成功');
                    //跳转页面
                     return $this->redirect(['index']);
                }
            }
        }
        //显示页面
        return $this->render('edit',['cate'=>$cate,'cate1'=>$cate1]);
    }


    //删除数据
    public function actionDel($id){
        $good = GoodsCategory::findOne($id);
        //查询出所有数据
        $cates = GoodsCategory::find()->where(['parent_id'=>$id])->all();

        if(!empty($cates)){
            \Yii::$app->session->setFlash('danger','此分类下面有子分类，不能被删除');
            return $this->redirect(['index']);
        }else{
           try{
               $good->delete();
           }catch (Exception $e){
               \Yii::$app->session->setFlash('danger','不能删除根目录');
               return $this->redirect(['index']);
           }

            \Yii::$app->session->setFlash('info','删除成功');
            return $this->redirect(['index']);
        }
    }
}