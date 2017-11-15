<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsCategory */
/* @var $form ActiveForm */
?>
<div class="goodscategory-add">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'parent_id')->hiddenInput() ?>
    <?= \liyuze\ztree\ZTree::widget([
        'setting' => '{
           callback:{
                onClick: function(event,treeId,treeNode){
                    $("#goodscategory-parent_id").val(treeNode.id);
                }
           },
			data: {
				simpleData: {
					    enable: true,
			            idKey: "id",
			            pIdKey: "parent_id",
			            rootPId: 0
				}
			}
		}',
        'nodes' => $cate
    ]);
    ?>
        <?= $form->field($model, 'intro')->textarea() ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goodscategory-add -->

<?php
$js=<<<EOF
var treeObj = $.fn.zTree.getZTreeObj("w1");
treeObj.expandAll(true);

var node = treeObj.getNodeByParam("id", "{$model->parent_id}", null);
treeObj.selectNode(node);
EOF;

$this->registerJs($js);


?>