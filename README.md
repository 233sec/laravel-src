# laravel-src
基于 Laravel 的开源安全应急响应中心平台.


### 安装
环境要求:
1. PHP 7.0.*
2. MySQL 5.6.x
3. ...

```shell
# composer安装依赖
composer update -vvv

# 配置
cp .env.example .env

# 修改数据库配置
vim .env

# 生成动态key
php artisan key:generate

# 导入数据库
php artisan migrate

composer dump-autoload

# 导入种子用户
php artisan db:seed

php artisan db:seed --class=AddPermisionTableSeeder

# 修改storage权限
sudo chmod -R 755 ./storage/

```

修改 hosts 添加 127.0.0.1 security.233sec.com 到 hosts
```shell
su
```
```shell
echo "\n" >> /etc/hosts
echo "127.0.0.1 security.233sec.com" >> /etc/hosts
```
通过 http://security.233sec.com 访问本地环境

如果发布生产, 正式使用, 务必做以下工作:
1. 去https://luosimao.com/service/captcha 注册正式验证码 key


### TODO
已知问题:
Swoole 模式运行下, datatables打印 queries 越来越多, 但是真实查询并不会按次数增加, 这是 datatables 的bug. 所以不予修复.


### COPYRIGHT
233SEC TEAM


### LICENSE
MIT
