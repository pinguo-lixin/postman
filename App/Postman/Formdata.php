<?php
namespace App\Postman;

/**
 * 表单数据
 */
class Formdata extends BaseObject
{
    const TYPE_TEXT = 'text';
    const TYPE_FILE = 'file';

    public $key;
    public $type;
    public $description = '';

    public $src; // file
    public $value; // text

    public function getValue()
    {
        return $this->type === static::TYPE_TEXT ? $this->value : $this->src;
    }
}
