<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form ActiveForm */
?>
<div class="add">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'article_category_id')->dropDownList($options) ?>
        <?php $model->status=1;?>
        <?= $form->field($model, 'status')->radioList(\backend\models\Article::$articleArr) ?>
        <?= $form->field($model, 'sort') ?>
        <?= $form->field($model, 'intro') ?>
        <?= $form->field($detail,'content')->textarea()?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- add -->
