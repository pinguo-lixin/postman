<?php
namespace App\Postman;

class KeyValue extends BaseObject
{
    public $key;
    public $value;

    /** optional */
    public $name = '';
    /** optional */
    public $type = '';
    /** optional */
    public $description = '';
}
