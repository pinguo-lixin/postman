<?php
namespace App\Controller;

use Yii;
use App\Postman\Main;
use yii\helpers\Json;
use yii\web\Controller;
use App\Service\Markdown;
use yii\web\UploadedFile;
use yii\helpers\VarDumper;
use App\Service\DocGenerate;
use yii\web\BadRequestHttpException;

class ProjectController extends Controller
{
    public $enableCsrfValidation = false;
    
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

    public function actionUpload()
    {
        if (Yii::$app->request->isPost) { // upload
            $file = UploadedFile::getInstanceByName('file');
            $savename = Yii::getAlias('@app/upload/' . $file->name);
            $file->saveAs($savename);
            return $this->asJson([
                'code' => $file->error,
                'name' => $file->name,
            ]);
        } else {
            return $this->render('upload');
        }
    }

    public function actionDownload()
    {
        $filename = Yii::$app->request->post('filename');
        if (! $filename) {
            throw new BadRequestHttpException('file required');
        }
        $savename = Yii::getAlias('@app/upload/' . $filename);

        try {
            $generator = new DocGenerate($savename);
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        
        $project = explode('.', $filename)[0];
        $savefile = Yii::getAlias('@runtime/' . $project . '.md');

        $generator->generate(new Markdown(), $savefile);

        return Yii::$app->getResponse()->sendFile($savefile);
    }
}
