<?=\yii\bootstrap\Html::a('添加品牌',['add'],['class'=>'btn btn-success'])?>

<table class="table">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>简介</th>
        <th>图片</th>
        <th>排序</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    <?php foreach ($brands as $brand):?>
        <tr>
            <td><?=$brand->id?></td>
            <td><?=$brand->name?></td>
            <td><?=$brand->intro?></td>
            <td><?=\yii\bootstrap\Html::img($brand->image,['width'=>'100'])?></td>
            <td><?=$brand->sort?></td>
            <td><?=\backend\models\Brand::$statusArr[$brand->status]?></td>
            <td><?php
                echo \yii\bootstrap\Html::a('编辑',['edit','id'=>$brand->id],['class'=>'btn btn-info']);
                echo \yii\bootstrap\Html::a('删除',['del','id'=>$brand->id],['class'=>'btn btn-danger']);
                ?></td>
        </tr>
    <?php endforeach;?>
</table>

<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $page
]);
?>