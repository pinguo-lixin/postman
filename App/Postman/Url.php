<?php
namespace App\Postman;

class Url extends BaseObject
{
    public $raw;
    /**
     * host
     *
     * @var string[]
     */
    public $host;
    /**
     * path
     *
     * @var string[]
     */
    public $path;
    /**
     * request query params
     *
     * @var KeyValue[]
     */
    public $query;

    public function setQuery(array $data)
    {
        $this->setKeyValue($data, 'query');
    }
}
