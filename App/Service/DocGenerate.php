<?php
namespace App\Service;

use Yii;
use App\Postman\Main;
use yii\base\InvalidArgumentException;
use yii\helpers\Json;

class DocGenerate
{
    protected $postmanFile;
    protected $mainEntity;

    public function __construct($postman)
    {
        $this->postmanFile = $postman;
        
        $data = file_get_contents($this->postmanFile);
        if (false === $data) {
            throw new InvalidArgumentException("can\'t read postman file: {$this->postmanFile}");
        }

        $this->mainEntity = Main::instance(Json::decode($data));
    }

    public function generate(GeneratorProvider $generator, $savefile)
    {
        file_put_contents($savefile, $generator->parse($this->mainEntity));
    }
}
