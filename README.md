# validate

[![license](https://img.shields.io/github/license/Tinywan/validate)]()
[![996.icu](https://img.shields.io/badge/link-996.icu-red.svg)](https://996.icu)
[![Build status](https://github.com/Tinywan/dnmp/workflows/CI/badge.svg)]()
[![webman-event](https://img.shields.io/github/v/release/tinywan/validate?include_prereleases)]()
[![webman-event](https://img.shields.io/badge/build-passing-brightgreen.svg)]()
[![webman-event](https://img.shields.io/github/last-commit/tinywan/validate/main)]()
[![webman-event](https://img.shields.io/github/v/tag/tinywan/-validate?color=ff69b4)]()

> 声明：由于官方的 [think-validate验证器](https://github.com/top-think/think-validate) 不兼容 `PHP8.0`。所以这里重复造轮子

基于PHP7.4 + 的Validate实现。基于ThinkPHP6修改的可用于 [webman](https://www.workerman.net/doc/webman/) 的通用validate数据验证器。

## 安装

```shell
composer require tinywan/webman-validate
```

## 用法

~~~php
<?php
namespace app\index\validate;

use webman\Validate;

class UserValidate extends Validate
{
    protected $rule =   [
        'name'  => 'require|max:25',
        'age'   => 'number|between:1,120',
        'email' => 'email',    
    ];
    
    protected $message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'email'        => '邮箱格式错误',    
    ];
    
}
~~~

验证器调用代码如下：
~~~php
$data = [
    'name'  => 'thinkphp',
    'email' => 'thinkphp@qq.com',
];

$validate = new \app\index\validate\UserValidate;

if (!$validate->check($data)) {
    var_dump($validate->getError());
}
~~~

更多用法可以参考6.0完全开发手册的[验证](https://www.kancloud.cn/manual/thinkphp6_0/1037623)章节

