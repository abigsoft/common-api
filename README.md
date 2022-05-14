### 简介
###### 名称：夜公子API
    已申请软著，代码全开源，可免费商用(需经本作者同意)，禁止对外售卖
###### 代码框架：ThinkPHP6
###### 功能模块
    内设2套模板，样式来源于“零艺客”博客和“Hi,I am I”博客
    支持创建项目，然后用项目区分API，以防止不同项目混用
    对接彩虹易支付与彩虹聚合登录
    目录鲜明，方便开发人员开发接口，可一键生成接口入口，然后在入口的基础上进行接口开发
### 安装方式
###### 环境要求：8.0 > PHP >= 7.4 ; MySQL 5.6-8.0
###### 安装步骤 
    1> 拷贝代码到项目目录
    2> 关闭防跨站攻击
    3> 根目录指向项目目录，运行目录指向public目录
    4> 伪静态设置为thinkphp
        如 nginx:
            location / {
                if (!-e $request_filename){
                    rewrite  ^(.*)$  /index.php?s=$1  last;   break;
                }
            }
    5> 复制一份根目录下.example.env到同目录，文件名称设置为.env(即去掉前面的.example,注意小数点)，替换对应的数据库参数
    6> 将data.sql文件覆盖到数据库
    7> logo替换在public/static/logo.png
    8> 宝塔定时任务 shell 脚本每1分钟执行 php 项目绝对目录/think com
###### 默认数据
    管理端：域名/admin  默认账号：admin  默认密码：123456
### 更新日志
    1.0.0 ~ 2022-05-13
### 联系作者
    作者博客：http://blog.abug.cc
    QQ聊天群：721181049
    捐助作者：[![21bbc8deba3b0f4f6ee87127223e750.jpg](http://qn.tbed.abug.cc/2022/04/29/626bab1e1cc34.jpg)](http://qn.tbed.abug.cc/2022/04/29/626bab1e1cc34.jpg)