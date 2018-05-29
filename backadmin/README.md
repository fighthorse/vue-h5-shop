ThinkAdmin for PHP
--
## 大道至简 · 悟在天成

* ThinkAdmin 是一个基于 Thinkphp 5.1.x 开发的后台管理系统，集成后台系统常用功能。
* 项目安装及二次开发请参考 ThinkPHP 官方文档及下面的服务环境说明，数据库 sql 文件存放于项目根目录下。
>* 注意：项目测试请另行搭建环境并创建数据库（数据库配置 config/database.php）, 切勿直接使用测试环境数据！
>* 如果系统提示“测试系统禁止操作等字样”，可以修改项目路由配置（route/route.php）, 清空里面的路由记录。
>* 当前版本使用 ThinkPHP 5.1.x 版本，对PHP版本要求不低于php5.6，具体请查阅ThinkPHP官方文档。


Documentation
--
认真看看文档可能会对你的开发有所帮助哦！

文档地址：[ThinkAdmin 开发文档](https://www.kancloud.cn/zoujingli/thinkadmin/content)


PHP开发技术交流（QQ群 513350915）

Repositorie
--
 ThinkAdmin 为开源项目，允许把它用于任何地方，不受任何约束，欢迎 fork 项目。
* GitHub 托管地址：https://github.com/zoujingli/ThinkAdmin
* Gitee  托管地址：https://gitee.com/zoujingli/Think.Admin

对于新版本的微信模块使用的是授权模式，需要用到 ThinkService 项目。
* GitHub 托管地址：https://github.com/zoujingli/ThinkService
* Gitee  托管地址：https://gitee.com/zoujingli/ThinkService

其安装与 ThinkAdmin 相似，这里就不多说了。具体可以参见微信开放平台官网
https://open.weixin.qq.com ，ThinkService 后台具体可以配置对应参数。

ThinkAdmin 与 ThinkService 对接是通过 WebService 通信的，因此运行环境需要安装 Soap 模块支持。


Module
--
* 简易`RBAC`权限管理（用户、权限、节点、菜单控制）
* 自建秒传文件上载组件（本地存储、七牛云存储，阿里云OSS存储）
* 基站数据服务组件（唯一随机序号、表单更新）
* `Http`服务组件（原生`CURL`封装，兼容PHP多版本）
* 微信公众号服务组件（基于[WeChatDeveloper](https://github.com/zoujingli/WeChatDeveloper)，微信网页授权获取用户信息、已关注粉丝管理、自定义菜单管理等等）
* 微信商户支付服务组件（基于[WeChatDeveloper](https://github.com/zoujingli/WeChatDeveloper)，支持JSAPI支付、扫码模式一支付、扫码模式二支付）
* 更多组件开发中...


Environment
---
>1. PHP 版本不低于 PHP5.6，推荐使用 PHP7 以达到最优效果；
>2. 需开启 PATHINFO，不再支持 ThinkPHP 的 URL 兼容模式运行（源于如何优雅的展示）。

* Apache

```xml
<IfModule mod_rewrite.c>
  Options +FollowSymlinks -Multiviews
  RewriteEngine On
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
</IfModule>
```

* Nginx

```
server {
	listen 80;
	server_name wealth.demo.cuci.cc;
	root /home/wwwroot/ThinkAdmin;
	index index.php index.html index.htm;
	
	add_header X-Powered-Host $hostname;
	fastcgi_hide_header X-Powered-By;
	
	if (!-e $request_filename) {
		rewrite  ^/(.+?\.php)/?(.*)$  /$1/$2  last;
		rewrite  ^/(.*)$  /index.php/$1  last;
	}
	
	location ~ \.php($|/){
		fastcgi_index   index.php;
		fastcgi_pass    127.0.0.1:9000;
		include         fastcgi_params;
		set $real_script_name $fastcgi_script_name;
		if ($real_script_name ~ "^(.+?\.php)(/.+)$") {
			set $real_script_name $1;
		}
		fastcgi_split_path_info ^(.+?\.php)(/.*)$;
		fastcgi_param   PATH_INFO               $fastcgi_path_info;
		fastcgi_param   SCRIPT_NAME             $real_script_name;
		fastcgi_param   SCRIPT_FILENAME         $document_root$real_script_name;
		fastcgi_param   PHP_VALUE               open_basedir=$document_root:/tmp/:/proc/;
		access_log      /home/wwwlog/domain_access.log    access;
		error_log       /home/wwwlog/domain_error.log     error;
	}
	
	location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$ {
		access_log  off;
		error_log   off;
		expires     30d;
	}
	
	location ~ .*\.(js|css)?$ {
		access_log   off;
		error_log    off;
		expires      12h;
	}
}
```
