<?php
namespace App\Postman;

/**
 * 一个配置项
 * 可以是一个目录或一个请求
 * 
 * @property-read bool $isRequest 是否为一个请求
 */
class Item extends BaseObject
{
    public $name;
    public $description;
    public $event;

    /** 下列属性仅请求可用 */
    
    /**
     * request
     *
     * @var Request
     */
    public $request;
    /**
     * Response
     *
     * @var Response[]
     */
    public $response = [];

    /** 下列属性仅目录可用 */

    /**
     * 次级 Item
     *
     * @var Item[]
     */
    public $item = [];

    /**
     * 当前 Item 是否为一个请求
     *
     * @return bool
     */
    public function getIsRequest()
    {
        return ! empty($this->request);
    }

    public function setRequest(array $data)
    {
        $this->request = Request::instance($data);
    }

    public function setResponse(array $data)
    {
        $this->setArrayValue($data, 'response');
    }

    public function setItem(array $data)
    {
        $this->setArrayValue($data, 'item');
    }
}
