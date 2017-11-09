<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_categroy_id
 * @property integer $brand_id
 * @property string $maker_prcie
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static $saleArr = ['1'=>'是','0'=>'否'];
    public static $staArr = ['1'=>'正常','0'=>'回收站'];
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['goods_categroy_id', 'brand_id', 'stock', 'is_on_sale', 'status', 'sort'], 'integer'],
            [['maker_prcie', 'shop_price'], 'number'],
//            [['create_time'],'string'],
            [['name'], 'string', 'max' => 50],
            [['logo'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'logo' => '商品logo',
            'goods_categroy_id' => '所属分类',
            'brand_id' => '所属品牌',
            'maker_prcie' => '市场价格',
            'shop_price' => '本店价格',
            'stock' => '商品库存',
            'is_on_sale' => '是否上架',
            'status' => '商品状态',
            'sort' => '商品排序',
        ];
    }
    //一对一与商品详情表
    public function getGoodsInter(){
        return $this->hasOne(GoodsIntro::className(),['goods_id'=>'id']);
    }

    //一对多
    public function getGoodGallery(){
        return $this->hasMany(GoodsGallery::className(),['goods_id'=>'id']);
    }
    //一对一 商品分类
    public function getGoodsCategory(){
        return $this->hasOne(GoodsCategory::className(),['id'=>'goods_category_id']);
    }
    //一对一。品牌
    public function getBrand(){
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
}
