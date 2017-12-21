# composer

```
#初始化（生成composer.json）
composer init

#安装（读取composer.lock composer.json）
composer install

#更新依赖
composer update
composer update monolog/monolog

#增加新的依赖包
composer require monolog/monolog

#搜索
composer search mongolog

#查看包信息
composer show monolog/monolog

#列出所有可用的软件包
composer show

#依赖性检查
composer depends --link-type=require monolog/monolog

#创建项目
composer create-project topthink/thinkphp mythink
```
