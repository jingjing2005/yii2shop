<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $type
 */
class ArticleCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
        //设置状态
        public static $cateArr = ['1'=>'是','0'=>'否'];
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'intro' => '分类简介',
            'status' => '分类状态',
            'sort' => '分类排序',
            'type' => '分类类型',
        ];
    }

    //一对多
    public function getArticle(){
        return $this->hasMany(Article::className(),['article_category_id'=>'id']);
    }
}
