<?php
namespace App\Command;

use Yii;
use App\Service\DocGenerate;
use App\Service\Markdown;
use yii\console\Controller;

class GenerateController extends Controller
{
    public function actionMarkdown($name)
    {
        $file = Yii::getAlias('@postman/' . $name . '.postman_collection.json');
        $generator = new DocGenerate($file);
        $provider = new Markdown();

        $generator->generate($provider, Yii::getAlias('@runtime/' . $name . '.md'));
    }
}
