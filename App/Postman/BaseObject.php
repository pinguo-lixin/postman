<?php
namespace App\Postman;

use yii\base\BaseObject as YiiBaseObject;

class BaseObject extends YiiBaseObject
{
    /**
     * parse data
     *
     * @param array $data
     * @return static
     */
    public static function instance(array $data)
    {
        $object = new static();
        foreach ($data as $key => $v) {
            if ($object->hasProperty($key)) {
                if ($object->hasMethod('set' . $key)) {
                    call_user_func([$object, 'set' . $key], $v);
                } else {
                    $object->$key = $v;
                }
            }
        }
        return $object;
    }

    protected function setKeyValue(array $data, $property)
    {
        foreach ($data as $v) {
            $this->$property[] = KeyValue::instance($v);
        }
    }

    protected function setArrayValue(array $data, $property, $className = null)
    {
        if (null === $className) {
            $className = __NAMESPACE__ . '\\' . ucfirst($property);
        }
        foreach ($data as $v) {
            $this->$property[] = call_user_func([$className, 'instance'], $v);
        }
    }
}
