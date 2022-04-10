<?php
/**
 * @desc helper.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/02/17 20:26
 */
declare (strict_types = 1);

use Tinywan\Validate\Validate;

if (!function_exists('validate')) {
    /**
     * 生成验证对象
     * @param array $data 数据
     * @param string|array $validate 验证器类名或者验证规则数组
     * @param array $message 错误提示信息
     * @param bool $batch 是否批量验证
     * @param bool $failException 是否抛出异常
     * @return  bool
     */
    function validate(array $data, $validate = '', array $message = [], bool $batch = false, bool $failException = true):bool
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                [$validate, $scene] = explode('.', $validate);
            }
            $v = new $validate();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        return $v->message($message)->batch($batch)->failException($failException)->check($data);
    }
}