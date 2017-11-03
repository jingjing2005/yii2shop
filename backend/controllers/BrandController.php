<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3
 * Time: 15:51
 */

namespace backend\controllers;


use backend\models\Brand;
use yii\bootstrap\Html;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\UploadedFile;

class BrandController extends Controller
{
    //显示页面
    public function actionIndex(){


        //总条数
        $count = Brand::find()->count();
        //每页显示条数
        $pageSize = 3;
        //创建分页对象
        $page = new Pagination(
            [
                'pageSize'=>$pageSize,
                'totalCount'=>$count,
            ]
        );
        $brands = Brand::find()->limit($page->limit)->offset($page->offset)->all();
        //显示视图
        return $this->render('index',['brands'=>$brands,'page'=>$page]);
    }

    //添加数据
    public function actionAdd(){
        $model = new Brand();
        //创建request对象
        $request = \Yii::$app->request;
        //默认的图片
        $oldFile = 'images/1.jpg';

//        var_dump($oldFile);exit;
//        var_dump($model->load($request->post()));exit;
        //绑定数据
        if($model->load($request->post())){

            //实例化上传的文件
            $model->images = UploadedFile::getInstance($model,'images');
//            var_dump($model->images);exit;
            //再次验证
            if($model->validate()){
                //判断是否有文件传过来
                if($model->images){
                    //拼接文件名
                    $filePath = 'images/'.time().'.'.$model->images->extension;
//                var_dump($filePath);exit;
                    //保存文件
                    $model->images->saveAs($filePath,false);
                    //保存
                    $model->logo = $filePath;
                }else{
                    //保存
                    $model->logo = $oldFile;
//                    var_dump($model->logo);exit;
                }
                //保存数据
                $model->save();
                //跳转页面
                return $this->redirect(['index']);
            }
        }
        //显示视图
        return $this->render('add',['model'=>$model]);
    }


    //编辑数据
    public function actionEdit($id){
        $model = Brand::findOne($id);
//        var_dump($model);exit;
        //创建request
        $request = \Yii::$app->request;
        //绑定数据
        if($model->load($request->post())){
            //实例化上传文件
            $model->images = UploadedFile::getInstance($model,'images');
            //再次验证数据
            if($model->validate()){
                //判断是否有图片传过来
                if($model->images){
                    //拼接文件名
                    $filePath = 'images/'.time().'.'.$model->images->extension;
                    //保存文件
                    $model->images->saveAs($filePath,false);
                    //保存
                    $model->logo = $filePath;
                }
                //保存数据
                $model->save();
                //跳转页面
                $this->redirect(['index']);
            }
        }
        //显示视图
        return $this->render('edit',['model'=>$model]);
    }


    //删除数据
    public function actionDel($id){
        $brand = Brand::findOne($id);
        $brand->delete();
        return $this->redirect('index');
    }
}