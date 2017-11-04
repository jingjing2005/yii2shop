<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $article_category_id
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property string $inputtime
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
        public static $articleArr = ['0'=>'否','1'=>'是'];
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
            [['article_category_id', 'status', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'name' => '文章名称',
            'article_category_id' => '文章分类id',
            'intro' => '文章简介',
            'status' => '状态',
            'sort' => '排序',
            'inputtime' => '录入时间',
        ];
    }

    //一对一
    public function getArticleCategory(){
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }

    //一对一
    public function getDetail(){
        return $this->hasOne(ArticleDetail::className(),['article_id'=>'id']);
    }
}
