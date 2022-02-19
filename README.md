# Webman Validate 插件

[![Latest Stable Version](http://poser.pugx.org/tinywan/validate/v)](https://packagist.org/packages/tinywan/validate)
[![Total Downloads](http://poser.pugx.org/tinywan/validate/downloads)](https://packagist.org/packages/tinywan/validate)
[![webman-event](https://img.shields.io/github/v/release/tinywan/validate?include_prereleases)]()
[![webman-event](https://img.shields.io/badge/build-passing-brightgreen.svg)]()
[![webman-event](https://img.shields.io/github/last-commit/tinywan/validate/main)]()
[![webman-event](https://img.shields.io/github/v/tag/tinywan/validate?color=ff69b4)]()

> 声明：由于官方的 [think-validate验证器](https://github.com/top-think/think-validate) 不兼容 `PHP8.0`。所以这里重复造轮子

基于PHP7.4 + 的Validate实现。基于ThinkPHP6修改的可用于 [webman](https://www.workerman.net/doc/webman/) 的通用validate数据验证器。

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
    protected $rule =   [
        'name'  => 'require|max:25',
        'age'   => 'require|number|between:1,120',
        'email' => 'require|email'
    ];

    protected $message  =   [
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
$validate = new \app\index\validate\UserValidate;

if (!$validate->check($data)) {
    var_dump($validate->getError());
}
~~~

## 助手函数（推荐）

自定义函数 `functions.php` 添加`validate()`函数

```php
/**
 * @desc 验证器助手函数
 * @param array $data 数据
 * @param string|array $validate 验证器类名或者验证规则数组
 * @param array $message 错误提示信息
 * @param bool $batch 是否批量验证
 * @param bool $failException 是否抛出异常
 * @return bool
 * @author Tinywan(ShaoBo Wan)
 */
function validate(array $data, $validate = '', array $message = [], bool $batch = false, bool $failException = true)
{
    if (is_array($validate)) {
        $v = new \Tinywan\Validate\Validate();
        $v->rule($validate);
    } else {
        if (strpos($validate, '.')) {
            [$validate, $scene] = explode('.', $validate);
        }
        $class = false !== strpos($validate, '\\') ? $validate : $validate;
        $v = new $class();
        if (!empty($scene)) {
            $v->scene($scene);
        }
    }
    return $v->message($message)->batch($batch)->failException($failException)->check($data);
}
```
验证器调用代码如下：
```php
$data = [
    'name'  => 'Tinywan',
    'age'  => 24,
    'email' => 'Tinywan@163.com'
];
validate($data, \app\index\validate\UserValidate::class . '.issue');
```
> 验证错误会自动抛出异常

更多用法可以参考6.0完全开发手册的[验证](https://www.kancloud.cn/manual/thinkphp6_0/1037623)章节

