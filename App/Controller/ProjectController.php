<?php
namespace App\Controller;

use Yii;
use App\Postman\Main;
use yii\helpers\Json;
use yii\web\Controller;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;

class ProjectController extends Controller
{
    public function actionShow($name)
    {
        $file = Yii::getAlias('@postman/' . $name . '.postman_collection.json');
        $json = file_get_contents($file);
        if (! $json) {
            throw new BadRequestHttpException('Can\'t read specify project name');
        }
        
        $data = Json::decode($json);

        $project = Main::instance($data);

        echo '<pre>';
        VarDumper::dump($project);
    }
}
