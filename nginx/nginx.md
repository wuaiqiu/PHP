# Nginx

#### 一.安装过程

```
(1).安装nginx php-fpm
pacman -S nginx
pacman -S php-fpm

(2).创建php.conf
location ~ \.php$ {
      fastcgi_pass   unix:/run/php-fpm/php-fpm.sock;
      fastcgi_index  index.php;
      include        fastcgi.conf;
}

(3).配置nginx.conf
/etc/nginx/nginx.conf
server {
     listen 80;
     server_name localhost;
     root /home/wu/www/Blog/;
     location / {
        index index.html index.htm index.php;
        if (!-e  $request_filename) {
              rewrite ^/(.*)$ /index.php?s=$1 last;
              break;
        }
     }
      include php.conf;
}

(4).启动服务
systemctl start php-fpm
systemctl start nginx


(5).配置优化

压缩优化
gzip on;
gzip_comp_level 4;  （0-9越大越耗时）
gzip_types text/plain application/x-javascript text/css application/xml text/javascript application/x-httpd-php image/jpeg image/gif image/png;

静态文件等过期时间
location ~ \.(ico|gif|jpg|jpeg|png|js|css)$ {
    expires      7d;
}
```
