use \yii\helpers\ArrayHelper;

<?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map($data,'id','new_cat_name') ,['prompt' => '请选择父级分类']) ?>