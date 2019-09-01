<?php
namespace App\Service;

use App\Postman\Main;

interface GeneratorProvider
{
    /**
     * parse data
     *
     * @return string
     */
    public function parse(Main $entity);
}
