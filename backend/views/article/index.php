

<table class="table">
    <tr>
        <th>文章id</th>
        <th>文章名称</th>
        <th>文章分类</th>
        <th>文章简介</th>
        <th>文章状态</th>
        <th>文章排序</th>
        <th>文章内容</th>
        <th>录入时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($articles as $article):?>
        <tr>
            <td><?=$article->id?></td>
            <td><?=$article->name?></td>
            <td><?=$article->articleCategory->name; ?></td>
            <td><?=$article->intro?></td>
            <td><?=$article->status?></td>
            <td><?=$article->sort?></td>
            <td><?=\backend\models\Article::$articleArr[$article->status]?></td>
            <td><?=date('Y-m-d H:i:s',$article->inputtime)?></td>
            <td>
                <?php
                echo \yii\bootstrap\Html::a('编辑',['edit','id'=>$article->id],['class'=>'btn btn-info']);
                echo \yii\bootstrap\Html::a('删除',['del','id'=>$article->id],['class'=>'btn btn-danger']);
                ?>
            </td>
        </tr>
    <?php endforeach;?>
</table>


<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $page
]);
?>