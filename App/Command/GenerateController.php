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
        $generator = new DocGenerate($name);
        $provider = new Markdown();

        $generator->generate($provider);
    }
}
