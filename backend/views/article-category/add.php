<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\articlecategory */
/* @var $form ActiveForm */
?>
<div class="articlecategory-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?php $model->status=1?>
        <?= $form->field($model, 'status')->radioList(\backend\models\ArticleCategory::$cateArr) ?>
        <?= $form->field($model, 'intro')->textarea() ?>
        <?= $form->field($model, 'sort') ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- articlecategory-add -->
