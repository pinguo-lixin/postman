<?php
namespace App\Postman;

class Response extends BaseObject
{
    use TraitApplicationJson;
    
    public $name;
    public $code;
    public $status; // string
    /**
     * header
     *
     * @var KeyValue[]
     */
    public $header;
    public $body; // string
    /**
     * request
     *
     * @var Request
     */
    public $originalRequest;

    public function setHeader(array $data)
    {
        $this->setKeyValue($data, 'header');
    }

    public function setOriginalRequest(array $data)
    {
        $this->originalRequest = Request::instance($data);
    }
}
