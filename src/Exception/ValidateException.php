<?php
/**
 * @desc ValidateException.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/02/17 20:26
 */

declare (strict_types = 1);

namespace Tinywan\Validate\Exception;
use function is_array;
use function implode;

/**
 * 数据验证异常
 */
class ValidateException extends \RuntimeException
{
    protected $error;

    public function __construct($error)
    {
        parent::__construct();
        $this->error   = $error;
        $this->message = is_array($error) ? implode(PHP_EOL, $error) : $error;
    }

    /**
     * 获取验证错误信息
     * @access public
     * @return array|string
     */
    public function getError()
    {
        return $this->error;
    }
}