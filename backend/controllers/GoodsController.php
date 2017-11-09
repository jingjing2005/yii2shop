<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7
 * Time: 12:28
 */

namespace backend\controllers;


use backend\models\Brand;
use backend\models\GoodsDayCount;
use backend\models\GoodsGallery;
use backend\models\GoodsIntro;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsSearchForm;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Request;

class GoodsController extends Controller
{
    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    //显示页面
    public function actionIndex(){
        //创建对象
        $query = Goods::find();
        //创建request对象
        $request = \Yii::$app->request;
        //接受搜索框传过来的值
        $data = $request->get("GoodsSearchForm");
        $minp = $data['minprice'];
        $maxp = $data['maxprice'];
        $keyword = $data['keyword'];
//        var_dump($request->get("GoodsSearchForm"));exit;
        //判断最小金额
        if($minp > 0){
            //查询语句
            $query->andwhere("shop_price >= {$minp}");
        }
        //判断最大金额
        if($maxp > 0){
            $query->andwhere("shop_price <= {$maxp}");
        }
        //判断关键字
        if(isset($keyword)){
            $query->andwhere("name like '%{$keyword}%' or sn like '%{$keyword}%'");
        }
        $goods = $query->all();
//        echo "<pre>";
//        var_dump($goods);exit;
        return $this->render('index',['goods'=>$goods]);
    }
    //添加数据

    /**
     * @return string
     */
    public function actionAdd(){
        $model = new Goods();
        //new出商品详情对象
        $intro = new GoodsIntro();
        $gallery = new GoodsGallery();
        //查出商品分类
        $goods = GoodsCategory::find()->orderBy('tree,lft')->all();
        $gid = ArrayHelper::map($goods,'id','nameText');
        //查出品牌
        $brands = Brand::find()->all();
        $bid = ArrayHelper::map($brands,'id','name');
        //创建request对象
        $request = \Yii::$app->request;
        //判断是否是post提交
        if($request->isPost){
//            echo '<pre>';
            //绑定数据
          if($model->load($request->post())) {
              $sn = date('Ymd');

              $goods_one = Goods::find()->where(['like', 'sn', $sn])->orderBy('sn desc')->one();
              if(empty($goods_one)){
                  $sn = $sn.'00001';
              } else {
                  $sn = $goods_one->sn + 1;
              }
              $model->sn = $sn;
              if ($model->validate()) {
                  $model->create_time = time();
                  //保存数据
                  $model->save();
                  //绑定intro和gallery
                  $intro->load($request->post());
                    //获取id
                  $id = $model->attributes['id'];
                  $intro->goods_id = $id;
                          if($intro->validate() ){
                             //保存数据
                              $intro->save();
                              //循环上传的图片
                              $data = $request->post();
                              $paths = $data['GoodsGallery'];
                              if(isset($paths['path']) && is_array($paths['path'])){
                                  foreach ($paths['path'] as $path){
                                      $gallery1 = new GoodsGallery();
                                      //再次验证
                                      if($gallery1->validate()){
                                          $gallery1->goods_id = $id;
                                          //赋值
                                          $gallery1->path = $path;
                                          //保存数据
                                          $gallery1->save();
                                      }
                                  }
                              }
                              //添加成功
                              \Yii::$app->session->setFlash('info','添加成功');
                              return $this->redirect(['index']);
                          }
                      }
                  }
              }
        //显示视图
        return $this->render('add',['model'=>$model,'gid'=>$gid,'bid'=>$bid,'intro'=>$intro,'gallery'=>$gallery]);
    }


    //编辑数据
    public function actionEdit($id){
//        $model = new Goods();
        $model = Goods::findOne($id);
        //new出商品详情对象
//        $intro = new GoodsIntro();
        $intro = GoodsIntro::findOne($id);
        $gallery = new GoodsGallery();
        //根据id获取商品下面的图片
        $goodsPictrue = GoodsGallery::find()->where(['goods_id'=>$id])->all();
        $pathArr = [];
        foreach ($goodsPictrue as $v) {
            $pathArr[] = $v['path'];
        }
        //跟据七牛云规则，将图片地址拼接成字符串
        $gallery->path = implode(',', $pathArr);
        //查出商品分类
        $goods = GoodsCategory::find()->orderBy('tree,lft')->all();
        $gid = ArrayHelper::map($goods,'id','name');
        //查出品牌
        $brands = Brand::find()->all();
        $bid = ArrayHelper::map($brands,'id','name');
        //创建request对象
        $request = \Yii::$app->request;
        //判断是否是post提交
        if($request->isPost){
//            echo '<pre>';
            //绑定数据
            if($model->load($request->post())) {
                if ($model->validate()) {
                    $model->create_time = time();
                    //保存数据
                    $model->save();
                    //绑定intro和gallery
                    $intro->load($request->post());
                    //获取id
                    $id = $model->attributes['id'];
                    $intro->goods_id = $id;
                    if($intro->validate() ){
                        //保存数据
                        $intro->save();
                        //循环上传的图片
                        $data = $request->post();
                        $paths = $data['GoodsGallery'];
                        if(isset($paths['path']) && is_array($paths['path'])){
                            //在修改之前删除原图片，不修改就不删除
                            GoodsGallery::deleteAll('goods_id='.$id);
                            foreach ($paths['path'] as $path){
                                $gallery1 = new GoodsGallery();
                                //绑定数据
//                                  if($gallery->load($path)){
                                //再次验证
                                if($gallery1->validate()){
                                    $gallery1->goods_id = $id;
                                    //赋值
                                    $gallery1->path = $path;
                                    //保存数据
                                    $gallery1->save();
                                }
                            }
                        }
                        //添加成功
                        \Yii::$app->session->setFlash('info','编辑成功');
                        return $this->redirect(['index']);
                    }
                }
            }
        }
        //显示视图
        return $this->render('edit',['model'=>$model,'gid'=>$gid,'bid'=>$bid,'intro'=>$intro,'gallery'=>$gallery]);
    }


    //删除数据
    public function actionDel($id){
        $goods = Goods::findOne($id);
        $intro = GoodsIntro::findOne($id);
        $gallery = GoodsGallery::findOne(['goods_id'=>$id]);
        $goods->delete();
        $intro->delete();
        $gallery->deleteAll();
        //添加成功
        \Yii::$app->session->setFlash('info','删除成功');
        return $this->redirect(['index']);
    }

}