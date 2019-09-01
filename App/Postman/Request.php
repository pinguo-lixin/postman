<?php
namespace App\Postman;


class Request extends BaseObject
{
    use TraitApplicationJson;
    
    public $method;
    /**
     * url
     *
     * @var Url
     */
    public $url;
    /**
     * headers
     *
     * @var KeyValue[]
     */
    public $header;
    /**
     * body
     *
     * @var Body
     */
    public $body;
    public $description;

    public function setUrl(array $data)
    {
        $this->url = Url::instance($data);
    }

    public function setHeader(array $data)
    {
        $this->setKeyValue($data, 'header');
    }

    public function setBody(array $data)
    {
        $this->body = Body::instance($data);
    }
}
