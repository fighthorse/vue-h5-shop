# vue-h5-shop #
项目：主要使用前后端分离，vuejs前端，thinkAdmin(TP5+layUI)后台管理，API(Go/Laravel)接口.

# 源码直接克隆 #
git clone https://github.com/fighthorse/vue-h5-shop.git
cd vue-h5-shop

//域名配置
shop.beststudy.online
api.beststudy.online
back.beststudy.online

//前端开发
cd vueh5
npm install 
npm run dev


# 本地项目初始化 #
`...非必须..初始化流程...`
1.初始化本地项目文件夹
echo "# vue-h5-shop" >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/fighthorse/vue-h5-shop.git
git push -u origin master
`...非必须..初始化流程...`

# 前端H5 #
`...非必须..初始化流程...`
npm install -g vue-cli
npm install -g webpack 
vue init webpack vueh5
cd vueh5
npm install [ cnpm install ]
npm install vue-router vue-resource --save
npm install iview --save
npm run dev
`...非必须..初始化流程...`


#vue参考网站#
https://cn.vuejs.org/
https://www.iviewui.com/docs/guide/start

#本地端口-文件#
config/index.js


# 后台thinkadmin #
基于 Thinkphp5 的后台管理系统 https://github.com/fighthorse/ThinkAdmin.git
https://www.kancloud.cn/zoujingli/thinkadmin/323614
git clone https://github.com/fighthorse/ThinkAdmin.git


# API 接口双版本 #
# API PHP Laravel #
composer create-project --prefer-dist laravel/laravel phpapi

Apache
Options +FollowSymLinks
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]

Nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

# API Go Beego #
beego 的安装
go get github.com/astaxie/beego [ 升级 go get -u github.com/astaxie/beego ]
go get github.com/beego/bee
打开终端，进入 $GOPATH/src 所在的目录
bee new goweb  [ Web 项目 ]
bee api goapi  [  API 应用 ]
文件目录结构：
goweb
├── conf
│   └── app.conf
├── controllers
│   └── default.go
├── main.go
├── models
├── routers
│   └── router.go
├── static
│   ├── css
│   ├── img
│   └── js
├── tests
│   └── default_test.go
└── views
    └── index.tpl
M（models 目录）、V（views 目录）和 C（controllers 目录）的结构， main.go 是入口文件。

goapi
├── conf
│   └── app.conf
├── controllers
│   └── object.go
│   └── user.go
├── docs
│   └── doc.go
├── main.go
├── models
│   └── object.go
│   └── user.go
├── routers
│   └── router.go
└── tests
    └── default_test.go

bee run 命令是监控 beego 的项目，通过 fsnotify监控文件系统。但是注意该命令必须在 $GOPATH/src/appname 下执行。

bee pack
目录用来发布应用的时候打包，会把项目打包成 zip 包，这样我们部署的时候直接把打包之后的项目上传，解压就可以部署了

bee generate 命令
用来自动化的生成代码的，包含了从数据库一键生成 model，还包含了scaffold 
bee generate scaffold [scaffoldname] [-fields=""] [-driver=mysql] [-conn="root:@tcp(127.0.0.1:3306)/test"]
bee generate model [modelname] [-fields=""]
bee generate controller [controllerfile]
bee generate view [viewpath]
bee generate migration [migrationfile] [-fields=""]
bee generate docs

# Nginx 配置#
nginx是一款自由的、开源的、高性能的HTTP服务器和反向代理服务器；同时也是一个IMAP、POP3、SMTP代理服务器；nginx可以作为一个HTTP服务器进行网站的发布处理，另外nginx可以作为反向代理进行负载均衡的实现。

用户访问---[dns解析-正向代理]--->目标服务器---[反向代理]--->代理服务器---[负载均衡-权重\ip_hash\url_hash]--->处理服务器处理--->返回数据

# HTTP 原理 #
TCP/IP协议按照层次分为以下四层：应用层、传输层、网络层、数据链路层。
链路层：用来处理连接网络的硬件部分。包括控制操作系统，硬件的设备驱动、网卡NIC，及光纤等物理可见部分。
网络层：处理网络上流动的数据包。数据包是网络传输的最小数据单位。该层桂东了通过怎样的路径（传输路线）到达对方计算机，并把数据包传送给对方。选择传输线路。IP协议、ICMP协议、ARP协议、RARP协议和BOOTP协议。
传输层：TCP 传输控制协议 UDP 用户数据报协议
应用层：FTP 文件传输协议 DNS域名系统 HTTP协议

3次握手与4次挥手：
3次握手，用来保障通讯双方有通信的基础。
4次挥手，用来保障通讯双方可以安全的回收TCP通信的系统资源。

Http协议定义了很多与服务器交互的方法，最基本的是GET,POST,PUT,DELETE，对应着对这个资源的查，改，增，删4个操作。最常见的就是GET和POST了。GET一般用于获取/查询资源信息，而POST一般用于更新资源信息

