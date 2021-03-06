<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7
 * Time: 12:59
 */

?>

<div class="row">
    <div class="col-md-2"><?=\yii\bootstrap\Html::a('添加商品',['add'],['class'=>'btn btn-info']);?></div>

    <div class="col-md-10">
        <?php
            $scarch = new \backend\models\GoodsSearchForm();
         $form = \yii\widgets\ActiveForm::begin([
                 'method' => 'get',
                 'action' => ['index'],
                 'options' => ['class'=>'form-inline pull-right']
         ]);
         echo $form->field($scarch,'minprice')->label(false)->textInput(['size'=>5,'placeholder'=>'最低价']);
         echo "-";
         echo $form->field($scarch,'maxprice')->label(false)->textInput(['size'=>5,'placeholder'=>'最高价']);
         echo " ";
         echo $form->field($scarch,'keyword')->label(false)->textInput(['placeholder'=>'请输入商品名称']);
         echo " ";
         echo \yii\bootstrap\Html::submitButton('搜索',['class'=>'btn btn->success','style'=>'margin-bottom:8px']);

         \yii\widgets\ActiveForm::end();
        ?>

    </div>
</div>


<table class="table">
    <tr>
        <th>商品id</th>
        <th>商品名称</th>
        <th>商品货号</th>
        <th>商品分类</th>
        <th>品牌</th>
        <th>商品logo</th>
        <th>市场价格</th>
        <th>本店售价</th>
        <th>商品库存</th>
        <th>是否上架</th>
        <th>商品状态</th>
        <th>商品排序</th>
        <th>录入时间</th>
        <th>操作</th>
    </tr>
    <?php foreach($goods as $good):?>
    <tr>
        <td><?=$good->id?></td>
        <td><?=$good->name?></td>
        <td><?=$good->sn?></td>
        <td><?=$good->goodsCategory->name?></td>
        <td><?=$good->brand->name?></td>
        <td><?=\yii\bootstrap\Html::img($good->logo,['width'=>'100'])?></td>
        <td><?=$good->maker_prcie?></td>
        <td><?=$good->shop_price?></td>
        <td><?=$good->stock?></td>
        <td><?=\backend\models\Goods::$saleArr[$good->is_on_sale]?></td>
        <td><?=\backend\models\Goods::$staArr[$good->status]?></td>
        <td><?=$good->sort?></td>
        <td><?=date('Y-m-d H:i:s',$good->create_time)?></td>
        <td><?php
            echo \yii\bootstrap\Html::a('编辑',['edit','id'=>$good->id],['class'=>'btn btn-info']);
            echo \yii\bootstrap\Html::a('删除',['del','id'=>$good->id],['class'=>'btn btn-danger']);
            ?></td>
    </tr>
    <?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $page
]);
?>