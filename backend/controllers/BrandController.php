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
use flyok666\qiniu\Qiniu;


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
        //绑定数据
        if($model->load($request->post())){

            //实例化上传的文件
//            $model->images = UploadedFile::getInstance($model,'images');
//            var_dump($model->images);exit;
            //再次验证
            if($model->validate()){
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
//            $model->images = UploadedFile::getInstance($model,'images');
            //再次验证数据
            if($model->validate()){
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
    //数据上传
    public function actionUpload(){
        //七牛云上传
//var_dump($_FILES);exit;
        $config = [
            'accessKey'=>'MncRJQyt-qSig9XcdanHAxgFmVtu0gx6Z8_weeEJ',
            'secretKey'=>'_R4bhhuCjsVle31bgwEOogMxeLDHPlWYddsiAUWZ',
            'domain'=>'http://oyvj1nrbv.bkt.clouddn.com/',
            'bucket'=>'phpshop',
            'area'=>Qiniu::AREA_HUANAN

        ];



        $qiniu = new Qiniu($config);
        $key = uniqid();
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);

        $info = [
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url
        ];
        exit(json_encode($info));
    }
}