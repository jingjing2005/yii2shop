<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
        public $images;
        public static $statusArr = ['-1'=>'删除','0'=>'隐藏','1'=>'显示'];
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['intro',], 'string', 'max' => 255],
            [['images'],'file','extensions'=>['jpg','gif','png'],'skipOnEmpty'=>true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'logo' => '上传图片',
            'images' => '图片',
            'sort' => '排序',
            'status' => '状态',
        ];
    }

//    public function getImage(){
//        if(substr($this->logo,0,7)=='http://'){
//            return $this->logo;
//        }else{
//            return '@web'.$this->logo;
//        }
//
//    }
}
