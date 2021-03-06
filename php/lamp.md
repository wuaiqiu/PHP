# LAMP(Linux+Apache+Mysql+PHP)


#### 一.安装apache

```
	/etc/httpd/conf/ :apache的配置文件夹

	/etc/httpd/modules/ ：apache的模块文件夹

	/srv/http/ :apache的初始站点文件夹
```

<br>

#### 二.安装php

```
	(1)安装php53
	(2)安装php53-apache
	(3)apache装载php模块(修改/etc/httpd/conf/httpd.conf)

	============================================================================
	注释（libphp5.so 不支持 mod_mpm_event，仅支持 mod_mpm_prefork）
	LoadModule mpm_event_module modules/mod_mpm_event.so
	打开
	LoadModule mpm_prefork_module modules/mod_mpm_prefork.so
	添加
	LoadModule php5_module modules/libphp53.so
	Include conf/extra/php53_module.conf
	============================================================================

----------------------------------------------------------------------------------------------------

	(4)匹配php文件(修改/etc/httpd/conf/extra/php5_module.conf)

	===========================================================================
	#建议删除默认页面，后面的目录访问控制可以设置
	DirectoryIndex index.html index.htm
	===========================================================================

	============================================================================
	#告知apache，凡是.php结尾的文件，交给php处理
	<FilesMatch "\.php$">
		SetHandler application/x-httpd-php
	<FilesMatch>
	============================================================================

	============================================================================
	#作用与上面一样，但更加灵活，一次性可以写多个
	AddType application/x-httpd-php .php .phps .pap
	============================================================================


	(5)设置php时区(/etc/php53/php.ini)

	===========================================================================
	date.timezone=Asia/Shanghai
	===========================================================================

	(6)apache显示调试错误

	===========================================================================
	修改/etc/php53/php.ini
	display_errors=On
	修改/etc/httpd/conf/httpd.conf
	php_flag display_errors   on
	===========================================================================

	(7)重启apache
```

<br>

#### 三.安装mysql-server

```
	(1)加载php模块（/etc/php53/php.ini）

	extension=mysql.so
	extension=mysqli.so

	(2)安装mariadb

	#初始化mysql数据库
	>mysql_install_db --user=mysql --basedir=/usr --datadir=/var/lib/mysql
	#启动mariadb
	>systemctl start mariadb
	#初始化mariadb配置
	>mysql_secure_installation
	#重启mariadb
	>systemctl restart mariadb
```

<br>

#### 四.其他设置

```
	/etc/httpd/conf/httpd.conf
	===========================================================================
	#设置监听端口（指定本地所有ip监听指定的端口，可以指定多个）
	Listen 80
	Listen 8080
	或（指定特定的ip监听指定的端口）
	Listen 12.34.56.78:80

	===========================================================================
	#设置默认主机名
	ServerName www.php17.com  
	#设置默认站点目录
	DocumentRoot "/srv/http"
	#设置虚拟目录名
	Alias /soft /srv/http/soft/html			#访问/soft即可访问/srv/http/soft/html
	#站点目录访问权限
	<Directory "/srv/http">		
		Options Indexes				#允许显示文件列表
		Order Deny,Allow			#设置权限控制的先后顺序(先拒绝,后允许)
		DirectoryIndex index.html index.htm	#默认主页,可以设置多个

		AllowOverride all 			#设置分布目录控制权限，每个子目录下可以分别用.htaccess文件控制访问权限
		Require all granted			#所有人可以访问
	</Directory>

	===========================================================================
	#设置虚拟主机
	Include conf/extra/httpd-vhosts.conf		#加载虚拟主机配置文件
	#设置httpd-vhosts.conf
	<VirtualHost *:80>		#指定监听的ip与端口
	    	DocumentRoot "/etc/httpd/docs/dummy-host.example.com"   	#站点目录
    		ServerName dummy-host.example.com				#主机名
    		ServerAlias www.dummy-host.example.com				#主机别名
		<Directory "/srv/http">						#设置目录访问权限
		....
		</Directory>
    		ErrorLog "/var/log/httpd/dummy-host.example.com-error_log"	#错误日志保存地址
	</VirtualHost>
	注意：第一个虚拟主机为默认站点，当无法匹配主机名时,则返回默认站点
	     当设置了虚拟主机时，原来主配置中的站点失效，需要重新设置一个虚拟站点
```
