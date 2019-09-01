<?php
namespace App\Controller;

use App\Postman\Main;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\ErrorAction;

class SiteController extends Controller
{
    
    /** @inheritDoc */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    public function actionIndex()
    {
        echo '<pre>';
        $json = file_get_contents(Yii::getAlias('@postman/hrm.postman_collection.json'));
        $data = json_decode($json, true);
        $main = Main::instance($data);
        VarDumper::dump($main);
    }
}
