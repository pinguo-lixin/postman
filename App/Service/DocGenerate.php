<?php
namespace App\Service;

use Yii;
use App\Postman\Main;
use yii\base\InvalidArgumentException;
use yii\helpers\Json;

class DocGenerate
{
    const POSTMAN_FILE_SUFFIX = '.postman_collection.json';
    
    protected $project;
    protected $postmanFile;
    protected $mainEntity;

    public function __construct($project)
    {
        $this->project = $project;
        $this->postmanFile = Yii::getAlias('@postman/' . $project . static::POSTMAN_FILE_SUFFIX);
        
        $data = file_get_contents($this->postmanFile);
        if (false === $data) {
            throw new InvalidArgumentException("can\'t read postman file: {$this->postmanFile}");
        }

        $this->mainEntity = Main::instance(Json::decode($data));
    }

    public function generate(GeneratorProvider $generator, $savefile = '')
    {
        if ($savefile === '') {
            $savefile = Yii::getAlias('@runtime/' . $this->project . '.md');
        }

        file_put_contents($savefile, $generator->parse($this->mainEntity));
    }
}
