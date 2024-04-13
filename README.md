# Webman Validate 插件

[![Latest Stable Version](http://poser.pugx.org/tinywan/validate/v)](https://packagist.org/packages/tinywan/validate)
[![Total Downloads](http://poser.pugx.org/tinywan/validate/downloads)](https://packagist.org/packages/tinywan/validate)
[![webman-event](https://img.shields.io/github/v/release/tinywan/validate?include_prereleases)]()
[![webman-event](https://img.shields.io/badge/build-passing-brightgreen.svg)]()
[![webman-event](https://img.shields.io/github/last-commit/tinywan/validate/main)]()
[![webman-event](https://img.shields.io/github/v/tag/tinywan/validate?color=ff69b4)]()

基于ThinkPHP6修改的可用于 [webman](https://www.workerman.net/doc/webman/) 的通用validate数据验证器。

## 安装

```shell
composer require tinywan/validate
```

## 基础用法

~~~php
<?php
namespace app\index\validate;

use Tinywan\Validate\Validate;

class UserValidate extends Validate
{
    protected array $rule =   [
        'name'  => 'require|max:25',
        'age'   => 'require|number|between:1,120',
        'email' => 'require|email'
    ];

    protected array $message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',
        'age.require'   => '年龄必须是数字',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'email.require'        => '邮箱必须是数字',
        'email.email'        => '邮箱格式错误'
    ];
}
~~~

验证器调用代码如下：

~~~php
$data = [
    'name'  => 'Tinywan',
    'age'  => 24,
    'email' => 'Tinywan@163.com'
];
$validate = new app\index\validate\UserValidate;

if (!$validate->check($data)) {
    var_dump($validate->getError());
}
~~~

## 助手函数（推荐）

```php
$data = [
    'name'  => 'Tinywan',
    'age'  => 24,
    'email' => 'Tinywan@163.com'
];
validate($data, \app\index\validate\UserValidate::class);
```
> 验证错误会自动抛出异常

## 使用面板Facade

```php
$validate = \Tinywan\Validate\Facade\Validate::rule('age', 'number|between:1,120')
    ->rule([
        'name'  => 'require|max:25',
        'email' => 'email'
    ]);
$data = [
    'name'  => 'tinywan',
    'email' => 'tinywan@gmail.com'
];
if (!$validate->check($data)) {
    var_dump($validate->getError());
}
```

更多用法可以参考6.0完全开发手册的[验证](https://www.kancloud.cn/manual/thinkphp6_0/1037623)章节

