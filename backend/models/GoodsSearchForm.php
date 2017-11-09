<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8
 * Time: 19:34
 */

namespace backend\models;


use yii\base\Model;

class GoodsSearchForm extends Model
{

    public $minprice;
    public $maxprice;
    public $keyword;

    public function rules()
    {
        return [
            [['maxprice','minprice'],'number','message' => ''],
            [['keyword'],'string']
        ];
    }
}