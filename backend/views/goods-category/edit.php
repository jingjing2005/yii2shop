<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsCategory */
/* @var $form ActiveForm */
?>
<div class="goodscategory-add">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($cate, 'name') ?>
        <?= $form->field($cate, 'parent_id') ?>
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
        'nodes' => $cate1
    ]);
    ?>
        <?= $form->field($cate, 'intro') ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
<?php
$js=<<<EOF
var treeObj = $.fn.zTree.getZTreeObj("w1");
treeObj.expandAll(true);

var node = treeObj.getNodeByParam("id", "{$cate->parent_id}", null);
treeObj.selectNode(node);
EOF;

$this->registerJs($js);


?>
