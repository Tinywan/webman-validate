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
    public function test(){
        $data = [
            'name'  => 'Tinywan',
            'age'  => 24,
            'email' => 'Tinywan@163.com'
        ];
        $validate = new UserValidate();
        self::assertIsBool($validate->check($data));
        self::assertTrue($validate->check($data));
    }
}