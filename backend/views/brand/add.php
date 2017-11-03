<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\brand */
/* @var $form ActiveForm */
?>
<div class="brand-add">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'sort') ?>
         <?php $model->status=1;?>
        <?= $form->field($model, 'status')->radioList(\backend\models\Brand::$statusArr) ?>
        <?= $form->field($model, 'intro') ?>
        <?= $form->field($model, 'images')->fileInput(['multipe'=>true]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- brand-add -->
