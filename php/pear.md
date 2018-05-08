# Pear

>Pecl：PHP Extension Community Library，他管理着最底层的PHP扩展。这些扩展是用 C 写的。


>Pear：PHP Extension and Application Repository，他管理着项目环境的扩展。这些扩展是用 PHP 写的。


>Composer：他和PEAR都管理着项目环境的依赖，这些依赖也是用 PHP 写的，区别不大。但 composer 却比 PEAR 来的更受欢迎，即使 PEAR 早出来大概十年。

**一.Pecl基本操作**

```
#安装pecl包
pecl install packageName

#下载但不安装
pecl download packagename

#更新指定pecl包
pecl upgrade packageName

#列出可以升级package
pecl list-upgrades

#列出已安装package
pecl list

#pecl网站上所有可取得pecl库列表
pecl remote-list

#查看已安装的pecl信息
pecl info packageName

#查看pecl的包的信息
pecl remote-info packageName

#搜索pecl包
pecl search packageName

#删除已安装package:
pecl uninstall packagename
```