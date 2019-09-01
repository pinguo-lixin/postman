<?php
namespace App\Postman;

class Body extends BaseObject
{
    const MODE_RAW = 'raw';
    const MODE_FORMDATA = 'formdata';
    const MODE_URLENCODED = 'urlencoded';
    
    public $mode;

    /**
     * 仅 mode == raw 时存在
     *
     * @var string
     */
    public $raw;
    /**
     * 仅 mode == formdata 时存在
     *
     * @var Formdata[]
     */
    public $formdata;

    /**
     * 仅 mode == urlencoded 时存在
     *
     * @var Formdata[]
     */
    public $urlencoded;

    public function setFormdata(array $data)
    {
        $this->setArrayValue($data, 'formdata');
    }

    public function setUrlencoded(array $data)
    {
        $this->setArrayValue($data, 'urlencoded', Formdata::class);
    }

    /**
     * get body content
     *
     * @return Formdata[]|string
     */
    public function getValue()
    {
        if ($this->mode === static::MODE_RAW) {
            return $this->raw;
        } else {
            return $this->{$this->mode};
        }
    }
}
