<?php

?>
<?=\yii\bootstrap\Html::a('添加分类',['add'],['class'=>'btn btn-info']);?>

<table class="table">
    <tr>
        <th>ID</th>
        <th>分类名称</th>

        <th>操作</th>

    </tr>
<?php foreach ($goods as $good):?>

    <tr data-tree='<?=$good->tree?>' data-lft='<?=$good->lft?>' data-rgt='<?=$good->rgt?>'>
        <td><?=$good->id?></td>
        <td>
            <?=$good->NameText?>
            <span class="glyphicon glyphicon-menu-down expand" style="float: right"></span>
        </td>
        <td>
            <?php
        echo \yii\bootstrap\Html::a('编辑',['edit','id'=>$good->id],['class'=>'btn btn-info']);
        echo \yii\bootstrap\Html::a('删除',['del','id'=>$good->id],['class'=>'btn btn-danger']);
        ?>
        </td>
    </tr>
<?php endforeach;?>
</table>

<?php
$js=<<<EOT
    $(".expand").click(function(){
        $(this).toggleClass("glyphicon-menu-down");
        $(this).toggleClass("glyphicon-menu-up");
        var tr = $(this).closest("tr");
        var p_lft = tr.attr("data-lft");
        var p_rgt = tr.attr("data-rgt");
        var p_tree= tr.attr("data-tree");
        $("tbody tr").each(function(){
            var lft = $(this).attr("data-lft");
            var rgt = $(this).attr("data-rgt");
            var tree = $(this).attr("data-tree");
            
            
            if(tree - p_tree==0 &&　lft-p_lft>0 && rgt-p_rgt<0){
            console.dir(typeof tree);
            console.dir(p_tree);
            console.dir(lft);
            console.dir(rgt);
                $(this).fadeToggle();
            }
        });
    });
EOT;
$this->registerJs($js);