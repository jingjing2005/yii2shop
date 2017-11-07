<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7
 * Time: 12:59
 */
use yii\widgets\ActiveForm;
?>

<?=\yii\bootstrap\Html::a('添加商品',['add'],['class'=>'btn btn-info']);?>



<table class="table">
    <tr>
        <th>商品id</th>
        <th>商品名称</th>
        <th>商品货号</th>
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
        <td><?=\yii\bootstrap\Html::img($good->logo,['width'=>'100'])?></td>
        <td><?=$good->maker_prcie?></td>
        <td><?=$good->shop_price?></td>
        <td><?=$good->stock?></td>
        <td><?=$good->is_on_sale?></td>
        <td><?=$good->status?></td>
        <td><?=$good->sort?></td>
        <td><?=date('Y-m-d H:i:s',$good->create_time)?></td>
        <td><?php
            echo \yii\bootstrap\Html::a('编辑',['edit','id'=>$good->id],['class'=>'btn btn-info']);
            echo \yii\bootstrap\Html::a('删除',['del','id'=>$good->id],['class'=>'btn btn-danger']);
            ?></td>
    </tr>
    <?php endforeach;?>
</table>
