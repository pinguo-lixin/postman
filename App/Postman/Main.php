<?php
namespace App\Postman;

class Main extends BaseObject
{
    /**
     * info
     *
     * @var Info
     */
    public $info;
    /**
     * items
     *
     * @var Item[]
     */
    public $item = [];
    public $event;
    /**
     * variable
     *
     * @var KeyValue[]
     */
    public $variable = [];

    public function setInfo(array $data)
    {
        $this->info = Info::instance($data);
    }

    public function setItem(array $data)
    {
        $this->setArrayValue($data, 'item');
    }

    public function setVariable(array $data)
    {
        $this->setKeyValue($data, 'variable');
    }
}
