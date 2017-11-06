<?php

?>
<?=\yii\bootstrap\Html::a('添加分类',['add'],['class'=>'btn btn-info']);?>

<table class="table">
    <tr>

        <th>分类名称</th>
        <th>操作</th>

    </tr>
<?php foreach ($goods as $good):?>
    <tr>
     <td><?=$good->name?></td>
        <td>
            <?php
        echo \yii\bootstrap\Html::a('编辑',['edit','id'=>$good->id],['class'=>'btn btn-info']);
        echo \yii\bootstrap\Html::a('删除',['del','id'=>$good->id],['class'=>'btn btn-danger']);
        ?>
        </td>
    </tr>
<?php endforeach;?>
</table>