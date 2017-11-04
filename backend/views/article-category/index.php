<?php
    echo \yii\bootstrap\Html::a('添加分类',['add',],['class'=>'btn btn-success']);
?>
<table class="table">
    <tr>
        <th>分类ID</th>
        <th>分类名称</th>
        <th>分类简介</th>
        <th>分类状态</th>
        <th>分类排序</th>
        <th>操作</th>
    </tr>
    <?php foreach ($categorys as $category):?>
        <tr>
            <td><?=$category->id?></td>
            <td><?=$category->name?></td>
            <td><?=$category->intro?></td>
            <td><?=$category->status?></td>
            <td><?=$category->sort?></td>
            <td><?php
                echo \yii\bootstrap\Html::a('编辑',['edit','id'=>$category->id],['class'=>'btn btn-info']);
                echo \yii\bootstrap\Html::a('删除',['del','id'=>$category->id],['class'=>'btn btn-danger']);

                ?></td>
        </tr>
    <?php endforeach;?>
</table>

<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $page
]);
?>