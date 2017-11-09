<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form ActiveForm */
?>

<div class="goods-add">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'goods_categroy_id')->dropDownList($gid) ?>

        <?= $form->field($model, 'brand_id')->dropDownList($bid) ?>
        <?= $form->field($model, 'stock') ?>
        <?php $model->is_on_sale=1;?>
        <?= $form->field($model, 'is_on_sale')->radioList(\backend\models\Goods::$saleArr) ?>
        <?php $model->status=1;?>
        <?= $form->field($model, 'status')->radioList(\backend\models\Goods::$staArr) ?>
        <?= $form->field($model, 'sort') ?>
        <?= $form->field($model, 'maker_prcie') ?>
        <?= $form->field($model, 'shop_price') ?>
        <?=$form->field($model, 'logo')->widget('manks\FileInput', []);?>
        <?= $form->field($intro,'content')->widget('kucha\ueditor\UEditor',[]);?>
    <?php
    echo $form->field($gallery, 'path')->widget('manks\FileInput', [
        'clientOptions' => [
            'pick' => [
                'multiple' => true,
            ],
        ],
    ]);
    ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goods-add -->
