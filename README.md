### 项目日志
#### 项目描述
* 类似京东商城的B2C商城 (C2C B2B O2O P2P ERP进销存 CRM客户关系管理)
* 电商或电商类型的服务在目前来看依旧是非常常用，虽然纯电商的创业已经不太容易，但是各个公司都有变现的需要，所以在自身应用中嵌入电商功能是非常普遍的做法。
* 为了让大家掌握企业开发特点，以及解决问题的能力，我们开发一个电商项目，项目会涉及非常有代表性的功能。
* 为了让大家掌握公司协同开发要点，我们使用git管理代码。
*  在项目中会使用很多前面的知识，比如架构、维护等等。
#### 主要功能模块
* 后台：品牌管理 商品分类管理 商品管理 订单管理 系统管理和会员管理六个功能模块
* 前台：首页 商品展示 商品购买 订单管理 在线支付
#### 开发环境和技术
* 开发环境 Window
* 开发工具 Phpstrom+PHP5.6+GIT+Apache
* 相关技术 Yii2.0+CDN+jquery+sphinx
#### 人员组成
* 项目经理  1人
* 开发人员 3人
* 前端开发人员 1人
* 测试人员 1人
#### 文章分类和文章管理模块
* 文章分类和文章管理，首先完成基本的增删改查功能。
* 在文章添加的时候涉及到同时向两张表里面添加数据，先添加文章表，再将刚添加进去的数据的id查询出来，再添加文章内容。
#### 商品无限极分类设计要点
~~~
$this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('名称'),
            'parent_id'=>$this->integer()->notNull()->defaultValue(0)->comment('父级ID'),
            'tree' => $this->integer()->notNull()->comment('树'),
            'lft' => $this->integer()->notNull()->comment('左值'),
            'rgt' => $this->integer()->notNull()->comment('右值'),
            'depth' => $this->integer()->notNull()->comment('级别'),
            'intro'=>$this->string()->comment('简介'),
        ]);
~~~
#### 需求
* 商品分类的增删改查
* 添加商品分类用ztree插件
#### 要点难点
* ztree插件原本就把健壮性做好了，在编辑和删除分类的时候，只需要异常捕获错误信息，再修改一下就可以。

