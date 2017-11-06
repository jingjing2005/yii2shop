<?php
//$js = <<<JS
//    $("#").chick(function(){
//        console.log(111);
//    })
//JS;
//$this->registerJs($js);
//
?>

<?php
use yii\bootstrap\Collapse;

echo Collapse::widget([
    'items' => [
        // equivalent to the above
        [
            'label' => '折叠1',
            'content' => '<a href="aaa">--内容1</a>',
            // open its content by default
            'contentOptions' => ['class' => 'in']
        ],
        // another group item
        [
            'label' => '折叠2',
            'content' => '<a href="aaa">--内容2</a>',
        ],
        // if you want to swap out .panel-body with .list-group, you may use the following
        [
            'label' => '折叠3',
            'content' => [
                '<a href="aaa">--内容3-1</a>',
                '<a href="aaa">--内容3-2</a>'
            ],
            'footer' => 'Footer' // the footer label in list-group
        ],
    ]
]);
?>
