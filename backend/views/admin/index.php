<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 14:42
 */
?>

<?=\yii\bootstrap\Html::a('注册用户',['add'],['class'=>'btn btn-success'])?>
<table class="table">
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>邮箱</th>
        <th>注册时间</th>
        <th>登录时间</th>
        <th>登录IP</th>
        <th>操作</th>
    </tr>
    <?php foreach($admins as $admin):?>
        <tr>
            <td><?=$admin->id?></td>
            <td><?=$admin->username?></td>
            <td><?=$admin->email?></td>
            <td><?=date('Y-m-d H:i:s',$admin->add_time)?></td>
            <td><?=date('Y-m-d H:i:s',$admin->last_login_time)?></td>
            <td><?=$admin->last_login_ip?></td>
            <td>
                <?php
                echo \yii\bootstrap\Html::a('编辑',['edit','id'=>$admin->id],['class'=>'btn btn-info']);
                echo \yii\bootstrap\Html::a('删除',['del','id'=>$admin->id],['class'=>'btn btn-danger']);
                ?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
