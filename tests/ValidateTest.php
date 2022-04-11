<?php
/**
 * @desc Index.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/2/17 18:07
 */


namespace Tinywan\Tests;


use PHPUnit\Framework\TestCase;

class ValidateTest extends  TestCase
{
    /**
     * @desc: 基础测试
     */
    public function testBasic()
    {
        $data = [
            'name'  => 'Tinywan',
            'age'  => 24,
            'email' => 'Tinywan@163.com'
        ];
        $validate = new UserValidate();
        self::assertIsBool($validate->check($data));
        self::assertTrue($validate->check($data));
    }

    /**
     * @desc: 助手函数测试
     */
    public function testHelper()
    {
        $data = [
            'name'  => 'Tinywan',
            'age'  => 24,
            'email' => 'Tinywan@163.com'
        ];
        self::assertIsBool(validate($data, UserValidate::class));
        self::assertFalse(validate($data, UserValidate::class));
    }

    /**
     * @desc: 助手面板
     */
    public function testFacade()
    {
        $validate = \Tinywan\Validate\Facade\Validate::rule('age', 'number|between:1,120')
            ->rule([
                'name'  => 'require|max:25',
                'email' => 'email'
            ]);
        $data = [
            'name'  => 'tinywan',
            'email' => 'tinywan@gmail.com'
        ];
        self::assertIsBool($validate->check($data));
    }
}