<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UploadImg;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Imagick\Font;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;

class SiteController extends Controller
{

    public function actionIndex()
    {
        $model = new UploadImg();

        $files = FileHelper::findFiles(\Yii::getAlias('@webroot/img/result', ['only' => ['*.gif']]));
        $files = array_map(function ($path) {
            return basename($path);
        }, $files);
        return $this->render('index', ['files' => $files]);
    }


    public function actionUpload(){
        $model = new UploadImg();
        $error = '';
        if (\Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->validate()){
                //Временный файл изображения   *.tmp
                $tmpFile = $model->image->tempName;
                //Оригинальное название файла
                $name = $model->image->name;
                //Подключаем библиотеку для работы с графикой
                $imageToMake = Image::getImagine()->open($tmpFile);
                //Загружаем watermark
                $watermark = \Yii::getAlias(\Yii::$app->params['img_params']['waterMark']);
                //Определяем размеры исходного изображения
                $size = getimagesize($tmpFile);
                $currentW = $size[0];
                $currentH = $size[1];
                //Максимально допустимые размеры изображения для приложения
                $maxW = \Yii::$app->params['img_params']['w'];
                $maxH = \Yii::$app->params['img_params']['h'];
                $imageToMake->layers()->coalesce();
                foreach ($imageToMake->layers() as $frame) {
                    //ресайз картинки
                    if ($currentW > $maxW) {
                        $frame->resize(new Box($maxW, $maxH));
                    } elseif ($currentH > $maxH) {
                        $frame->resize(new Box($maxW, $maxH));
                    }
                    //наложение watermark
                    Image::watermark($frame, $watermark);
                }
                //Сохраняем готовое изображение
                try {
                    $imageToMake
                        ->save(\Yii::getAlias('@webroot/img/result/' . $name), array('animated' => true));
                    return $this->render('upload', ['model' => $model,'tab' => 'view']);
                }catch (\Exception $e){
                    return $this->render('upload', ['model' => $model,'tab' => 'view','res'=> $e->getMessage()]);
                }
            }
        }
        return $this->render('upload', ['model' => $model, 'error'=> $error]);

    }

    public function actionPlugin(){
        return $this->render('plugin');
    }




}
