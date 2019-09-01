<?php
namespace App\Postman;

/**
 * 根据 header 判断是否为 json 请求
 * 
 * 需要 header 属性
 */
trait TraitApplicationJson
{
    /**
     * whether json request or response judged by header
     *
     * @return bool
     */
    public function isJson()
    {
        /** @var Header $header */
        foreach ((array) $this->header as $header) {
            if (strcasecmp($header->key, 'Content-Type') === 0) {
                return stripos($header->value, 'application/json') !== false;
            }
        }
        return false;
    }
}
