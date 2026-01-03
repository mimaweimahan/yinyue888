管理系统 v1.0
===============

> 运行环境要求PHP7.4+。
> 建议使用PHP8.1。
使用框架:[ThinkPHP v6.0.13](https://www.thinkphp.cn/)。

## 主要新特性

* 采用`PHP7`强类型（严格模式）
* 支持更多的`PSR`规范
* 原生多应用支持

## 安装配置
~~~
1.设置站点目录为public目录
2.导入data.sql到数据库
3.修改配置文件.env 配置数据库信息
~~~

## 后台地址

~~~
http://www.xxx.com/admin/login
账号：admin
密码：123123
~~~

## 更新
~~~
composer update --ignore-platform-reqs
~~~

## 取消禁用函数
~~~
pcntl_alarm，pcntl_signal，pcntl_fork，pcntl_wait，proc_open
~~~

## 任务批次处理
~~~
https://www.xxx.com/tool/batch/run
~~~
