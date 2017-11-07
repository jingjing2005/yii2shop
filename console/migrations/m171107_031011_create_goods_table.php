<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m171107_031011_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->comment('商品名称'),
            'sn'=>$this->string(15)->comment('商品货号'),
            'logo'=>$this->string(150)->comment('商品logo'),
            'goods_categroy_id'=>$this->integer()->defaultValue(0)->comment('商品分类id'),
            'brand_id'=>$this->integer()->defaultValue(0)->comment('品牌id'),
            'maker_prcie'=>$this->decimal(10,2)->comment('市场价格'),
            'shop_price'=>$this->decimal(10,2)->comment('本店价格'),
            'stock'=>$this->integer()->comment('商品库存'),
            'is_on_sale'=>$this->integer()->comment('是否上架'),
            'status'=>$this->integer()->comment('商品状态'),
            'sort'=>$this->integer()->comment('商品排序'),
            'create_time'=>$this->integer()->comment('商品录入时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
